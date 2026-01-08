<?php
namespace App\Modules\Publication\Models;

use App\Core\Model;
use PDO;

class Publication extends Model
{
    protected string $table = "publicacoes";
    private const DEFAULT_CATEGORY = 'blog';
    private const DEFAULT_STATUS = 'rascunho';

    public function getAll(): array
    {
        $query = "SELECT * FROM {$this->table} ORDER BY publicado_em DESC, id DESC";
        $statement = $this->database->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findatabaseyId(int $id): ?array
    {
        $statement = $this->database->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $statement->execute([$id]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findatabaseySlug(string $slug): ?array
    {
        $statement = $this->database->prepare("SELECT * FROM {$this->table} WHERE slug = ?");
        $statement->execute([$slug]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function createRecord(array $data): int
    {
        $slug = $this->generateSlug($data['titulo']);

        $query = "
            INSERT INTO {$this->table} 
            (titulo, slug, conteudo, categoria, status, publicado_em, criado_em) 
            VALUES (:titulo, :slug, :conteudo, :categoria, :status, :publicado_em, NOW())
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([
            ':titulo' => $data['titulo'],
            ':slug' => $slug,
            ':conteudo' => $data['conteudo'],
            ':categoria' => $data['categoria'] ?? self::DEFAULT_CATEGORY,
            ':status' => $data['status'] ?? self::DEFAULT_STATUS,
            ':publicado_em' => !empty($data['publicado_em']) ? $data['publicado_em'] : null,
        ]);

        return (int) $this->database->lastInsertId();
    }

    public function updateRecord(int $id, array $data): bool
    {
        $slug = $this->generateSlug($data['titulo'], $id);

        $query = "
            UPDATE {$this->table} 
            SET titulo=:titulo, slug=:slug, conteudo=:conteudo, categoria=:categoria, 
                status=:status, publicado_em=:publicado_em, atualizado_em=NOW()
            WHERE id=:id
        ";

        $statement = $this->database->prepare($query);

        return $statement->execute([
            ':titulo' => $data['titulo'],
            ':slug' => $slug,
            ':conteudo' => $data['conteudo'],
            ':categoria' => $data['categoria'],
            ':status' => $data['status'],
            ':publicado_em' => !empty($data['publicado_em']) ? $data['publicado_em'] : null,
            ':id' => $id
        ]);
    }

    public function deleteRecord(int $id): bool
    {
        $statement = $this->database->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $statement->execute([$id]);
    }

    public function attachMedia(int $publicationId, array $mediaIds): void
    {
        if (empty($mediaIds)) {
            return;
        }

        $query = "INSERT IGNORE INTO midia_publicacoes (midia_id, publicacao_id) VALUES (:midia_id, :publicacao_id)";
        $statement = $this->database->prepare($query);

        foreach ($mediaIds as $mediaId) {
            $statement->execute([
                ':midia_id' => $mediaId,
                ':publicacao_id' => $publicationId
            ]);
        }
    }

    public function detachAllMedia(int $publicationId): bool
    {
        $statement = $this->database->prepare("DELETE FROM midia_publicacoes WHERE publicacao_id = ?");
        return $statement->execute([$publicationId]);
    }

    public function getMedia(int $publicationId): array
    {
        $query = "
            SELECT m.* 
            FROM midia_publicacoes mp
            JOIN midia m ON mp.midia_id = m.id
            WHERE mp.publicacao_id = ?
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$publicationId]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detachMedia(int $publicationId, int $mediaId): bool
    {
        $statement = $this->database->prepare("DELETE FROM midia_publicacoes WHERE publicacao_id=? AND midia_id=?");
        return $statement->execute([$publicationId, $mediaId]);
    }

    public function findWithMedia(int $id): ?array
    {
        $query = "
            SELECT p.*, m.id AS midia_id, m.nome_arquivo, m.caminho_arquivo, m.tipo_arquivo, m.tipo_mime
            FROM {$this->table} p
            LEFT JOIN midia_publicacoes mp ON mp.publicacao_id = p.id
            LEFT JOIN midia m ON m.id = mp.midia_id
            WHERE p.id = ?
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$id]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            return null;
        }

        $publication = $this->buildPublicationFromRows($rows);
        return $publication;
    }

    private function buildPublicationFromRows(array $rows): array
    {
        $firstRow = $rows[0];
        $publication = [
            "id" => $firstRow['id'],
            "titulo" => $firstRow['titulo'],
            "slug" => $firstRow['slug'],
            "conteudo" => $firstRow['conteudo'],
            "categoria" => $firstRow['categoria'],
            "status" => $firstRow['status'],
            "publicado_em" => $firstRow['publicado_em'],
            "criado_em" => $firstRow['criado_em'],
            "atualizado_em" => $firstRow['atualizado_em'],
            "midias" => []
        ];

        foreach ($rows as $row) {
            if (!empty($row['midia_id'])) {
                $publication['midias'][] = [
                    "id" => $row['midia_id'],
                    "nome_arquivo" => $row['nome_arquivo'],
                    "caminho_arquivo" => $row['caminho_arquivo'],
                    "tipo_arquivo" => $row['tipo_arquivo'],
                    "tipo_mime" => $row['tipo_mime'],
                ];
            }
        }

        return $publication;
    }

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
        SELECT p.*, m.id AS midia_id, m.nome_arquivo, m.caminho_arquivo, m.tipo_arquivo, m.tipo_mime
        FROM {$this->table} p
        LEFT JOIN midia_publicacoes mp ON mp.publicacao_id = p.id
        LEFT JOIN midia m ON m.id = mp.midia_id
        WHERE p.slug = ?
    ";

        $statement = $this->database->prepare($query);
        $statement->execute([$slug]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            return null;
        }

        $publication = $this->buildPublicationFromRows($rows);
        return $publication;
    }

    private function generateSlug(string $title, ?int $excludeId = null): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $slug = preg_replace('/-+/', '-', trim($slug, '-'));

        if (empty($slug)) {
            $slug = 'publicacao';
        }

        $slug = $this->ensureUniqueSlug($slug, $excludeId);
        return $slug;
    }

    private function ensureUniqueSlug(string $slug, ?int $excludeId): string
    {
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE slug = ?";
        $parameters = [$slug];

        if ($excludeId) {
            $query .= " AND id != ?";
            $parameters[] = $excludeId;
        }

        $statement = $this->database->prepare($query);
        $statement->execute($parameters);
        $count = $statement->fetchColumn();

        return $count > 0 ? $slug . '-' . ($count + 1) : $slug;
    }
}