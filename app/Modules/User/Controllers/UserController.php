<?php
namespace App\Modules\User\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\User\Models\User;

class UserController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const USERS_TITLE = "Usuários do Sistema";
    private const NEW_USER_TITLE = "Novo usuário";
    private const EDIT_USER_TITLE = "Editar usuário";

    private User $userModel;

    public function __construct()
    {
        $this->initializeSession();
        $this->checkAuthentication();
        $this->userModel = new User();
    }

    private function initializeSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function checkAuthentication(): void
    {
        if (empty($_SESSION["usuario"])) {
            header("Location: /admin/login");
            exit();
        }
    }

    public function index(): void
    {
        try {
            $searchQuery = $this->sanitizeInput($_GET['q'] ?? '');
            $roleFilter = $this->sanitizeInput($_GET['role'] ?? '');
            $statusFilter = $this->sanitizeInput($_GET['status'] ?? '');
            $currentPage = max(1, (int) ($_GET['page'] ?? 1));

            $paginationData = $this->userModel->paginate(
                $currentPage,
                self::DEFAULT_PER_PAGE,
                $searchQuery,
                $roleFilter,
                $statusFilter
            );

            View::render("User/Views/index", [
                'usuarios' => $paginationData['data'],
                'pagination' => $paginationData,
                'search' => $searchQuery,
                'role' => $roleFilter,
                'status' => $statusFilter,
                'title' => self::USERS_TITLE
            ]);
        } catch (\Exception $exception) {
            $this->handleError($exception->getMessage(), '/admin/usuarios');
        }
    }

    public function toggleStatus(int $id): void
    {
        try {
            $this->userModel->toggleStatus($id);
            $this->setFlashMessage("Status do usuário atualizado com sucesso!", 'success');
        } catch (\Exception $exception) {
            $this->setFlashMessage($exception->getMessage(), 'error');
        }

        header("Location: /admin/usuarios");
        exit;
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processUserCreation();
            return;
        }

        $this->renderCreationForm();
    }

    private function processUserCreation(): void
    {
        try {
            $sanitizedData = $this->sanitizeUserInput($_POST);
            $this->userModel->create($sanitizedData);

            $this->setFlashMessage("Usuário criado com sucesso!", 'success');
            header("Location: /admin/usuarios");
            exit;
        } catch (\Exception $exception) {
            $_SESSION['old'] = $_POST;
            $this->setFlashMessage($exception->getMessage(), 'error');
        }
    }

    private function renderCreationForm(): void
    {
        View::render("User/Views/create", [
            'title' => self::NEW_USER_TITLE,
            'old' => $_SESSION['old'] ?? []
        ]);
    }

    public function edit(int $id): void
    {
        try {
            $user = $this->userModel->findatabaseyId($id);

            if (!$user) {
                throw new \Exception("Usuário não encontrado.");
            }

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $this->processUserUpdate($id);
                return;
            }

            $this->renderEditForm($user);
        } catch (\Exception $exception) {
            $_SESSION['old'] = $_POST;
            $this->handleError($exception->getMessage(), '/admin/usuarios');
        }
    }

    private function processUserUpdate(int $userId): void
    {
        $sanitizedData = $this->sanitizeUserInput($_POST);
        $this->userModel->update($userId, $sanitizedData);

        $this->setFlashMessage("Usuário atualizado com sucesso!", 'success');
        header("Location: /admin/usuarios");
        exit;
    }

    private function renderEditForm(array $user): void
    {
        View::render("User/Views/edit", [
            'usuario' => $user,
            'title' => self::EDIT_USER_TITLE
        ]);
    }

    public function delete(int $id): void
    {
        try {
            $this->userModel->delete($id);
            $this->setFlashMessage("Usuário removido com sucesso.", 'success');
        } catch (\Exception $exception) {
            $this->setFlashMessage($exception->getMessage(), 'error');
        }

        header("Location: /admin/usuarios");
        exit;
    }

    public function profile(int $id): void
    {
        try {
            $user = $this->userModel->findatabaseyId($id);

            if (!$user) {
                throw new \Exception("Usuário não encontrado.");
            }

            View::render("User/Views/profile", [
                "usuario" => $user,
                "title" => "Perfil do Usuário " . $user['nome']
            ]);
        } catch (\Exception $exception) {
            $this->handleError($exception->getMessage(), '/admin/usuarios');
        }
    }

    private function sanitizeUserInput(array $data): array
    {
        return [
            'nome' => $this->sanitizeText($data['nome'] ?? ''),
            'email' => $this->sanitizeEmail($data['email'] ?? ''),
            'senha' => $data['senha'] ?? '',
            'papel' => $this->sanitizeText($data['papel'] ?? 'editor'),
            'status' => $this->sanitizeText($data['status'] ?? 'ativo')
        ];
    }

    private function sanitizeText(string $value): string
    {
        $value = strip_tags($value);
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return trim($value);
    }

    private function sanitizeEmail(string $email): string
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return trim($email);
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

    private function handleError(string $message, string $redirectUrl): void
    {
        $this->setFlashMessage($message, 'error');
        header("Location: {$redirectUrl}");
        exit;
    }

    public function __destruct()
    {
        if (isset($_SESSION['old'])) {
            unset($_SESSION['old']);
        }
    }
}