<?php
namespace App\Modules\Media\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Media\Models\Media;

class MediaController extends Controller
{
    private const ITEMS_PER_PAGE = 20;
    private const UPLOAD_DIRECTORY = "uploads/";
    private const UPLOAD_SUCCESS_MESSAGE = 'Upload realizado com sucesso!';
    private const DELETE_SUCCESS_MESSAGE = 'Mídia excluída com sucesso!';

    private Media $mediaModel;

    public function __construct()
    {
        $this->initializeSession();
        $this->redirectIfNotAuthenticated();
        $this->mediaModel = new Media();
    }

    private function initializeSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function redirectIfNotAuthenticated(): void
    {
        if (empty($_SESSION["usuario"])) {
            header("Location: /admin/login");
            exit;
        }
    }

    public function index(): void
    {
        $filters = $this->extractFilters();
        $page = $this->getCurrentPage();
        $limit = self::ITEMS_PER_PAGE;
        $offset = ($page - 1) * $limit;

        $mediaItems = $this->mediaModel->getAll($filters, $limit, $offset);
        $totalRecords = $this->mediaModel->countRecords($filters);
        $totalPages = ceil($totalRecords / $limit);

        $title = "Biblioteca de Mídia";

        View::render("Media/Views/index", [
            'title' => $title,
            'midias' => $mediaItems,
            'page' => $page,
            'totalPages' => $totalPages,
            'filters' => $filters
        ]);
    }

    private function extractFilters(): array
    {
        return [
            'tipo' => $_GET['tipo'] ?? null,
            'q' => $_GET['q'] ?? null
        ];
    }

    private function getCurrentPage(): int
    {
        return max(1, (int) ($_GET['page'] ?? 1));
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivos'])) {
            $this->handleFileUpload();
            return;
        }
    }

    private function handleFileUpload(): void
    {
        $files = $_FILES['arquivos'];
        $this->ensureUploadDirectoryExists();

        for ($index = 0; $index < count($files['name']); $index++) {
            if ($files['error'][$index] === UPLOAD_ERR_OK) {
                $this->processSingleFile($files, $index);
            }
        }

        $this->setFlashMessage(self::UPLOAD_SUCCESS_MESSAGE);
        header("Location: /admin/midia");
        exit;
    }

    private function ensureUploadDirectoryExists(): void
    {
        if (!is_dir(self::UPLOAD_DIRECTORY)) {
            mkdir(self::UPLOAD_DIRECTORY, 0777, true);
        }
    }

    private function processSingleFile(array $files, int $index): void
    {
        $extension = pathinfo($files['name'][$index], PATHINFO_EXTENSION);
        $uniqueName = uniqid("midia_", true) . "." . $extension;
        $filePath = self::UPLOAD_DIRECTORY . $uniqueName;

        if (move_uploaded_file($files['tmp_name'][$index], $filePath)) {
            $mediaData = $this->prepareMediaData($files, $index, $filePath);
            $this->mediaModel->createRecord($mediaData);
        }
    }

    private function prepareMediaData(array $files, int $index, string $filePath): array
    {
        return [
            "caminho_arquivo" => $filePath,
            "nome_arquivo" => $files['name'][$index],
            "tipo_mime" => $files['type'][$index],
            "tipo_arquivo" => $this->determineFileType($files['type'][$index]),
            "tamanho" => $files['size'][$index]
        ];
    }

    public function delete(int $id): void
    {
        $mediaItem = $this->mediaModel->findatabaseyId($id);

        if ($mediaItem && file_exists($mediaItem['caminho_arquivo'])) {
            unlink($mediaItem['caminho_arquivo']);
        }

        $this->mediaModel->deleteRecord($id);
        $this->setFlashMessage(self::DELETE_SUCCESS_MESSAGE);

        header("Location: /admin/midia");
        exit;
    }

    private function determineFileType(string $mimeType): string
    {
        if (str_contains($mimeType, "image")) {
            return "imagem";
        }

        if (str_contains($mimeType, "video")) {
            return "video";
        }

        if (str_contains($mimeType, "audio")) {
            return "audio";
        }

        return "documento";
    }

    private function setFlashMessage(string $message, string $type = 'success'): void
    {
        $_SESSION['flash'] = [$type => $message];
    }
}