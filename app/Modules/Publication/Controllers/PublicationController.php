<?php
namespace App\Modules\Publication\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Publication\Models\Publication;
use App\Modules\Media\Models\Media;

class PublicationController extends Controller
{
    private Publication $publicationModel;
    private Media $mediaModel;

    public function __construct()
    {
        $this->initializeSession();
        $this->redirectIfNotAuthenticated();

        $this->publicationModel = new Publication();
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
            exit();
        }
    }

    public function index(): void
    {
        $publications = $this->publicationModel->getAll();
        $title = "Lista de Publicações";

        View::render("Publication/Views/admin/index", [
            "publicacoes" => $publications,
            "title" => $title
        ]);
    }

    public function show(int $id): void
    {
        $publication = $this->publicationModel->findWithMedia($id);

        if (!$publication) {
            $this->setFlashMessage('Publicação não encontrada.', 'error');
            header("Location: /admin/publicacoes");
            exit;
        }

        $title = "Detalhes da Publicação";
        View::render("Publication/Views/admin/show", [
            "publicacao" => $publication,
            "title" => $title
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePublicationCreation();
            return;
        }

        $this->renderCreationForm();
    }

    private function handlePublicationCreation(): void
    {
        try {
            $publicationId = $this->publicationModel->createRecord($_POST);

            if (!empty($_POST['midias'])) {
                $this->publicationModel->attachMedia($publicationId, $_POST['midias']);
            }

            $this->setFlashMessage('Publicação criada com sucesso.', 'success');
            header("Location: /admin/publicacoes");
            exit;
        } catch (\Exception $exception) {
            $this->setFlashMessage($exception->getMessage(), 'error');
        }
    }

    private function renderCreationForm(): void
    {
        $mediaItems = $this->mediaModel->getAll();
        $title = "Criar Publicação";

        View::render("Publication/Views/admin/create", [
            "title" => $title,
            "midias" => $mediaItems
        ]);
    }

    public function edit(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePublicationUpdate($id);
            return;
        }

        $this->renderEditForm($id);
    }

    private function handlePublicationUpdate(int $id): void
    {
        try {
            $this->publicationModel->updateRecord($id, $_POST);
            $this->synchronizeMedia($id, $_POST['midias'] ?? []);

            $this->setFlashMessage('Publicação atualizada com sucesso.', 'success');
            header("Location: /admin/publicacoes");
            exit;
        } catch (\Exception $exception) {
            $this->setFlashMessage($exception->getMessage(), 'error');
        }
    }

    private function synchronizeMedia(int $publicationId, array $mediaIds): void
    {
        $this->publicationModel->detachAllMedia($publicationId);

        if (!empty($mediaIds)) {
            $this->publicationModel->attachMedia($publicationId, $mediaIds);
        }
    }

    private function renderEditForm(int $id): void
    {
        $publication = $this->publicationModel->findatabaseyId($id);

        if (!$publication) {
            $this->setFlashMessage('Publicação não encontrada.', 'error');
            header("Location: /admin/publicacoes");
            exit;
        }

        $mediaItems = $this->mediaModel->getAll();
        $publicationMedia = $this->publicationModel->getMedia($id);
        $title = "Editar Publicação";

        View::render("Publication/Views/admin/edit", [
            "publicacao" => $publication,
            "midias" => $mediaItems,
            "midiasPublicacao" => array_column($publicationMedia, 'id'),
            "title" => $title
        ]);
    }

    public function delete(int $id): void
    {
        $this->publicationModel->deleteRecord($id);
        $this->setFlashMessage('Publicação removida com sucesso.', 'success');
        header("Location: /admin/publicacoes");
        exit;
    }

    private function setFlashMessage(string $message, string $type = 'success'): void
    {
        $_SESSION['flash'] = [$type => $message];
    }
}