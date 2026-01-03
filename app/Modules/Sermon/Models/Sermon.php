<?php
namespace App\Modules\Sermon\Models;

use App\Core\Model;
use PDO;

class Sermon extends Model
{
    protected string $table = "sermoes";
    private const ID_PREFIX = 'SERM_';
    private const ID_LENGTH = 8;
    private const MAX_ID_GENERATION_ATTEMPTS = 10;

    public function getAll(): array
    {
        $statement = $this->database->query("SELECT * FROM {$this->table} ORDER BY data DESC");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findatabaseyId(int $id): ?array
    {
        $statement = $this->database->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $statement->execute([$id]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function getPaginatedList(int $page = 1, int $perPage = 10, array $filters = []): array
    {
        $offset = ($page - 1) * $perPage;
        $whereClause = "WHERE id IS NOT NULL";
        $parameters = [];

        $whereClause = $this->applyFilters($whereClause, $parameters, $filters);

        $query = "
            SELECT * FROM {$this->table}
            {$whereClause} ORDER BY data DESC
            LIMIT {$perPage} OFFSET {$offset}
        ";

        $statement = $this->database->prepare($query);
        $statement->execute($parameters);
        $sermons = $statement->fetchAll(PDO::FETCH_ASSOC);

        $total = $this->getTotalRecords($whereClause, $parameters);
        $totalPages = ceil($total / $perPage);

        return [
            "data" => $sermons,
            "total" => $total,
            "page" => $page,
            "perPage" => $perPage,
            "pages" => $totalPages
        ];
    }

    private function applyFilters(string $whereClause, array &$parameters, array $filters): string
    {
        if (!empty($filters['search'])) {
            $whereClause .= " AND (titulo LIKE :search OR conteudo LIKE :search OR pregador LIKE :search)";
            $parameters[':search'] = "%{$filters['search']}%";
        }

        if (!empty($filters['pregador'])) {
            $whereClause .= " AND pregador LIKE :pregador";
            $parameters[':pregador'] = "%{$filters['pregador']}%";
        }

        if (!empty($filters['status'])) {
            $whereClause .= " AND status = :status";
            $parameters[':status'] = $filters['status'];
        }

        if (!empty($filters['data_inicio'])) {
            $whereClause .= " AND data >= :data_inicio";
            $parameters[':data_inicio'] = $filters['data_inicio'];
        }

        if (!empty($filters['data_fim'])) {
            $whereClause .= " AND data <= :data_fim";
            $parameters[':data_fim'] = $filters['data_fim'];
        }

        return $whereClause;
    }

    private function getTotalRecords(string $whereClause, array $parameters): int
    {
        $countQuery = "SELECT COUNT(*) FROM {$this->table} {$whereClause}";
        $countStatement = $this->database->prepare($countQuery);
        $countStatement->execute($parameters);

        return (int) $countStatement->fetchColumn();
    }

    public function createRecord(array $data): string
    {
        $id = $this->generateUniqueId();
        $data['slug'] = $this->generateSlug($data['titulo']);

        $query = "
            INSERT INTO {$this->table} 
            (id, titulo, slug, conteudo, pregador, data, status) 
            VALUES (:id, :titulo, :slug, :conteudo, :pregador, :data, :status)
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([
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

    public function updateRecord(int $id, array $data): bool
    {
        $data['slug'] = $this->generateSlug($data['titulo']);

        $query = "
            UPDATE {$this->table} SET 
            titulo=:titulo, slug=:slug, conteudo=:conteudo, pregador=:pregador, 
            data=:data, status=:status
            WHERE id=:id
        ";

        $statement = $this->database->prepare($query);

        return $statement->execute([
            ':titulo' => $data['titulo'],
            ':slug' => $data['slug'],
            ':conteudo' => $data['conteudo'] ?? null,
            ':pregador' => $data['pregador'] ?? null,
            ':data' => $data['data'],
            ':status' => $data['status'],
            ':id' => $id
        ]);
    }

    public function deleteRecord(int $id): bool
    {
        $statement = $this->database->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $statement->execute([$id]);
    }

    public function attachMedia(string $sermonId, array $mediaIds): void
    {
        $query = "INSERT IGNORE INTO midia_sermoes (midia_id, sermao_id) VALUES (:midia_id, :sermao_id)";
        $statement = $this->database->prepare($query);

        foreach ($mediaIds as $mediaId) {
            $statement->execute([
                ':midia_id' => $mediaId,
                ':sermao_id' => $sermonId
            ]);
        }
    }

    public function getAttachedMedia(string $sermonId): array
    {
        $query = "
            SELECT m.* 
            FROM midia_sermoes ms
            JOIN midia m ON ms.midia_id = m.id
            WHERE ms.sermao_id = ?
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$sermonId]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detachMedia(string $sermonId, int $mediaId): bool
    {
        $query = "DELETE FROM midia_sermoes WHERE sermao_id=? AND midia_id=?";
        $statement = $this->database->prepare($query);
        return $statement->execute([$sermonId, $mediaId]);
    }

    public function findWithMedia(string $id): ?array
    {
        $query = "
            SELECT s.*, m.id AS midia_id, m.nome_arquivo, m.caminho_arquivo, m.tipo_arquivo, m.tipo_mime
            FROM {$this->table} s
            LEFT JOIN midia_sermoes ms ON ms.sermao_id = s.id
            LEFT JOIN midia m ON m.id = ms.midia_id
            WHERE s.id = ?
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$id]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            return null;
        }

        $sermon = $this->buildSermonFromRows($rows);
        return $sermon;
    }

    // Adicione estes métodos na classe Sermon:

    public function findBySlug(string $slug): ?array
    {
        $statement = $this->database->prepare("SELECT * FROM {$this->table} WHERE slug = ?");
        $statement->execute([$slug]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findWithMediaBySlug(string $slug): ?array
    {
        $query = "
        SELECT s.*, m.id AS midia_id, m.nome_arquivo, m.caminho_arquivo, m.tipo_arquivo, m.tipo_mime
        FROM {$this->table} s
        LEFT JOIN midia_sermoes ms ON ms.sermao_id = s.id
        LEFT JOIN midia m ON m.id = ms.midia_id
        WHERE s.slug = ?
    ";

        $statement = $this->database->prepare($query);
        $statement->execute([$slug]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            return null;
        }

        $sermon = $this->buildSermonFromRows($rows);
        return $sermon;
    }

    private function buildSermonFromRows(array $rows): array
    {
        $firstRow = $rows[0];
        $sermon = [
            "id" => $firstRow['id'],
            "titulo" => $firstRow['titulo'],
            "slug" => $firstRow['slug'],
            "conteudo" => $firstRow['conteudo'],
            "pregador" => $firstRow['pregador'],
            "data" => $firstRow['data'],
            "status" => $firstRow['status'],
            "criado_em" => $firstRow['criado_em'],
            "atualizado_em" => $firstRow['atualizado_em'],
            "midias" => []
        ];

        foreach ($rows as $row) {
            if (!empty($row['midia_id'])) {
                $sermon['midias'][] = [
                    "id" => $row['midia_id'],
                    "nome_arquivo" => $row['nome_arquivo'],
                    "caminho_arquivo" => $row['caminho_arquivo'],
                    "tipo_arquivo" => $row['tipo_arquivo'],
                    "tipo_mime" => $row['tipo_mime'],
                ];
            }
        }

        return $sermon;
    }

    public function generateUniqueId(): string
    {
        $prefix = self::ID_PREFIX;
        $attempt = 0;

        do {
            $randomString = $this->generateRandomString(self::ID_LENGTH);
            $id = $prefix . $randomString;
            $attempt++;

            $exists = $this->checkIfIdExists($id);
        } while ($exists && $attempt < self::MAX_ID_GENERATION_ATTEMPTS);

        if ($exists) {
            $id = $this->generateFallbackId();
        }

        return $id;
    }

    private function generateRandomString(int $length): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    private function checkIfIdExists(string $id): bool
    {
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE id = ?";
        $statement = $this->database->prepare($query);
        $statement->execute([$id]);

        return $statement->fetchColumn() > 0;
    }

    private function generateFallbackId(): string
    {
        $timestamp = substr(str_replace('.', '', microtime(true)), -8);
        return self::ID_PREFIX . $timestamp;
    }

    public function generateSlug(string $title): string
    {
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $title), '-'));

        if ($this->slugExists($slug)) {
            $slug .= "-" . uniqid();
        }

        return $slug;
    }

    private function slugExists(string $slug): bool
    {
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE slug = ?";
        $statement = $this->database->prepare($query);
        $statement->execute([$slug]);

        return $statement->fetchColumn() > 0;
    }

    public function getPreachers(): array
    {
        $query = "SELECT DISTINCT pregador FROM {$this->table} WHERE pregador IS NOT NULL ORDER BY pregador";
        $statement = $this->database->query($query);

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }
}