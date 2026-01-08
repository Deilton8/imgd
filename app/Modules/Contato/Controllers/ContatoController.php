<?php
namespace App\Modules\Contato\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Contato\Models\Mensagem;

class ContatoController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const LISTA_TITLE = "Mensagens de Contato";
    private const VISUALIZAR_TITLE = "Visualizar Mensagem";

    private Mensagem $mensagemModel;

    public function __construct()
    {
        $this->initializeSession();
        $this->checkAuthentication();
        $this->mensagemModel = new Mensagem();
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
            $currentPage = max(1, (int) ($_GET['page'] ?? 1));

            $paginationData = $this->mensagemModel->paginate(
                $currentPage,
                self::DEFAULT_PER_PAGE,
                $searchQuery
            );

            // Buscar estatísticas
            $stats = $this->mensagemModel->getStats();

            View::render("Contato/Views/admin/index", [
                'mensagens' => $paginationData['data'],
                'pagination' => $paginationData,
                'search' => $searchQuery,
                'stats' => $stats,
                'title' => self::LISTA_TITLE
            ]);
        } catch (\Exception $exception) {
            $this->handleError($exception->getMessage(), '/admin/contato');
        }
    }

    public function show(int $id): void
    {
        try {
            $mensagem = $this->mensagemModel->findById($id);

            if (!$mensagem) {
                throw new \Exception("Mensagem não encontrada.");
            }

            View::render("Contato/Views/admin/show", [
                'mensagem' => $mensagem,
                'title' => self::VISUALIZAR_TITLE
            ]);
        } catch (\Exception $exception) {
            $this->handleError($exception->getMessage(), '/admin/contato');
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->mensagemModel->delete($id);
            $this->setFlashMessage("Mensagem removida com sucesso.", 'success');
        } catch (\Exception $exception) {
            $this->setFlashMessage($exception->getMessage(), 'error');
        }

        header("Location: /admin/contato");
        exit;
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processMensagemCreation();
            return;
        }

        // Para o admin, apenas redireciona para a lista
        header("Location: /admin/contato");
        exit;
    }

    private function processMensagemCreation(): void
    {
        try {
            $sanitizedData = $this->sanitizeMensagemInput($_POST);
            $this->mensagemModel->create($sanitizedData);

            $this->setFlashMessage("Mensagem enviada com sucesso! Entraremos em contato em breve.", 'success');
            header("Location: /contato");
            exit;
        } catch (\Exception $exception) {
            $_SESSION['old'] = $_POST;
            $this->setFlashMessage($exception->getMessage(), 'error');
            header("Location: /contato");
            exit;
        }
    }

    private function sanitizeMensagemInput(array $data): array
    {
        return [
            'nome' => $this->sanitizeText($data['nome'] ?? ''),
            'email' => $this->sanitizeEmail($data['email'] ?? ''),
            'assunto' => $this->sanitizeText($data['assunto'] ?? ''),
            'mensagem' => $this->sanitizeText($data['mensagem'] ?? '')
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