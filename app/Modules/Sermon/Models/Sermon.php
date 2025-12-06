<?php
namespace App\Modules\Sermon\Models;

use App\Core\Model;
use PDO;

class Sermon extends Model
{
    protected $table = "sermoes";

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY data DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Paginação + busca + filtros */
    public function list($page = 1, $perPage = 10, $filters = [])
    {
        $offset = ($page - 1) * $perPage;
        $where = "WHERE id IS NOT NULL";
        $params = [];

        // 🔍 Filtros opcionais
        if (!empty($filters['search'])) {
            $where .= " AND (titulo LIKE :search OR conteudo LIKE :search OR pregador LIKE :search)";
            $params[':search'] = "%{$filters['search']}%";
        }

        if (!empty($filters['pregador'])) {
            $where .= " AND pregador LIKE :pregador";
            $params[':pregador'] = "%{$filters['pregador']}%";
        }

        if (!empty($filters['status'])) {
            $where .= " AND status = :status";
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['data_inicio'])) {
            $where .= " AND data >= :data_inicio";
            $params[':data_inicio'] = $filters['data_inicio'];
        }

        if (!empty($filters['data_fim'])) {
            $where .= " AND data <= :data_fim";
            $params[':data_fim'] = $filters['data_fim'];
        }

        $sql = "
            SELECT * FROM {$this->table}
            $where ORDER BY data DESC
            LIMIT $perPage OFFSET $offset
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $sermoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Pegar total
        $countStmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} $where");
        $countStmt->execute($params);
        $total = $countStmt->fetchColumn();

        return [
            "data" => $sermoes,
            "total" => $total,
            "page" => $page,
            "perPage" => $perPage,
            "pages" => ceil($total / $perPage)
        ];
    }

    public function create($data)
    {
        $id = $this->generateUniqueId();
        $data['slug'] = $this->generateSlug($data['titulo']);

        $stmt = $this->db->prepare("INSERT INTO {$this->table} 
            (id, titulo, slug, conteudo, pregador, data, status) 
            VALUES (:id, :titulo, :slug, :conteudo, :pregador, :data, :status)");

        $stmt->execute([
            ':id' => $id,
            ':titulo' => $data['titulo'],
            ':slug' => $data['slug'],
            ':conteudo' => $data['conteudo'] ?? null,
            ':pregador' => $data['pregador'] ?? null,
            ':data' => $data['data'],
            ':status' => $data['status'] ?? 'rascunho',
        ]);

        return $id;
    }

    public function update($id, $data)
    {
        $data['slug'] = $this->generateSlug($data['titulo']);

        $stmt = $this->db->prepare("UPDATE {$this->table} SET 
            titulo=:titulo, slug=:slug, conteudo=:conteudo, pregador=:pregador, 
            data=:data, status=:status
            WHERE id=:id");

        return $stmt->execute([
            ':titulo' => $data['titulo'],
            ':slug' => $data['slug'],
            ':conteudo' => $data['conteudo'] ?? null,
            ':pregador' => $data['pregador'] ?? null,
            ':data' => $data['data'],
            ':status' => $data['status'],
            ':id' => $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stmt->execute([$id]);
    }

    // 🔗 Relacionar mídias
    public function attachMedia($sermaoId, $mediaIds = [])
    {
        $stmt = $this->db->prepare("INSERT IGNORE INTO midia_sermoes (midia_id, sermao_id) VALUES (:midia_id, :sermao_id)");
        foreach ($mediaIds as $midiaId) {
            $stmt->execute([
                ':midia_id' => $midiaId,
                ':sermao_id' => $sermaoId
            ]);
        }
    }

    public function getMedia($sermaoId)
    {
        $stmt = $this->db->prepare("
            SELECT m.* 
            FROM midia_sermoes ms
            JOIN midia m ON ms.midia_id = m.id
            WHERE ms.sermao_id = ?
        ");
        $stmt->execute([$sermaoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detachMedia($sermaoId, $midiaId)
    {
        $stmt = $this->db->prepare("DELETE FROM midia_sermoes WHERE sermao_id=? AND midia_id=?");
        return $stmt->execute([$sermaoId, $midiaId]);
    }

    public function findWithMedia($id)
    {
        $stmt = $this->db->prepare("
            SELECT s.*, m.id AS midia_id, m.nome_arquivo, m.caminho_arquivo, m.tipo_arquivo, m.tipo_mime
            FROM {$this->table} s
            LEFT JOIN midia_sermoes ms ON ms.sermao_id = s.id
            LEFT JOIN midia m ON m.id = ms.midia_id
            WHERE s.id = ?
        ");
        $stmt->execute([$id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows)
            return null;

        $sermao = [
            "id" => $rows[0]['id'],
            "titulo" => $rows[0]['titulo'],
            "slug" => $rows[0]['slug'],
            "conteudo" => $rows[0]['conteudo'],
            "pregador" => $rows[0]['pregador'],
            "data" => $rows[0]['data'],
            "status" => $rows[0]['status'],
            "criado_em" => $rows[0]['criado_em'],
            "atualizado_em" => $rows[0]['atualizado_em'],
            "midias" => []
        ];

        foreach ($rows as $row) {
            if (!empty($row['midia_id'])) {
                $sermao['midias'][] = [
                    "id" => $row['midia_id'],
                    "nome_arquivo" => $row['nome_arquivo'],
                    "caminho_arquivo" => $row['caminho_arquivo'],
                    "tipo_arquivo" => $row['tipo_arquivo'],
                    "tipo_mime" => $row['tipo_mime'],
                ];
            }
        }

        return $sermao;
    }

    /** 
     * Gera um ID único e aleatório
     * Formato: SERM_XXXXXXXX (8 caracteres alfanuméricos)
     */
    public function generateUniqueId()
    {
        $prefix = 'SERM_';
        $length = 8;
        $maxAttempts = 10;
        $attempt = 0;

        do {
            // Gera uma string aleatória com letras e números
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $id = $prefix . $randomString;
            $attempt++;

            // Verifica se o ID já existe
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            $exists = $stmt->fetchColumn();

        } while ($exists > 0 && $attempt < $maxAttempts);

        // Se após várias tentativas ainda houver conflito, usa um timestamp
        if ($exists > 0) {
            $timestamp = substr(str_replace('.', '', microtime(true)), -8);
            $id = $prefix . $timestamp;
        }

        return $id;
    }

    /** 
     * Alternativa: Gera ID baseado em timestamp com prefixo
     * Formato: SERM_TIMESTAMP_HEX
     */
    public function generateTimestampId()
    {
        $prefix = 'SERM_';
        $timestamp = dechex(intval(microtime(true) * 1000)); // Timestamp em hexadecimal
        $random = dechex(rand(0, 65535)); // Número aleatório em hexadecimal

        return $prefix . $timestamp . '_' . $random;
    }

    /** 
     * Alternativa: Gera ID UUID-like simplificado
     * Formato: SERM_XXXX-XXXX-XXXX
     */
    public function generateUuidLikeId()
    {
        $prefix = 'SERM_';

        $part1 = substr(strtoupper(uniqid()), -4);
        $part2 = substr(strtoupper(uniqid('', true)), -4);
        $part3 = substr(strtoupper(uniqid('', true)), -4);

        return $prefix . $part1 . '-' . $part2 . '-' . $part3;
    }

    /** Slug auto */
    public function generateSlug($titulo)
    {
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $titulo), '-'));

        // garantir slug único
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE slug = ?");
        $stmt->execute([$slug]);

        if ($stmt->fetchColumn() > 0) {
            $slug .= "-" . uniqid();
        }

        return $slug;
    }

    /** Obter pregadores únicos */
    public function getPregadores()
    {
        $stmt = $this->db->query("SELECT DISTINCT pregador FROM {$this->table} WHERE pregador IS NOT NULL ORDER BY pregador");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}