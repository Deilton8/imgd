<?php
namespace App\Modules\Contato\Models;

use App\Core\Model;
use PDO;
use PDOException;
use Exception;

class Mensagem extends Model
{
    protected string $table = "mensagens_contato";
    private const DEFAULT_LIMIT = 50;
    private const STATUS_LIDA = 'lida';
    private const STATUS_NAO_LIDA = 'nao_lida';
    private const STATUS_RESPONDIDA = 'respondida';
    private const DEFAULT_PER_PAGE = 10;

    public function getAll(int $limit = self::DEFAULT_LIMIT): array
    {
        try {
            $query = "
                SELECT id, nome, email, assunto, mensagem, 
                       DATE_FORMAT(criado_em, '%d/%m/%Y %H:%i') as criado_em_formatado,
                       criado_em 
                FROM {$this->table} 
                ORDER BY criado_em DESC 
                LIMIT :limit
            ";

            $statement = $this->database->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $exception) {
            throw new Exception("Erro ao buscar mensagens: " . $exception->getMessage());
        }
    }

    public function search(string $query = ''): array
    {
        try {
            $sql = "
                SELECT id, nome, email, assunto, mensagem, 
                       DATE_FORMAT(criado_em, '%d/%m/%Y %H:%i') as criado_em_formatado,
                       criado_em 
                FROM {$this->table} 
                WHERE nome LIKE :q OR email LIKE :q OR assunto LIKE :q 
                ORDER BY criado_em DESC
            ";

            $statement = $this->database->prepare($sql);
            $statement->execute([':q' => "%{$query}%"]);

            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $exception) {
            throw new Exception("Erro na busca de mensagens: " . $exception->getMessage());
        }
    }

    public function paginate(
        int $page = 1,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $search = ''
    ): array {
        try {
            $offset = max(0, ($page - 1) * $perPage);
            $whereConditions = [];
            $parameters = [];

            if (!empty($search)) {
                $whereConditions[] = "(nome LIKE :search OR email LIKE :search OR assunto LIKE :search)";
                $parameters[':search'] = "%$search%";
            }

            $whereSQL = $whereConditions ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

            // Contar total
            $countQuery = "SELECT COUNT(*) FROM {$this->table} {$whereSQL}";
            $countStatement = $this->database->prepare($countQuery);
            $countStatement->execute($parameters);
            $total = (int) $countStatement->fetchColumn();

            // Buscar mensagens paginadas
            $query = "
                SELECT id, nome, email, assunto, 
                       SUBSTRING(mensagem, 1, 100) as mensagem_preview,
                       mensagem,
                       DATE_FORMAT(criado_em, '%d/%m/%Y %H:%i') as criado_em_formatado,
                       criado_em 
                FROM {$this->table} 
                {$whereSQL}
                ORDER BY criado_em DESC 
                LIMIT :limit OFFSET :offset
            ";

            $statement = $this->database->prepare($query);

            foreach ($parameters as $key => $value) {
                $statement->bindValue($key, $value);
            }

            $statement->bindValue(':limit', $perPage, PDO::PARAM_INT);
            $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
            $statement->execute();

            $mensagens = $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];

            return $this->buildPaginationResult($mensagens, $total, $page, $perPage);
        } catch (PDOException $exception) {
            throw new Exception("Erro na paginação de mensagens: " . $exception->getMessage());
        }
    }

    private function buildPaginationResult(array $mensagens, int $total, int $page, int $perPage): array
    {
        $lastPage = $total > 0 ? max(1, ceil($total / $perPage)) : 1;

        return [
            'data' => $mensagens,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'lastPage' => $lastPage,
            'from' => $total > 0 ? (($page - 1) * $perPage) + 1 : 0,
            'to' => $total > 0 ? min(($page * $perPage), $total) : 0,
        ];
    }

    public function findById(int $id): ?array
    {
        try {
            $query = "
                SELECT id, nome, email, assunto, mensagem, 
                       DATE_FORMAT(criado_em, '%d/%m/%Y %H:%i') as criado_em_formatado,
                       criado_em 
                FROM {$this->table} 
                WHERE id = ?
            ";

            $statement = $this->database->prepare($query);
            $statement->execute([$id]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $exception) {
            throw new Exception("Erro ao buscar mensagem: " . $exception->getMessage());
        }
    }

    public function create(array $data): bool
    {
        try {
            $this->validateMensagemData($data);

            $query = "
                INSERT INTO {$this->table} 
                (nome, email, assunto, mensagem) 
                VALUES (:nome, :email, :assunto, :mensagem)
            ";

            $statement = $this->database->prepare($query);
            $result = $statement->execute([
                ':nome' => trim($data['nome']),
                ':email' => trim($data['email']),
                ':assunto' => trim($data['assunto']),
                ':mensagem' => trim($data['mensagem'])
            ]);

            if (!$result) {
                throw new Exception("Erro ao salvar mensagem no banco de dados.");
            }

            return true;
        } catch (PDOException $exception) {
            throw new Exception("Erro ao criar mensagem: " . $exception->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $mensagem = $this->findById($id);
            if (!$mensagem) {
                throw new Exception("Mensagem não encontrada.");
            }

            $statement = $this->database->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $statement->execute([$id]);
        } catch (PDOException $exception) {
            throw new Exception("Erro ao excluir mensagem: " . $exception->getMessage());
        }
    }

    public function getStats(): array
    {
        try {
            $query = "
                SELECT 
                    COUNT(*) as total,
                    COUNT(CASE WHEN DATE(criado_em) = CURDATE() THEN 1 END) as hoje,
                    COUNT(CASE WHEN DATE(criado_em) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) THEN 1 END) as ultima_semana,
                    COUNT(CASE WHEN DATE(criado_em) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) THEN 1 END) as ultimo_mes
                FROM {$this->table}
            ";

            $statement = $this->database->prepare($query);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return [
                'total' => (int) ($result['total'] ?? 0),
                'hoje' => (int) ($result['hoje'] ?? 0),
                'ultima_semana' => (int) ($result['ultima_semana'] ?? 0),
                'ultimo_mes' => (int) ($result['ultimo_mes'] ?? 0)
            ];
        } catch (PDOException $exception) {
            throw new Exception("Erro ao buscar estatísticas: " . $exception->getMessage());
        }
    }

    private function validateMensagemData(array $data): void
    {
        if (empty($data['nome']) || strlen(trim($data['nome'])) < 2) {
            throw new Exception("Nome deve ter pelo menos 2 caracteres.");
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido.");
        }

        if (empty($data['assunto']) || strlen(trim($data['assunto'])) < 3) {
            throw new Exception("Assunto deve ter pelo menos 3 caracteres.");
        }

        if (empty($data['mensagem']) || strlen(trim($data['mensagem'])) < 10) {
            throw new Exception("Mensagem deve ter pelo menos 10 caracteres.");
        }
    }

    public function getRecent(int $limit = 5): array
    {
        try {
            $query = "
                SELECT id, nome, email, assunto, 
                       SUBSTRING(mensagem, 1, 80) as mensagem_preview,
                       DATE_FORMAT(criado_em, '%d/%m/%Y %H:%i') as criado_em_formatado
                FROM {$this->table} 
                ORDER BY criado_em DESC 
                LIMIT :limit
            ";

            $statement = $this->database->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $exception) {
            throw new Exception("Erro ao buscar mensagens recentes: " . $exception->getMessage());
        }
    }
}