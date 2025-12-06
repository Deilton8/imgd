<?php
namespace App\Modules\Auth\Models;

use App\Core\Model;
use PDO;
use DateTime;
use Exception;
use PDOException;

class Auth extends Model
{
    private const ATTEMPT_PREFIX_EMAIL = 'login_attempts_email_';
    private const ATTEMPT_PREFIX_IP = 'login_attempts_ip_';
    private const MAX_ATTEMPTS = 5;
    private const LOCKOUT_MINUTES = 15;
    private const REMEMBER_DAYS = 30;
    private const RESET_EXPIRATION_HOURS = 2;

    protected string $table = "usuarios";

    public function attempt(string $email, string $password): array
    {
        try {
            if ($this->isAccountLocked($email)) {
                $remainingTime = $this->getRemainingLockoutTime($email);
                $this->logAuthAction(null, $email, 'login_failed', 'Conta bloqueada temporariamente');
                return $this->createFailureResponse("Muitas tentativas falhas. Tente novamente em {$remainingTime}.");
            }

            $user = $this->findUserByEmail($email);

            if (!$user) {
                $this->registerFailedAttempt($email);
                $this->logAuthAction(null, $email, 'login_failed', 'Email não encontrado');
                return $this->createFailureResponse('Credenciais inválidas.');
            }

            if (!$this->isUserActive($user)) {
                $this->logAuthAction($user['id'], $user['email'], 'login_failed', 'Conta inativa');
                return $this->createFailureResponse('Conta inativa. Contate o administrador.');
            }

            if (!$this->validatePassword($password, $user["senha"])) {
                $this->registerFailedAttempt($email);
                $this->logAuthAction($user['id'], $user['email'], 'login_failed', 'Senha incorreta');
                return $this->createFailureResponse('Credenciais inválidas.');
            }

            return $this->handleSuccessfulLogin($user);

        } catch (PDOException $exception) {
            error_log("Erro no login: " . $exception->getMessage());
            return $this->createFailureResponse('Erro interno do sistema. Tente novamente.');
        }
    }

    private function findUserByEmail(string $email): ?array
    {
        $query = "
            SELECT id, nome, email, senha, papel, status, ultimo_login 
            FROM {$this->table} 
            WHERE email = ? 
            LIMIT 1
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$email]);

        return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    private function registerFailedAttempt(string $email): void
    {
        $ipAddress = $this->getClientIP();
        $emailKey = self::ATTEMPT_PREFIX_EMAIL . md5($email);
        $ipKey = self::ATTEMPT_PREFIX_IP . md5($ipAddress);

        $this->incrementAttemptCount($emailKey);
        $this->incrementAttemptCount($ipKey);
    }

    private function incrementAttemptCount(string $key): void
    {
        $attempts = $_SESSION[$key]['count'] ?? 0;
        $_SESSION[$key] = [
            'count' => $attempts + 1,
            'time' => time(),
            'ip' => $this->getClientIP()
        ];
    }

    private function resetAttempts(string $email): void
    {
        $ipAddress = $this->getClientIP();
        $emailKey = self::ATTEMPT_PREFIX_EMAIL . md5($email);
        $ipKey = self::ATTEMPT_PREFIX_IP . md5($ipAddress);

        unset($_SESSION[$emailKey], $_SESSION[$ipKey]);
    }

    private function isAccountLocked(string $email): bool
    {
        $ipAddress = $this->getClientIP();
        $emailKey = self::ATTEMPT_PREFIX_EMAIL . md5($email);
        $ipKey = self::ATTEMPT_PREFIX_IP . md5($ipAddress);

        return $this->checkLockoutStatus($emailKey) || $this->checkLockoutStatus($ipKey);
    }

    private function checkLockoutStatus(string $key): bool
    {
        if (!isset($_SESSION[$key])) {
            return false;
        }

        $attemptCount = $_SESSION[$key]['count'];
        $attemptTime = $_SESSION[$key]['time'];
        $lockoutDuration = self::LOCKOUT_MINUTES * 60;

        if ($attemptCount >= self::MAX_ATTEMPTS && (time() - $attemptTime) < $lockoutDuration) {
            return true;
        }

        if ((time() - $attemptTime) >= $lockoutDuration) {
            unset($_SESSION[$key]);
        }

        return false;
    }

    private function getRemainingLockoutTime(string $email): string
    {
        $ipAddress = $this->getClientIP();
        $emailKey = self::ATTEMPT_PREFIX_EMAIL . md5($email);
        $ipKey = self::ATTEMPT_PREFIX_IP . md5($ipAddress);

        $remainingSeconds = 0;

        foreach ([$emailKey, $ipKey] as $key) {
            if (isset($_SESSION[$key])) {
                $elapsedTime = time() - $_SESSION[$key]['time'];
                $remainingSeconds = max($remainingSeconds, (self::LOCKOUT_MINUTES * 60) - $elapsedTime);
            }
        }

        $minutes = ceil($remainingSeconds / 60);
        return "{$minutes} " . ($minutes == 1 ? 'minuto' : 'minutos');
    }

    private function handleSuccessfulLogin(array $user): array
    {
        $this->resetAttempts($user['email']);
        $this->registerSuccessfulLogin($user['id']);
        $this->logAuthAction($user['id'], $user['email'], 'login_success');

        return [
            'success' => true,
            'usuario' => $user
        ];
    }

    private function registerSuccessfulLogin(int $userId): void
    {
        $query = "
            UPDATE {$this->table} 
            SET ultimo_login = NOW(), 
                tentativas_login = 0 
            WHERE id = ?
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$userId]);
    }

    public function generateLoginToken(int $userId): bool
    {
        try {
            $token = bin2hex(random_bytes(32));
            $expiration = (new DateTime('+' . self::REMEMBER_DAYS . ' days'))->format('Y-m-d H:i:s');

            $query = "
                UPDATE {$this->table} 
                SET remember_token = ?, remember_expires = ? 
                WHERE id = ?
            ";

            $statement = $this->database->prepare($query);
            $result = $statement->execute([$token, $expiration, $userId]);

            if ($result) {
                $this->setRememberCookie($token);
                return true;
            }

            return false;
        } catch (Exception $exception) {
            error_log("Erro ao gerar token: " . $exception->getMessage());
            return false;
        }
    }

    private function setRememberCookie(string $token): void
    {
        setcookie(
            'remember_token',
            $token,
            [
                'expires' => time() + (self::REMEMBER_DAYS * 86400),
                'path' => '/',
                'domain' => '',
                'secure' => isset($_SERVER['HTTPS']),
                'httponly' => true,
                'samesite' => 'Strict'
            ]
        );
    }

    public function authenticateByToken(string $token): ?array
    {
        try {
            $query = "
                SELECT id, nome, email, papel, status, remember_expires 
                FROM {$this->table} 
                WHERE remember_token = ? 
                AND status = 'ativo' 
                AND remember_expires > NOW() 
                LIMIT 1
            ";

            $statement = $this->database->prepare($query);
            $statement->execute([$token]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $this->logAuthAction($user['id'], $user['email'], 'token_used');
            }

            return $user ?: null;
        } catch (PDOException $exception) {
            error_log("Erro na autenticação por token: " . $exception->getMessage());
            return null;
        }
    }

    public function generateRecoveryToken(string $email): ?string
    {
        try {
            $user = $this->findUserByEmail($email);

            if (!$user) {
                return null;
            }

            if ($this->hasValidRecoveryToken($user['id'])) {
                return null;
            }

            $token = bin2hex(random_bytes(32));
            $expiration = (new DateTime('+' . self::RESET_EXPIRATION_HOURS . ' hours'))->format('Y-m-d H:i:s');

            $query = "
                UPDATE {$this->table} 
                SET reset_token = ?, reset_expires = ? 
                WHERE id = ?
            ";

            $statement = $this->database->prepare($query);
            $result = $statement->execute([$token, $expiration, $user['id']]);

            if ($result) {
                $this->logAuthAction($user['id'], $email, 'password_reset', 'Token gerado');
            }

            return $result ? $token : null;

        } catch (PDOException $exception) {
            error_log("Erro ao gerar token de recuperação: " . $exception->getMessage());
            return null;
        }
    }

    private function hasValidRecoveryToken(int $userId): bool
    {
        $query = "
            SELECT reset_token, reset_expires 
            FROM {$this->table} 
            WHERE id = ? AND reset_expires > NOW()
        ";

        $statement = $this->database->prepare($query);
        $statement->execute([$userId]);

        return (bool) $statement->fetch();
    }

    public function validateRecoveryToken(string $token): ?array
    {
        try {
            $query = "
                SELECT id, email, reset_expires 
                FROM {$this->table} 
                WHERE reset_token = ? 
                AND reset_expires > NOW() 
                LIMIT 1
            ";

            $statement = $this->database->prepare($query);
            $statement->execute([$token]);

            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $exception) {
            error_log("Erro ao validar token: " . $exception->getMessage());
            return null;
        }
    }

    public function updatePassword(int $userId, string $newPassword): bool
    {
        try {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

            $query = "
                UPDATE {$this->table} 
                SET senha = ?, 
                    reset_token = NULL, 
                    reset_expires = NULL,
                    atualizado_em = NOW()
                WHERE id = ?
            ";

            $statement = $this->database->prepare($query);
            $result = $statement->execute([$passwordHash, $userId]);

            if ($result) {
                $this->logAuthAction($userId, '', 'password_reset', 'Senha alterada');
            }

            return $result;
        } catch (PDOException $exception) {
            error_log("Erro ao atualizar senha: " . $exception->getMessage());
            return false;
        }
    }

    public function clearLoginToken(int $userId): bool
    {
        try {
            $query = "
                UPDATE {$this->table} 
                SET remember_token = NULL, 
                    remember_expires = NULL 
                WHERE id = ?
            ";

            $statement = $this->database->prepare($query);
            return $statement->execute([$userId]);
        } catch (PDOException $exception) {
            error_log("Erro ao limpar token: " . $exception->getMessage());
            return false;
        }
    }

    public function getRemainingAttempts(string $email): int
    {
        $key = self::ATTEMPT_PREFIX_EMAIL . md5($email);

        if (!isset($_SESSION[$key])) {
            return self::MAX_ATTEMPTS;
        }

        $attemptCount = $_SESSION[$key]['count'];
        return max(0, self::MAX_ATTEMPTS - $attemptCount);
    }

    public function logAuthAction($userId, string $email, string $type, string $description = ''): void
    {
        try {
            $query = "
                INSERT INTO auth_logs 
                (usuario_id, email, ip_address, user_agent, tipo, descricao) 
                VALUES (?, ?, ?, ?, ?, ?)
            ";

            $statement = $this->database->prepare($query);
            $statement->execute([
                $userId,
                $email,
                $this->getClientIP(),
                $_SERVER['HTTP_USER_AGENT'] ?? '',
                $type,
                $description
            ]);
        } catch (PDOException $exception) {
            error_log("Erro ao registrar log: " . $exception->getMessage());
        }
    }

    public function getAuthLogs(int $limit = 100): array
    {
        try {
            $query = "
                SELECT al.*, u.nome as usuario_nome 
                FROM auth_logs al 
                LEFT JOIN usuarios u ON al.usuario_id = u.id 
                ORDER BY al.created_at DESC 
                LIMIT ?
            ";

            $statement = $this->database->prepare($query);
            $statement->execute([$limit]);

            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $exception) {
            error_log("Erro ao buscar logs: " . $exception->getMessage());
            return [];
        }
    }

    private function getClientIP(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        }
    }

    private function createFailureResponse(string $errorMessage): array
    {
        return [
            'success' => false,
            'error' => $errorMessage
        ];
    }

    private function isUserActive(array $user): bool
    {
        return $user['status'] === 'ativo';
    }

    private function validatePassword(string $password, string $passwordHash): bool
    {
        return password_verify($password, $passwordHash);
    }
}