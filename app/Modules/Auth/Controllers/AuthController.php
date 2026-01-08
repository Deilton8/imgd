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
    private array $publicPages = ['/admin/login', '/admin/esqueci-senha', '/admin/resetar-senha'];

    public function __construct()
    {
        $this->initializeSecureSession();
        $this->authModel = new Auth();
        $this->emailService = new EmailService();
        $this->attemptAutoLogin();
    }

    private function initializeSecureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'cookie_secure' => isset($_SERVER['HTTPS']),
                'cookie_httponly' => true,
                'cookie_samesite' => 'Strict'
            ]);
        }
    }

    private function attemptAutoLogin(): void
    {
        if (!isset($_SESSION['usuario']) && isset($_COOKIE['remember_token'])) {
            $user = $this->authModel->authenticateByToken($_COOKIE['remember_token']);

            if ($user) {
                $this->createUserSession($user);
                $this->redirectIfNotOnPublicPage();
            } else {
                $this->clearInvalidToken();
            }
        }
    }

    private function redirectIfNotOnPublicPage(): void
    {
        if (!$this->isCurrentPagePublic()) {
            header("Location: /admin");
            exit;
        }
    }

    private function isCurrentPagePublic(): bool
    {
        $currentUri = $_SERVER['REQUEST_URI'] ?? '';
        return in_array($currentUri, $this->publicPages);
    }

    private function clearInvalidToken(): void
    {
        setcookie('remember_token', '', time() - 3600, '/', '', true, true);
    }

    public function login(): void
    {
        if ($this->isUserLoggedIn()) {
            header("Location: /admin");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->saveRedirectUrl();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processLoginRequest();
            return;
        }

        $this->renderLoginPage();
    }

    private function isUserLoggedIn(): bool
    {
        return isset($_SESSION['usuario']);
    }

    private function saveRedirectUrl(): void
    {
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $referrer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
            if (!in_array($referrer, ['/admin/login', '/admin/esqueci-senha'])) {
                $_SESSION['redirect_url'] = $referrer;
            }
        }
    }

    private function processLoginRequest(): void
    {
        $email = $this->sanitizeEmail($_POST['email'] ?? '');
        $password = $_POST['senha'] ?? '';
        $rememberMe = isset($_POST['lembrar']);

        if (!$this->validateLoginInput($email, $password)) {
            $this->renderLoginWithError('Preencha todos os campos.');
            return;
        }

        $loginResult = $this->authModel->attempt($email, $password);

        if (!$loginResult['success']) {
            $this->renderFailedLogin($email, $loginResult['error']);
            return;
        }

        $this->handleSuccessfulLogin($loginResult['usuario'], $rememberMe);
    }

    private function validateLoginInput(string $email, string $password): bool
    {
        return !empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function renderFailedLogin(string $email, string $error): void
    {
        $remainingAttempts = $this->authModel->getRemainingAttempts($email);
        $viewData = [
            'error' => $error,
            'email' => htmlspecialchars($email),
            'tentativasRestantes' => $remainingAttempts,
            'title' => 'Login - Painel Administrativo'
        ];

        if ($remainingAttempts <= 2) {
            $viewData['warning'] = "Cuidado! Você tem apenas {$remainingAttempts} tentativa(s) restante(s).";
        }

        View::render("Auth/Views/login", $viewData);
    }

    private function handleSuccessfulLogin(array $user, bool $rememberMe): void
    {
        $this->createUserSession($user);

        if ($rememberMe) {
            $this->authModel->generateLoginToken($user['id']);
        }

        $this->redirectAfterLogin();
    }

    private function createUserSession(array $user): void
    {
        $_SESSION['usuario'] = [
            'id' => $user['id'],
            'nome' => $user['nome'],
            'email' => $user['email'],
            'papel' => $user['papel'],
            'login_time' => time(),
            'session_id' => session_id()
        ];

        session_regenerate_id(true);
    }

    private function redirectAfterLogin(): void
    {
        $redirectUrl = $_SESSION['redirect_url'] ?? '/admin';
        unset($_SESSION['redirect_url']);

        $this->setFlashMessage('Login realizado com sucesso!', 'success');
        header("Location: " . $redirectUrl);
        exit;
    }

    private function renderLoginPage(): void
    {
        View::render("Auth/Views/login", [
            'title' => 'Login - Painel Administrativo'
        ]);
    }

    private function renderLoginWithError(string $message): void
    {
        View::render("Auth/Views/login", [
            'error' => $message,
            'email' => htmlspecialchars($_POST['email'] ?? ''),
            'title' => 'Login - Painel Administrativo'
        ]);
    }

    public function logout(): void
    {
        if (isset($_SESSION['usuario']['id'])) {
            $this->logLogoutAction();
            $this->clearUserToken();
        }

        $this->destroySession();
        $this->redirectToLogin();
    }

    private function logLogoutAction(): void
    {
        $this->authModel->logAuthAction(
            $_SESSION['usuario']['id'],
            $_SESSION['usuario']['email'],
            'logout'
        );
    }

    private function clearUserToken(): void
    {
        $this->authModel->clearLoginToken($_SESSION['usuario']['id']);
    }

    private function destroySession(): void
    {
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/', '', true, true);
        }

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
    }

    private function redirectToLogin(): void
    {
        $this->setFlashMessage('Logout realizado com sucesso!', 'success');
        header("Location: /admin/login");
        exit;
    }

    public function forgotPassword(): void
    {
        if ($this->isUserLoggedIn()) {
            header("Location: /admin");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processPasswordRecovery();
            return;
        }

        $this->renderForgotPasswordPage();
    }

    private function processPasswordRecovery(): void
    {
        $email = $this->sanitizeEmail($_POST['email'] ?? '');

        if (!$this->isValidEmail($email)) {
            $this->renderForgotPasswordWithError($email);
            return;
        }

        $this->handlePasswordRecoveryRequest($email);
    }

    private function isValidEmail(string $email): bool
    {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function renderForgotPasswordWithError(string $email): void
    {
        View::render("Auth/Views/forgot", [
            'error' => 'Por favor, forneça um e-mail válido.',
            'email' => htmlspecialchars($email),
            'title' => 'Recuperar Senha - Painel Administrativo'
        ]);
    }

    private function handlePasswordRecoveryRequest(string $email): void
    {
        $token = $this->authModel->generateRecoveryToken($email);

        if ($token) {
            $recoveryLink = $this->generateRecoveryLink($token);
            $emailSent = $this->emailService->sendRecoveryEmail($email, $recoveryLink);

            $this->renderRecoveryResult($email, $emailSent, $recoveryLink);
        } else {
            $this->renderGenericRecoveryMessage($email);
        }
    }

    private function generateRecoveryLink(string $token): string
    {
        $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        return "{$protocol}://{$host}/admin/resetar-senha?token={$token}";
    }

    private function renderRecoveryResult(string $email, bool $emailSent, string $recoveryLink): void
    {
        $viewData = ['email' => $email];

        if ($emailSent) {
            $viewData['success'] = 'Link de redefinição gerado com sucesso! O link foi salvo para desenvolvimento.';
            $viewData['debug_links'] = $this->emailService->getLatestRecoveryLinks();
        } else {
            $viewData['error'] = 'Erro ao gerar link de recuperação. Tente novamente.';
        }

        $viewData['title'] = 'Recuperar Senha - Painel Administrativo';
        View::render("Auth/Views/forgot", $viewData);
    }

    private function renderGenericRecoveryMessage(string $email): void
    {
        View::render("Auth/Views/forgot", [
            'success' => 'Se o e-mail existir em nosso sistema, você receberá um link de recuperação.',
            'email' => htmlspecialchars($email),
            'title' => 'Recuperar Senha - Painel Administrativo'
        ]);
    }

    private function renderForgotPasswordPage(): void
    {
        View::render("Auth/Views/forgot", [
            'title' => 'Recuperar Senha - Painel Administrativo'
        ]);
    }

    public function resetPassword(): void
    {
        if ($this->isUserLoggedIn()) {
            header("Location: /admin");
            exit;
        }

        $token = $this->sanitizeInput($_GET['token'] ?? '');

        if (!$token) {
            header("Location: /admin/login");
            exit;
        }

        $user = $this->authModel->validateRecoveryToken($token);

        if (!$user) {
            $this->renderInvalidTokenPage();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processPasswordReset($user['id'], $token);
            return;
        }

        $this->renderPasswordResetForm($token);
    }

    private function renderInvalidTokenPage(): void
    {
        View::render("Auth/Views/reset", [
            'error' => 'Token inválido ou expirado. Solicite um novo link de recuperação.',
            'title' => 'Token Inválido - Painel Administrativo'
        ]);
    }

    private function renderPasswordResetForm(string $token): void
    {
        View::render("Auth/Views/reset", [
            'token' => $token,
            'title' => 'Redefinir Senha - Painel Administrativo'
        ]);
    }

    private function processPasswordReset(int $userId, string $token): void
    {
        $password = $_POST['senha'] ?? '';
        $confirmPassword = $_POST['confirmar'] ?? '';

        if (!$this->validatePasswordResetInput($password, $confirmPassword)) {
            $this->renderPasswordResetWithError($token, 'Preencha todos os campos.');
            return;
        }

        if ($password !== $confirmPassword) {
            $this->renderPasswordResetWithError($token, 'As senhas não coincidem.');
            return;
        }

        if (strlen($password) < 6) {
            $this->renderPasswordResetWithError($token, 'A senha deve ter pelo menos 6 caracteres.');
            return;
        }

        $this->executePasswordUpdate($userId, $password, $token);
    }

    private function validatePasswordResetInput(string $password, string $confirmPassword): bool
    {
        return !empty($password) && !empty($confirmPassword);
    }

    private function renderPasswordResetWithError(string $token, string $error): void
    {
        View::render("Auth/Views/reset", [
            'error' => $error,
            'token' => $token,
            'title' => 'Redefinir Senha - Painel Administrativo'
        ]);
    }

    private function executePasswordUpdate(int $userId, string $password, string $token): void
    {
        if ($this->authModel->updatePassword($userId, $password)) {
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
}