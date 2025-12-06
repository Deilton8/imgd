<?php
namespace App\Modules\User\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\User\Models\User;

class UserController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->checkAuthentication();
        $this->userModel = new User();
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
            $search = $this->sanitizeInput($_GET['q'] ?? '');
            $role = $this->sanitizeInput($_GET['role'] ?? '');
            $status = $this->sanitizeInput($_GET['status'] ?? '');
            $page = max(1, intval($_GET['page'] ?? 1));
            $perPage = 10;

            $pagination = $this->userModel->paginate($page, $perPage, $search, $role, $status);

            View::render("User/Views/index", [
                'usuarios' => $pagination['data'],
                'pagination' => $pagination,
                'search' => $search,
                'role' => $role,
                'status' => $status,
                'title' => "Usuários do Sistema"
            ]);
        } catch (\Exception $e) {
            $this->handleError($e->getMessage(), '/admin/usuarios');
        }
    }

    public function toggleStatus(int $id): void
    {
        try {
            $this->userModel->toggleStatus($id);
            $this->setFlashMessage("Status do usuário atualizado com sucesso!", 'success');
        } catch (\Exception $e) {
            $this->setFlashMessage($e->getMessage(), 'error');
        }

        header("Location: /admin/usuarios");
        exit;
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $this->sanitizeUserInput($_POST);
                $this->userModel->create($data);

                $this->setFlashMessage("Usuário criado com sucesso!", 'success');
                header("Location: /admin/usuarios");
                exit;
            } catch (\Exception $e) {
                $_SESSION['old'] = $_POST; // Preservar dados do form
                $this->setFlashMessage($e->getMessage(), 'error');
            }
        }

        View::render("User/Views/create", [
            'title' => "Novo usuário",
            'old' => $_SESSION['old'] ?? []
        ]);
    }

    public function edit(int $id): void
    {
        try {
            $usuario = $this->userModel->find($id);

            if (!$usuario) {
                throw new \Exception("Usuário não encontrado.");
            }

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $data = $this->sanitizeUserInput($_POST);
                $this->userModel->update($id, $data);

                $this->setFlashMessage("Usuário atualizado com sucesso!", 'success');
                header("Location: /admin/usuarios");
                exit;
            }

            View::render("User/Views/edit", [
                'usuario' => $usuario,
                'title' => "Editar usuário"
            ]);
        } catch (\Exception $e) {
            $_SESSION['old'] = $_POST; // Preservar dados do form
            $this->handleError($e->getMessage(), '/admin/usuarios');
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->userModel->delete($id);
            $this->setFlashMessage("Usuário removido com sucesso.", 'success');
        } catch (\Exception $e) {
            $this->setFlashMessage($e->getMessage(), 'error');
        }

        header("Location: /admin/usuarios");
        exit;
    }

    public function profile(int $id): void
    {
        try {
            $usuario = $this->userModel->find($id);

            if (!$usuario) {
                throw new \Exception("Usuário não encontrado.");
            }

            View::render("User/Views/profile", [
                "usuario" => $usuario,
                "title" => "Perfil do Usuário " . $usuario['nome']
            ]);
        } catch (\Exception $e) {
            $this->handleError($e->getMessage(), '/admin/usuarios');
        }
    }

    /**
     * Sanitiza dados do usuário - Versão corrigida para PHP 8.1+
     */
    private function sanitizeUserInput(array $data): array
    {
        return [
            'nome' => $this->sanitizeInput($data['nome'] ?? ''),
            'email' => $this->sanitizeEmail($data['email'] ?? ''),
            'senha' => $data['senha'] ?? '',
            'papel' => $this->sanitizeInput($data['papel'] ?? 'editor'),
            'status' => $this->sanitizeInput($data['status'] ?? 'ativo')
        ];
    }

    /**
     * Sanitiza input de texto genérico
     */
    private function sanitizeInput(string $value): string
    {
        // Remove tags HTML e PHP, e codifica caracteres especiais
        $value = strip_tags($value);
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Remove espaços extras no início e fim
        return trim($value);
    }

    /**
     * Sanitiza email
     */
    private function sanitizeEmail(string $email): string
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return trim($email);
    }

    /**
     * Sanitiza número inteiro
     */
    private function sanitizeInt($value): int
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Define mensagem flash
     */
    private function setFlashMessage(string $message, string $type = 'success'): void
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    /**
     * Manipula erros
     */
    private function handleError(string $message, string $redirectUrl): void
    {
        $this->setFlashMessage($message, 'error');
        header("Location: {$redirectUrl}");
        exit;
    }

    /**
     * Limpa dados antigos da sessão
     */
    public function __destruct()
    {
        if (isset($_SESSION['old'])) {
            unset($_SESSION['old']);
        }
    }
}