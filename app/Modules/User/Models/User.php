<?php
namespace App\Modules\User\Models;

use App\Core\Model;
use PDO;
use PDOException;
use Exception;

class User extends Model
{
    protected string $table = "usuarios";

    private const ROLE_ADMIN = 'admin';
    private const ROLE_EDITOR = 'editor';
    private const STATUS_ACTIVE = 'ativo';
    private const STATUS_INACTIVE = 'inativo';
    private const DEFAULT_LIMIT = 50;
    private const MIN_PASSWORD_LENGTH = 6;
    private const MIN_NAME_LENGTH = 2;

    public function getAll(int $limit = self::DEFAULT_LIMIT): array
    {
        try {
            $query = "
                SELECT id, nome, email, papel, status, criado_em 
                FROM {$this->table} 
                ORDER BY id DESC 
                LIMIT :limit
            ";

            $statement = $this->database->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $exception) {
            throw new Exception("Erro ao buscar usuários: " . $exception->getMessage());
        }
    }

    public function search(string $query = ''): array
    {
        try {
            $sql = "
                SELECT id, nome, email, papel, status, criado_em 
                FROM {$this->table} 
                WHERE nome LIKE :q OR email LIKE :q 
                ORDER BY id DESC
            ";

            $statement = $this->database->prepare($sql);
            $statement->execute([':q' => "%{$query}%"]);

            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $exception) {
            throw new Exception("Erro na busca de usuários: " . $exception->getMessage());
        }
    }

    public function paginate(
        int $page = 1,
        int $perPage = 10,
        string $search = '',
        string $role = '',
        string $status = ''
    ): array {
        try {
            $offset = max(0, ($page - 1) * $perPage);
            $whereConditions = [];
            $parameters = [];

            $whereConditions = $this->buildWhereConditions($search, $role, $status, $parameters);
            $whereSQL = $whereConditions ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

            $total = $this->countTotalRecords($whereSQL, $parameters);
            $users = $this->fetchPaginatedUsers($whereSQL, $parameters, $perPage, $offset);

            return $this->buildPaginationResult($users, $total, $page, $perPage);
        } catch (PDOException $exception) {
            throw new Exception("Erro na paginação de usuários: " . $exception->getMessage());
        }
    }

    private function buildWhereConditions(string $search, string $role, string $status, array &$parameters): array
    {
        $whereConditions = [];

        if (!empty($search)) {
            $whereConditions[] = "(nome LIKE :search OR email LIKE :search)";
            $parameters[':search'] = "%$search%";
        }

        if (!empty($role) && in_array($role, [self::ROLE_ADMIN, self::ROLE_EDITOR])) {
            $whereConditions[] = "papel = :role";
            $parameters[':role'] = $role;
        }

        if (!empty($status) && in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE])) {
            $whereConditions[] = "status = :status";
            $parameters[':status'] = $status;
        }

        return $whereConditions;
    }

    private function countTotalRecords(string $whereSQL, array $parameters): int
    {
        $query = "SELECT COUNT(*) FROM {$this->table} {$whereSQL}";
        $statement = $this->database->prepare($query);
        $statement->execute($parameters);

        return (int) $statement->fetchColumn();
    }

    private function fetchPaginatedUsers(string $whereSQL, array $parameters, int $perPage, int $offset): array
    {
        $query = "
            SELECT id, nome, email, papel, status, criado_em 
            FROM {$this->table} 
            {$whereSQL}
            ORDER BY id DESC 
            LIMIT :limit OFFSET :offset
        ";

        $statement = $this->database->prepare($query);

        foreach ($parameters as $key => $value) {
            $statement->bindValue($key, $value);
        }

        $statement->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    private function buildPaginationResult(array $users, int $total, int $page, int $perPage): array
    {
        $lastPage = $total > 0 ? max(1, ceil($total / $perPage)) : 1;

        return [
            'data' => $users,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'lastPage' => $lastPage,
            'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
            'to' => $total > 0 ? min(($page * $perPage), $total) : 0,
        ];
    }

    public function findatabaseyId(int $id): ?array
    {
        try {
            $query = "
                SELECT id, nome, email, papel, status, criado_em, atualizado_em 
                FROM {$this->table} 
                WHERE id = ?
            ";

            $statement = $this->database->prepare($query);
            $statement->execute([$id]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $exception) {
            throw new Exception("Erro ao buscar usuário: " . $exception->getMessage());
        }
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        try {
            $query = "SELECT COUNT(*) FROM {$this->table} WHERE email = :email";
            $parameters = [':email' => $email];

            if ($excludeId) {
                $query .= " AND id != :id";
                $parameters[':id'] = $excludeId;
            }

            $statement = $this->database->prepare($query);
            $statement->execute($parameters);

            return $statement->fetchColumn() > 0;
        } catch (PDOException $exception) {
            throw new Exception("Erro ao verificar email: " . $exception->getMessage());
        }
    }

    public function create(array $data): bool
    {
        try {
            $this->validateUserData($data, true);

            if ($this->emailExists($data['email'])) {
                throw new Exception("O e-mail informado já está em uso.");
            }

            $query = "
                INSERT INTO {$this->table} 
                (nome, email, senha, papel, status, criado_em) 
                VALUES (:nome, :email, :senha, :papel, :status, NOW())
            ";

            $statement = $this->database->prepare($query);
            $result = $statement->execute([
                ':nome' => trim($data['nome']),
                ':email' => trim($data['email']),
                ':senha' => password_hash($data['senha'], PASSWORD_BCRYPT),
                ':papel' => $data['papel'] ?? self::ROLE_EDITOR,
                ':status' => $data['status'] ?? self::STATUS_ACTIVE,
            ]);

            if (!$result) {
                throw new Exception("Erro ao criar usuário no banco de dados.");
            }

            return true;
        } catch (PDOException $exception) {
            throw new Exception("Erro ao criar usuário: " . $exception->getMessage());
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $this->validateUserData($data, false);

            if ($this->emailExists($data['email'], $id)) {
                throw new Exception("O e-mail informado já está em uso por outro usuário.");
            }

            $user = $this->findatabaseyId($id);
            if (!$user) {
                throw new Exception("Usuário não encontrado.");
            }

            $updateData = $this->buildUpdateData($data, $id);
            $result = $this->executeUpdate($updateData);

            if (!$result) {
                throw new Exception("Erro ao atualizar usuário no banco de dados.");
            }

            return true;
        } catch (PDOException $exception) {
            throw new Exception("Erro ao atualizar usuário: " . $exception->getMessage());
        }
    }

    private function buildUpdateData(array $data, int $id): array
    {
        $updateData = [
            ':nome' => trim($data['nome']),
            ':email' => trim($data['email']),
            ':papel' => $data['papel'],
            ':status' => $data['status'],
            ':id' => $id
        ];

        if (!empty($data['senha'])) {
            $updateData[':senha'] = password_hash($data['senha'], PASSWORD_BCRYPT);
        }

        return $updateData;
    }

    private function executeUpdate(array $updateData): bool
    {
        $query = "
            UPDATE {$this->table} 
            SET nome = :nome, email = :email, papel = :papel, 
                status = :status, atualizado_em = NOW()
        ";

        if (isset($updateData[':senha'])) {
            $query .= ", senha = :senha";
        }

        $query .= " WHERE id = :id";

        $statement = $this->database->prepare($query);
        return $statement->execute($updateData);
    }

    public function toggleStatus(int $id): bool
    {
        try {
            $user = $this->findatabaseyId($id);
            if (!$user) {
                throw new Exception("Usuário não encontrado.");
            }

            $newStatus = $user['status'] === self::STATUS_ACTIVE
                ? self::STATUS_INACTIVE
                : self::STATUS_ACTIVE;

            $query = "
                UPDATE {$this->table} 
                SET status = :status, atualizado_em = NOW() 
                WHERE id = :id
            ";

            $statement = $this->database->prepare($query);
            return $statement->execute([
                ':status' => $newStatus,
                ':id' => $id
            ]);
        } catch (PDOException $exception) {
            throw new Exception("Erro ao alterar status do usuário: " . $exception->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $user = $this->findatabaseyId($id);
            if (!$user) {
                throw new Exception("Usuário não encontrado.");
            }

            if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['id'] == $id) {
                throw new Exception("Você não pode excluir sua própria conta.");
            }

            $statement = $this->database->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $statement->execute([$id]);
        } catch (PDOException $exception) {
            throw new Exception("Erro ao excluir usuário: " . $exception->getMessage());
        }
    }

    private function validateUserData(array $data, bool $requirePassword): void
    {
        if (empty($data['nome']) || strlen(trim($data['nome'])) < self::MIN_NAME_LENGTH) {
            throw new Exception("Nome deve ter pelo menos " . self::MIN_NAME_LENGTH . " caracteres.");
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido.");
        }

        if ($requirePassword && (empty($data['senha']) || strlen($data['senha']) < self::MIN_PASSWORD_LENGTH)) {
            throw new Exception("Senha deve ter pelo menos " . self::MIN_PASSWORD_LENGTH . " caracteres.");
        }

        $allowedRoles = [self::ROLE_ADMIN, self::ROLE_EDITOR];
        if (!empty($data['papel']) && !in_array($data['papel'], $allowedRoles)) {
            throw new Exception("Papel inválido.");
        }

        $allowedStatus = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];
        if (!empty($data['status']) && !in_array($data['status'], $allowedStatus)) {
            throw new Exception("Status inválido.");
        }
    }

    public function findatabaseyEmail(string $email): ?array
    {
        try {
            $query = "
                SELECT id, nome, email, senha, papel, status 
                FROM {$this->table} 
                WHERE email = ? AND status = :active
            ";

            $statement = $this->database->prepare($query);
            $statement->execute([$email, ':active' => self::STATUS_ACTIVE]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $exception) {
            throw new Exception("Erro ao buscar usuário por email: " . $exception->getMessage());
        }
    }
}