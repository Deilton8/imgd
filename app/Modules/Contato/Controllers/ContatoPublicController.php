<?php
namespace App\Modules\Contato\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Contato\Models\Mensagem;

class ContatoPublicController extends Controller
{
    private Mensagem $mensagemModel;

    public function __construct()
    {
        $this->mensagemModel = new Mensagem();
    }

    public function index(): void
    {
        $data = [];

        // Recupera dados do formulário se existirem (para caso de erro)
        if (isset($_GET['form_data'])) {
            $formData = json_decode(base64_decode($_GET['form_data']), true);
            if ($formData) {
                $data['old'] = $formData;
            }
        }

        // Recupera mensagem flash se existir
        if (isset($_GET['flash'])) {
            $flashData = json_decode(base64_decode($_GET['flash']), true);
            if ($flashData) {
                $data['flash'] = $flashData;
            }
        }

        View::render("Contato/Views/public/formulario", [
            'title' => 'Entre em Contato',
            ...$data
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithError('Método não permitido');
        }

        try {
            $sanitizedData = $this->sanitizeMensagemInput($_POST);

            // Validação
            $validationErrors = $this->validateMensagemInput($sanitizedData);
            if (!empty($validationErrors)) {
                throw new \Exception(implode(' ', $validationErrors));
            }

            $this->mensagemModel->create($sanitizedData);

            $this->redirectWithSuccess('Mensagem enviada com sucesso! Entraremos em contato em breve.');
        } catch (\Exception $exception) {
            $this->redirectWithError($exception->getMessage(), $_POST);
        }
    }

    private function validateMensagemInput(array $data): array
    {
        $errors = [];

        if (empty($data['nome']) || strlen(trim($data['nome'])) < 2) {
            $errors[] = 'Nome deve ter pelo menos 2 caracteres';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email inválido';
        }

        if (empty($data['assunto'])) {
            $errors[] = 'Assunto é obrigatório';
        }

        if (empty($data['mensagem']) || strlen(trim($data['mensagem'])) < 10) {
            $errors[] = 'Mensagem deve ter pelo menos 10 caracteres';
        } elseif (strlen(trim($data['mensagem'])) > 2000) {
            $errors[] = 'Mensagem não pode exceder 2000 caracteres';
        }

        return $errors;
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

    private function redirectWithSuccess(string $message): void
    {
        $flashData = base64_encode(json_encode([
            'message' => $message,
            'type' => 'success'
        ]));

        header("Location: /contato?flash=" . urlencode($flashData));
        exit;
    }

    private function redirectWithError(string $message, array $formData = []): void
    {
        $flashData = base64_encode(json_encode([
            'message' => $message,
            'type' => 'error'
        ]));

        $url = "/contato?flash=" . urlencode($flashData);

        if (!empty($formData)) {
            $formDataEncoded = base64_encode(json_encode($formData));
            $url .= "&form_data=" . urlencode($formDataEncoded);
        }

        header("Location: " . $url);
        exit;
    }
}