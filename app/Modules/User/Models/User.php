<?php
namespace App\Modules\User\Models;

use App\Core\Model;
use PDO;
use PDOException;
use Exception;

class User extends Model
{
    protected $table = "usuarios";

    // Constantes para evitar magic strings
    const ROLE_ADMIN = 'admin';
    const ROLE_EDITOR = 'editor';
    const STATUS_ACTIVE = 'ativo';
    const STATUS_INACTIVE = 'inativo';

    public function all(int $limit = 50): array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, nome, email, papel, status, criado_em 
                FROM {$this->table} 
                ORDER BY id DESC 
                LIMIT :limit
            ");
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar usuários: " . $e->getMessage());
        }
    }

    public function search(string $query = ''): array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, nome, email, papel, status, criado_em 
                FROM {$this->table} 
                WHERE nome LIKE :q OR email LIKE :q 
                ORDER BY id DESC
            ");
            $stmt->execute([':q' => "%{$query}%"]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            throw new Exception("Erro na busca de usuários: " . $e->getMessage());
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
            $where = [];
            $params = [];

            // Filtros com validação
            if (!empty($search)) {
                $where[] = "(nome LIKE :search OR email LIKE :search)";
                $params[':search'] = "%$search%";
            }

            if (!empty($role) && in_array($role, [self::ROLE_ADMIN, self::ROLE_EDITOR])) {
                $where[] = "papel = :role";
                $params[':role'] = $role;
            }

            if (!empty($status) && in_array($status, [self::STATUS_ACTIVE, self::STATUS_INACTIVE])) {
                $where[] = "status = :status";
                $params[':status'] = $status;
            }

            $whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

            // Total de registros
            $stmtTotal = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} {$whereSQL}");
            $stmtTotal->execute($params);
            $total = (int) $stmtTotal->fetchColumn();

            // Registros da página
            $stmt = $this->db->prepare("
                SELECT id, nome, email, papel, status, criado_em 
                FROM {$this->table} 
                {$whereSQL}
                ORDER BY id DESC 
                LIMIT :limit OFFSET :offset
            ");

            foreach ($params as $key => $val) {
                $stmt->bindValue($key, $val);
            }

            $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $lastPage = $total > 0 ? max(1, ceil($total / $perPage)) : 1;

            return [
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [],
                'total' => $total,
                'page' => $page,
                'perPage' => $perPage,
                'lastPage' => $lastPage,
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => $total > 0 ? min($offset + $perPage, $total) : 0,
            ];
        } catch (PDOException $e) {
            throw new Exception("Erro na paginação de usuários: " . $e->getMessage());
        }
    }

    public function find(int $id): ?array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, nome, email, papel, status, criado_em, atualizado_em 
                FROM {$this->table} 
                WHERE id = ?
            ");
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar usuário: " . $e->getMessage());
        }
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        try {
            $sql = "SELECT COUNT(*) FROM {$this->table} WHERE email = :email";
            $params = [':email' => $email];

            if ($excludeId) {
                $sql .= " AND id != :id";
                $params[':id'] = $excludeId;
            }

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            throw new Exception("Erro ao verificar email: " . $e->getMessage());
        }
    }

    public function create(array $data): bool
    {
        try {
            $this->validateUserData($data);

            if ($this->emailExists($data['email'])) {
                throw new Exception("O e-mail informado já está em uso.");
            }

            $stmt = $this->db->prepare("
                INSERT INTO {$this->table} 
                (nome, email, senha, papel, status, criado_em) 
                VALUES (:nome, :email, :senha, :papel, :status, NOW())
            ");

            $result = $stmt->execute([
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
        } catch (PDOException $e) {
            throw new Exception("Erro ao criar usuário: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $this->validateUserData($data, false); // false para não exigir senha

            if ($this->emailExists($data['email'], $id)) {
                throw new Exception("O e-mail informado já está em uso por outro usuário.");
            }

            $user = $this->find($id);
            if (!$user) {
                throw new Exception("Usuário não encontrado.");
            }

            $query = "
                UPDATE {$this->table} 
                SET nome = :nome, email = :email, papel = :papel, 
                    status = :status, atualizado_em = NOW()
            ";

            $params = [
                ':nome' => trim($data['nome']),
                ':email' => trim($data['email']),
                ':papel' => $data['papel'],
                ':status' => $data['status'],
                ':id' => $id
            ];

            if (!empty($data['senha'])) {
                $query .= ", senha = :senha";
                $params[':senha'] = password_hash($data['senha'], PASSWORD_BCRYPT);
            }

            $query .= " WHERE id = :id";

            $stmt = $this->db->prepare($query);
            $result = $stmt->execute($params);

            if (!$result) {
                throw new Exception("Erro ao atualizar usuário no banco de dados.");
            }

            return true;
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar usuário: " . $e->getMessage());
        }
    }

    public function toggleStatus(int $id): bool
    {
        try {
            $user = $this->find($id);
            if (!$user) {
                throw new Exception("Usuário não encontrado.");
            }

            $newStatus = $user['status'] === self::STATUS_ACTIVE
                ? self::STATUS_INACTIVE
                : self::STATUS_ACTIVE;

            $stmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET status = :status, atualizado_em = NOW() 
                WHERE id = :id
            ");

            return $stmt->execute([
                ':status' => $newStatus,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao alterar status do usuário: " . $e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $user = $this->find($id);
            if (!$user) {
                throw new Exception("Usuário não encontrado.");
            }

            // Impedir que o usuário exclua a si mesmo
            if (isset($_SESSION['usuario']['id']) && $_SESSION['usuario']['id'] == $id) {
                throw new Exception("Você não pode excluir sua própria conta.");
            }

            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir usuário: " . $e->getMessage());
        }
    }

    /**
     * Valida dados do usuário
     */
    private function validateUserData(array $data, bool $requirePassword = true): void
    {
        if (empty($data['nome']) || strlen(trim($data['nome'])) < 2) {
            throw new Exception("Nome deve ter pelo menos 2 caracteres.");
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido.");
        }

        if ($requirePassword && (empty($data['senha']) || strlen($data['senha']) < 6)) {
            throw new Exception("Senha deve ter pelo menos 6 caracteres.");
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

    /**
     * Busca usuário por email (útil para login)
     */
    public function findByEmail(string $email): ?array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, nome, email, senha, papel, status 
                FROM {$this->table} 
                WHERE email = ? AND status = :active
            ");
            $stmt->execute([$email, ':active' => self::STATUS_ACTIVE]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar usuário por email: " . $e->getMessage());
        }
    }
}