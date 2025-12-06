<?php
namespace App\Modules\Event\Models;

use App\Core\Model;
use PDO;

class Event extends Model
{
    protected string $table = "eventos";
    private const DEFAULT_STATUS = 'pendente';

    public function getAll(): array
    {
        $statement = $this->database->query("SELECT * FROM {$this->table} ORDER BY id DESC");
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
            {$whereClause} ORDER BY id DESC
            LIMIT {$perPage} OFFSET {$offset}
        ";

        $statement = $this->database->prepare($query);
        $statement->execute($parameters);
        $events = $statement->fetchAll(PDO::FETCH_ASSOC);

        $total = $this->getTotalRecords($whereClause, $parameters);
        $totalPages = ceil($total / $perPage);

        return [
            "data" => $events,
            "total" => $total,
            "page" => $page,
            "perPage" => $perPage,
            "pages" => $totalPages
        ];
    }

    private function applyFilters(string $whereClause, array &$parameters, array $filters): string
    {
        if (!empty($filters['search'])) {
            $whereClause .= " AND titulo LIKE :search";
            $parameters[':search'] = "%{$filters['search']}%";
        }

        if (!empty($filters['status'])) {
            $whereClause .= " AND status = :status";
            $parameters[':status'] = $filters['status'];
        }

        if (!empty($filters['data_inicio'])) {
            $whereClause .= " AND data_inicio >= :data_inicio";
            $parameters[':data_inicio'] = $filters['data_inicio'];
        }

        if (!empty($filters['data_fim'])) {
            $whereClause .= " AND data_fim <= :data_fim";
            $parameters[':data_fim'] = $filters['data_fim'];
        }

        if (!empty($filters['local'])) {
            $whereClause .= " AND local LIKE :local";
            $parameters[':local'] = "%{$filters['local']}%";
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

    public function createRecord(array $data): int
    {
        $data['slug'] = $this->generateSlug($data['titulo']);

        $query = "
            INSERT INTO {$this->table} 
            (titulo, descricao, local, data_inicio, data_fim, status, slug) 
            VALUES (:titulo, :descricao, :local, :data_inicio, :data_fim, :status, :slug)
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([
            ':titulo' => $data['titulo'],
            ':descricao' => $data['descricao'],
            ':local' => $data['local'],
            ':data_inicio' => $data['data_inicio'],
            ':data_fim' => $data['data_fim'] ?? null,
            ':status' => $data['status'] ?? self::DEFAULT_STATUS,
            ':slug' => $data['slug']
        ]);

        return (int) $this->database->lastInsertId();
    }

    public function updateRecord(int $id, array $data): bool
    {
        $query = "
            UPDATE {$this->table} 
            SET titulo=:titulo, descricao=:descricao, local=:local, 
                data_inicio=:data_inicio, data_fim=:data_fim, status=:status 
            WHERE id=:id
        ";

        $statement = $this->database->prepare($query);
        return $statement->execute([
            ':titulo' => $data['titulo'],
            ':descricao' => $data['descricao'],
            ':local' => $data['local'],
            ':data_inicio' => $data['data_inicio'],
            ':data_fim' => $data['data_fim'] ?? null,
            ':status' => $data['status'],
            ':id' => $id
        ]);
    }

    public function deleteRecord(int $id): bool
    {
        $statement = $this->database->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $statement->execute([$id]);
    }

    public function attachMedia(int $eventId, array $mediaIds): void
    {
        $query = "INSERT IGNORE INTO midia_eventos (midia_id, evento_id) VALUES (:midia_id, :evento_id)";
        $statement = $this->database->prepare($query);

        foreach ($mediaIds as $mediaId) {
            $statement->execute([
                ':midia_id' => $mediaId,
                ':evento_id' => $eventId
            ]);
        }
    }

    public function getAttachedMedia(int $eventId): array
    {
        $query = "
            SELECT m.* 
            FROM midia_eventos me
            JOIN midia m ON me.midia_id = m.id
            WHERE me.evento_id = ?
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$eventId]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detachMedia(int $eventId, int $mediaId): bool
    {
        $query = "DELETE FROM midia_eventos WHERE evento_id=? AND midia_id=?";
        $statement = $this->database->prepare($query);
        return $statement->execute([$eventId, $mediaId]);
    }

    public function findWithMedia(int $id): ?array
    {
        $query = "
            SELECT e.*, m.id AS midia_id, m.nome_arquivo, m.caminho_arquivo, m.tipo_arquivo, m.tipo_mime
            FROM {$this->table} e
            LEFT JOIN midia_eventos me ON me.evento_id = e.id
            LEFT JOIN midia m ON m.id = me.midia_id
            WHERE e.id = ?
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$id]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            return null;
        }

        $event = $this->buildEventFromRows($rows);
        return $event;
    }

    private function buildEventFromRows(array $rows): array
    {
        $firstRow = $rows[0];
        $event = [
            "id" => $firstRow['id'],
            "titulo" => $firstRow['titulo'],
            "descricao" => $firstRow['descricao'],
            "local" => $firstRow['local'],
            "data_inicio" => $firstRow['data_inicio'],
            "data_fim" => $firstRow['data_fim'],
            "status" => $firstRow['status'],
            "criado_em" => $firstRow['criado_em'],
            "atualizado_em" => $firstRow['atualizado_em'],
            "midias" => []
        ];

        foreach ($rows as $row) {
            if (!empty($row['midia_id'])) {
                $event['midias'][] = [
                    "id" => $row['midia_id'],
                    "nome_arquivo" => $row['nome_arquivo'],
                    "caminho_arquivo" => $row['caminho_arquivo'],
                    "tipo_arquivo" => $row['tipo_arquivo'],
                    "tipo_mime" => $row['tipo_mime'],
                ];
            }
        }

        return $event;
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

    public function getNextEvent(): ?array
    {
        $currentDate = date('Y-m-d H:i:s');

        $query = "
            SELECT * FROM {$this->table} 
            WHERE data_inicio > ? 
            AND (status = 'pendente' OR status = 'em andamento')
            ORDER BY data_inicio ASC 
            LIMIT 1
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$currentDate]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}