<?php
namespace App\Modules\Auth\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Auth\Models\Auth;
use App\Core\Services\EmailService;

class AuthController extends Controller
{
    private Auth $authModel;
    private EmailService $emailService;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'cookie_secure' => isset($_SERVER['HTTPS']),
                'cookie_httponly' => true,
                'cookie_samesite' => 'Strict'
            ]);
        }

        $this->authModel = new Auth();
        $this->emailService = new EmailService();
        $this->autoLogin();
    }

    private function autoLogin(): void
    {
        if (!isset($_SESSION['usuario']) && isset($_COOKIE['remember_token'])) {
            $usuario = $this->authModel->autenticarPorToken($_COOKIE['remember_token']);

            if ($usuario) {
                $this->criarSessaoUsuario($usuario);

                // Redireciona se não estiver em página pública
                if (!$this->estaEmPaginaPublica()) {
                    header("Location: /admin");
                    exit;
                }
            } else {
                // Token inválido - limpa cookie
                setcookie('remember_token', '', time() - 3600, '/', '', true, true);
            }
        }
    }

    private function estaEmPaginaPublica(): bool
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $paginasPublicas = ['/admin/login', '/admin/esqueci-senha', '/admin/resetar-senha'];
        return in_array($uri, $paginasPublicas);
    }

    public function login(): void
    {
        // Se já estiver logado, redireciona
        if (isset($_SESSION['usuario'])) {
            header("Location: /admin");
            exit;
        }

        // Salva URL para redirecionamento pós-login
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_SERVER['HTTP_REFERER'])) {
            $referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
            if (!in_array($referer, ['/admin/login', '/admin/esqueci-senha'])) {
                $_SESSION['redirect_url'] = $referer;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processarLogin();
            return;
        }

        View::render("Auth/Views/login", [
            'title' => 'Login - Painel Administrativo'
        ]);
    }

    private function processarLogin(): void
    {
        $email = $this->sanitizeEmail($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $lembrar = isset($_POST['lembrar']);

        // Validações básicas
        if (empty($email) || empty($senha)) {
            $this->renderLoginComErro('Preencha todos os campos.');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->renderLoginComErro('E-mail inválido.');
            return;
        }

        $resultado = $this->authModel->attempt($email, $senha);

        if (!$resultado['success']) {
            $tentativasRestantes = $this->authModel->getTentativasRestantes($email);

            $dadosView = [
                'error' => $resultado['error'],
                'email' => htmlspecialchars($email),
                'tentativasRestantes' => $tentativasRestantes,
                'title' => 'Login - Painel Administrativo'
            ];

            if ($tentativasRestantes <= 2) {
                $dadosView['warning'] = "Cuidado! Você tem apenas {$tentativasRestantes} tentativa(s) restante(s).";
            }

            View::render("Auth/Views/login", $dadosView);
            return;
        }

        // Login bem-sucedido
        $this->criarSessaoUsuario($resultado['usuario']);

        if ($lembrar) {
            $this->authModel->gerarTokenLogin($resultado['usuario']['id']);
        }

        // Redireciona para URL original ou dashboard
        $urlRedirecionamento = $_SESSION['redirect_url'] ?? '/admin';
        unset($_SESSION['redirect_url']);

        $this->setFlashMessage('Login realizado com sucesso!', 'success');
        header("Location: " . $urlRedirecionamento);
        exit;
    }

    private function criarSessaoUsuario(array $usuario): void
    {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'papel' => $usuario['papel'],
            'login_time' => time(),
            'session_id' => session_id()
        ];

        // Regenera ID da sessão após login
        session_regenerate_id(true);
    }

    private function renderLoginComErro(string $mensagem): void
    {
        View::render("Auth/Views/login", [
            'error' => $mensagem,
            'email' => htmlspecialchars($_POST['email'] ?? ''),
            'title' => 'Login - Painel Administrativo'
        ]);
    }

    public function logout(): void
    {
        // Registra log de logout
        if (isset($_SESSION['usuario']['id'])) {
            $this->authModel->registrarLog(
                $_SESSION['usuario']['id'],
                $_SESSION['usuario']['email'],
                'logout'
            );

            // Limpa token remember me
            $this->authModel->limparTokenLogin($_SESSION['usuario']['id']);
        }

        // Limpa cookie
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/', '', true, true);
        }

        // Destrói sessão
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        $this->setFlashMessage('Logout realizado com sucesso!', 'success');
        header("Location: /admin/login");
        exit;
    }

    public function forgotPassword(): void
    {
        if (isset($_SESSION['usuario'])) {
            header("Location: /admin");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processarRecuperacaoSenha();
            return;
        }

        View::render("Auth/Views/forgot", [
            'title' => 'Recuperar Senha - Painel Administrativo'
        ]);
    }

    private function processarRecuperacaoSenha(): void
    {
        $email = $this->sanitizeEmail($_POST['email'] ?? '');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            View::render("Auth/Views/forgot", [
                'error' => 'Por favor, forneça um e-mail válido.',
                'email' => htmlspecialchars($email),
                'title' => 'Recuperar Senha - Painel Administrativo'
            ]);
            return;
        }

        $token = $this->authModel->gerarTokenRecuperacao($email);

        if ($token) {
            $link = $this->gerarLinkRecuperacao($token);

            // Tentar enviar email
            $emailEnviado = $this->emailService->sendRecoveryEmail($email, $link);

            if ($emailEnviado) {
                // Para desenvolvimento, mostrar links recentes
                $latestLinks = $this->emailService->getLatestRecoveryLinks();

                View::render("Auth/Views/forgot", [
                    'success' => 'Link de redefinição gerado com sucesso! O link foi salvo para desenvolvimento.',
                    'email' => $email,
                    'debug_links' => $latestLinks,
                    'title' => 'Recuperar Senha - Painel Administrativo'
                ]);
            } else {
                View::render("Auth/Views/forgot", [
                    'error' => 'Erro ao gerar link de recuperação. Tente novamente.',
                    'email' => htmlspecialchars($email),
                    'title' => 'Recuperar Senha - Painel Administrativo'
                ]);
            }
        } else {
            // Mesmo se e-mail não existir, mostra mensagem genérica por segurança
            View::render("Auth/Views/forgot", [
                'success' => 'Se o e-mail existir em nosso sistema, você receberá um link de recuperação.',
                'email' => htmlspecialchars($email),
                'title' => 'Recuperar Senha - Painel Administrativo'
            ]);
        }
    }

    private function gerarLinkRecuperacao(string $token): string
    {
        $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        return "{$protocol}://{$host}/admin/resetar-senha?token={$token}";
    }

    public function resetPassword(): void
    {
        if (isset($_SESSION['usuario'])) {
            header("Location: /admin");
            exit;
        }

        $token = $this->sanitizeInput($_GET['token'] ?? '');

        if (!$token) {
            header("Location: /admin/login");
            exit;
        }

        $usuario = $this->authModel->validarTokenRecuperacao($token);

        if (!$usuario) {
            View::render("Auth/Views/reset", [
                'error' => 'Token inválido ou expirado. Solicite um novo link de recuperação.',
                'title' => 'Token Inválido - Painel Administrativo'
            ]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CORREÇÃO: Passar apenas o ID do usuário, não o array completo
            $this->processarRedefinicaoSenha($usuario['id'], $token);
            return;
        }

        View::render("Auth/Views/reset", [
            'token' => $token,
            'title' => 'Redefinir Senha - Painel Administrativo'
        ]);
    }

    // CORREÇÃO: Método recebe apenas o ID (int) em vez do array completo
    private function processarRedefinicaoSenha(int $usuarioId, string $token): void
    {
        $senha = $_POST['senha'] ?? '';
        $confirmar = $_POST['confirmar'] ?? '';

        // Validações
        if (empty($senha) || empty($confirmar)) {
            View::render("Auth/Views/reset", [
                'error' => 'Preencha todos os campos.',
                'token' => $token,
                'title' => 'Redefinir Senha - Painel Administrativo'
            ]);
            return;
        }

        if ($senha !== $confirmar) {
            View::render("Auth/Views/reset", [
                'error' => 'As senhas não coincidem.',
                'token' => $token,
                'title' => 'Redefinir Senha - Painel Administrativo'
            ]);
            return;
        }

        if (strlen($senha) < 6) {
            View::render("Auth/Views/reset", [
                'error' => 'A senha deve ter pelo menos 6 caracteres.',
                'token' => $token,
                'title' => 'Redefinir Senha - Painel Administrativo'
            ]);
            return;
        }

        if ($this->authModel->atualizarSenha($usuarioId, $senha)) {
            View::render("Auth/Views/reset", [
                'success' => 'Senha redefinida com sucesso! Agora você pode fazer login.',
                'title' => 'Senha Redefinida - Painel Administrativo'
            ]);
        } else {
            View::render("Auth/Views/reset", [
                'error' => 'Erro ao redefinir senha. Tente novamente.',
                'token' => $token,
                'title' => 'Redefinir Senha - Painel Administrativo'
            ]);
        }
    }

    private function sanitizeEmail(string $email): string
    {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }

    private function sanitizeInput(string $value): string
    {
        return htmlspecialchars(trim($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    private function setFlashMessage(string $message, string $type = 'success'): void
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    private function requireAuth(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /admin/login");
            exit;
        }
    }
}