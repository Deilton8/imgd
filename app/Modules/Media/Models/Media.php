<?php
namespace App\Modules\Media\Models;

use App\Core\Model;
use PDO;

class Media extends Model
{
    protected string $table = "midia";
    private const DEFAULT_LIMIT = 50;

    public function getAll(array $filters = [], int $limit = self::DEFAULT_LIMIT, int $offset = 0): array
    {
        $query = "SELECT * FROM {$this->table} WHERE 1=1";
        $parameters = [];

        if (!empty($filters['tipo'])) {
            $query .= " AND tipo_arquivo = :tipo";
            $parameters[':tipo'] = $filters['tipo'];
        }

        if (!empty($filters['q'])) {
            $query .= " AND nome_arquivo LIKE :q";
            $parameters[':q'] = "%{$filters['q']}%";
        }

        $query .= " ORDER BY criado_em DESC LIMIT :limit OFFSET :offset";

        $statement = $this->database->prepare($query);

        foreach ($parameters as $key => $value) {
            $statement->bindValue($key, $value);
        }

        $statement->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countRecords(array $filters = []): int
    {
        $query = "SELECT COUNT(*) AS total FROM {$this->table} WHERE 1=1";
        $parameters = [];

        if (!empty($filters['tipo'])) {
            $query .= " AND tipo_arquivo = :tipo";
            $parameters[':tipo'] = $filters['tipo'];
        }

        if (!empty($filters['q'])) {
            $query .= " AND nome_arquivo LIKE :q";
            $parameters[':q'] = "%{$filters['q']}%";
        }

        $statement = $this->database->prepare($query);
        $statement->execute($parameters);

        return (int) $statement->fetchColumn();
    }

    public function findatabaseyId(int $id): ?array
    {
        $statement = $this->database->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $statement->execute([$id]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function createRecord(array $data): bool
    {
        $query = "
            INSERT INTO {$this->table} 
            (caminho_arquivo, nome_arquivo, tipo_mime, tipo_arquivo, tamanho, criado_em) 
            VALUES (:caminho_arquivo, :nome_arquivo, :tipo_mime, :tipo_arquivo, :tamanho, NOW())
        ";

        $statement = $this->database->prepare($query);

        return $statement->execute([
            ':caminho_arquivo' => $data['caminho_arquivo'],
            ':nome_arquivo' => $data['nome_arquivo'],
            ':tipo_mime' => $data['tipo_mime'],
            ':tipo_arquivo' => $data['tipo_arquivo'],
            ':tamanho' => $data['tamanho']
        ]);
    }

    public function deleteRecord(int $id): bool
    {
        $statement = $this->database->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $statement->execute([$id]);
    }
}