<?php
namespace App\Modules\Auth\Models;

use App\Core\Model;
use PDO;
use DateTime;
use Exception;
use PDOException;

class Auth extends Model
{
    protected $table = "usuarios";

    // Configurações de segurança
    private const MAX_TENTATIVAS = 5;
    private const BLOQUEIO_MINUTOS = 15;
    private const REMEMBER_DAYS = 30;
    private const RESET_EXPIRATION_HOURS = 2;

    public function attempt(string $email, string $senha): array
    {
        try {
            // Verifica bloqueio por IP e email
            if ($this->estaBloqueado($email)) {
                $tempoRestante = $this->getTempoBloqueioRestante($email);
                $this->registrarLog(null, $email, 'login_failed', 'Conta bloqueada temporariamente');
                return [
                    'success' => false,
                    'error' => "Muitas tentativas falhas. Tente novamente em {$tempoRestante}."
                ];
            }

            $usuario = $this->buscarUsuarioPorEmail($email);

            if (!$usuario) {
                $this->registrarTentativaFalha($email);
                $this->registrarLog(null, $email, 'login_failed', 'Email não encontrado');
                return [
                    'success' => false,
                    'error' => 'Credenciais inválidas.'
                ];
            }

            // Verifica status da conta
            if ($usuario['status'] !== 'ativo') {
                $this->registrarLog($usuario['id'], $usuario['email'], 'login_failed', 'Conta inativa');
                return [
                    'success' => false,
                    'error' => 'Conta inativa. Contate o administrador.'
                ];
            }

            // Verifica senha
            if (!password_verify($senha, $usuario["senha"])) {
                $this->registrarTentativaFalha($email);
                $this->registrarLog($usuario['id'], $usuario['email'], 'login_failed', 'Senha incorreta');
                return [
                    'success' => false,
                    'error' => 'Credenciais inválidas.'
                ];
            }

            // Login bem-sucedido
            $this->resetarTentativas($email);
            $this->registrarLoginBemSucedido($usuario['id']);
            $this->registrarLog($usuario['id'], $usuario['email'], 'login_success');

            return [
                'success' => true,
                'usuario' => $usuario
            ];

        } catch (PDOException $e) {
            error_log("Erro no login: " . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Erro interno do sistema. Tente novamente.'
            ];
        }
    }

    private function buscarUsuarioPorEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("
            SELECT id, nome, email, senha, papel, status, ultimo_login 
            FROM {$this->table} 
            WHERE email = ? 
            LIMIT 1
        ");
        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    private function registrarTentativaFalha(string $email): void
    {
        $ip = $this->getClientIP();
        $keyEmail = "login_attempts_email_" . md5($email);
        $keyIP = "login_attempts_ip_" . md5($ip);

        $this->incrementarTentativa($keyEmail);
        $this->incrementarTentativa($keyIP);
    }

    private function incrementarTentativa(string $key): void
    {
        $tentativas = $_SESSION[$key]['count'] ?? 0;
        $_SESSION[$key] = [
            'count' => $tentativas + 1,
            'time' => time(),
            'ip' => $this->getClientIP()
        ];
    }

    private function resetarTentativas(string $email): void
    {
        $ip = $this->getClientIP();
        $keyEmail = "login_attempts_email_" . md5($email);
        $keyIP = "login_attempts_ip_" . md5($ip);

        unset($_SESSION[$keyEmail], $_SESSION[$keyIP]);
    }

    private function estaBloqueado(string $email): bool
    {
        $ip = $this->getClientIP();
        $keyEmail = "login_attempts_email_" . md5($email);
        $keyIP = "login_attempts_ip_" . md5($ip);

        return $this->verificarBloqueio($keyEmail) || $this->verificarBloqueio($keyIP);
    }

    private function verificarBloqueio(string $key): bool
    {
        if (!isset($_SESSION[$key])) {
            return false;
        }

        $tentativas = $_SESSION[$key]['count'];
        $tempo = $_SESSION[$key]['time'];
        $tempoExpiracao = self::BLOQUEIO_MINUTOS * 60;

        if ($tentativas >= self::MAX_TENTATIVAS && (time() - $tempo) < $tempoExpiracao) {
            return true;
        }

        // Limpa tentativas expiradas
        if ((time() - $tempo) >= $tempoExpiracao) {
            unset($_SESSION[$key]);
        }

        return false;
    }

    private function getTempoBloqueioRestante(string $email): string
    {
        $ip = $this->getClientIP();
        $keyEmail = "login_attempts_email_" . md5($email);
        $keyIP = "login_attempts_ip_" . md5($ip);

        $tempoRestante = 0;

        foreach ([$keyEmail, $keyIP] as $key) {
            if (isset($_SESSION[$key])) {
                $tempoDecorrido = time() - $_SESSION[$key]['time'];
                $tempoRestante = max($tempoRestante, (self::BLOQUEIO_MINUTOS * 60) - $tempoDecorrido);
            }
        }

        $minutos = ceil($tempoRestante / 60);
        return "{$minutos} " . ($minutos == 1 ? 'minuto' : 'minutos');
    }

    private function registrarLoginBemSucedido(int $usuarioId): void
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET ultimo_login = NOW(), 
                tentativas_login = 0 
            WHERE id = ?
        ");
        $stmt->execute([$usuarioId]);
    }

    public function gerarTokenLogin(int $usuarioId): bool
    {
        try {
            $token = bin2hex(random_bytes(32));
            $expira = (new DateTime('+' . self::REMEMBER_DAYS . ' days'))->format('Y-m-d H:i:s');

            $stmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET remember_token = ?, remember_expires = ? 
                WHERE id = ?
            ");

            $result = $stmt->execute([$token, $expira, $usuarioId]);

            if ($result) {
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
                return true;
            }

            return false;
        } catch (Exception $e) {
            error_log("Erro ao gerar token: " . $e->getMessage());
            return false;
        }
    }

    public function autenticarPorToken(string $token): ?array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, nome, email, papel, status, remember_expires 
                FROM {$this->table} 
                WHERE remember_token = ? 
                AND status = 'ativo' 
                AND remember_expires > NOW() 
                LIMIT 1
            ");
            $stmt->execute([$token]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                $this->registrarLog($usuario['id'], $usuario['email'], 'token_used');
            }

            return $usuario ?: null;
        } catch (PDOException $e) {
            error_log("Erro na autenticação por token: " . $e->getMessage());
            return null;
        }
    }

    public function gerarTokenRecuperacao(string $email): ?string
    {
        try {
            $usuario = $this->buscarUsuarioPorEmail($email);

            if (!$usuario) {
                return null;
            }

            // Previne spam - verifica se já existe token recente
            $stmt = $this->db->prepare("
                SELECT reset_token, reset_expires 
                FROM {$this->table} 
                WHERE id = ? AND reset_expires > NOW()
            ");
            $stmt->execute([$usuario['id']]);

            if ($stmt->fetch()) {
                return null; // Já existe token válido
            }

            $token = bin2hex(random_bytes(32));
            $expira = (new DateTime('+' . self::RESET_EXPIRATION_HOURS . ' hours'))->format('Y-m-d H:i:s');

            $stmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET reset_token = ?, reset_expires = ? 
                WHERE id = ?
            ");

            $result = $stmt->execute([$token, $expira, $usuario['id']]);

            if ($result) {
                $this->registrarLog($usuario['id'], $email, 'password_reset', 'Token gerado');
            }

            return $result ? $token : null;

        } catch (PDOException $e) {
            error_log("Erro ao gerar token de recuperação: " . $e->getMessage());
            return null;
        }
    }

    public function validarTokenRecuperacao(string $token): ?array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT id, email, reset_expires 
                FROM {$this->table} 
                WHERE reset_token = ? 
                AND reset_expires > NOW() 
                LIMIT 1
            ");
            $stmt->execute([$token]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario ?: null;
        } catch (PDOException $e) {
            error_log("Erro ao validar token: " . $e->getMessage());
            return null;
        }
    }

    public function atualizarSenha(int $usuarioId, string $novaSenha): bool
    {
        try {
            $hash = password_hash($novaSenha, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET senha = ?, 
                    reset_token = NULL, 
                    reset_expires = NULL,
                    atualizado_em = NOW()
                WHERE id = ?
            ");

            $result = $stmt->execute([$hash, $usuarioId]);

            if ($result) {
                $this->registrarLog($usuarioId, '', 'password_reset', 'Senha alterada');
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar senha: " . $e->getMessage());
            return false;
        }
    }

    public function limparTokenLogin(int $usuarioId): bool
    {
        try {
            $stmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET remember_token = NULL, 
                    remember_expires = NULL 
                WHERE id = ?
            ");
            return $stmt->execute([$usuarioId]);
        } catch (PDOException $e) {
            error_log("Erro ao limpar token: " . $e->getMessage());
            return false;
        }
    }

    public function getTentativasRestantes(string $email): int
    {
        $key = "login_attempts_email_" . md5($email);

        if (!isset($_SESSION[$key])) {
            return self::MAX_TENTATIVAS;
        }

        $tentativas = $_SESSION[$key]['count'];
        return max(0, self::MAX_TENTATIVAS - $tentativas);
    }


    // MÉTODO CORRIGIDO - AGORA É PÚBLICO
    public function registrarLog($usuarioId, string $email, string $tipo, string $descricao = ''): void
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO auth_logs 
                (usuario_id, email, ip_address, user_agent, tipo, descricao) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $usuarioId,
                $email,
                $this->getClientIP(),
                $_SERVER['HTTP_USER_AGENT'] ?? '',
                $tipo,
                $descricao
            ]);
        } catch (PDOException $e) {
            error_log("Erro ao registrar log: " . $e->getMessage());
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

    public function getLogs(int $limite = 100): array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT al.*, u.nome as usuario_nome 
                FROM auth_logs al 
                LEFT JOIN usuarios u ON al.usuario_id = u.id 
                ORDER BY al.created_at DESC 
                LIMIT ?
            ");
            $stmt->execute([$limite]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Erro ao buscar logs: " . $e->getMessage());
            return [];
        }
    }
}