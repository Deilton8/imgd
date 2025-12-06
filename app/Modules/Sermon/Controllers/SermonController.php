<?php
namespace App\Modules\Sermon\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Sermon\Models\Sermon;
use App\Modules\Media\Models\Media;

class SermonController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;

    private Sermon $sermonModel;
    private Media $mediaModel;

    public function __construct()
    {
        $this->initializeSession();
        $this->redirectIfNotAuthenticated();

        $this->sermonModel = new Sermon();
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
        $page = (int) ($_GET['page'] ?? 1);
        $filters = $this->extractFiltersFromRequest();

        $result = $this->sermonModel->getPaginatedList($page, self::DEFAULT_PER_PAGE, $filters);
        $preachers = $this->sermonModel->getPreachers();

        View::render("Sermon/Views/admin/index", [
            "sermoes" => $result['data'],
            "pagination" => $result,
            "filters" => $filters,
            "pregadores" => $preachers,
            "title" => "Lista de Sermões"
        ]);
    }

    private function extractFiltersFromRequest(): array
    {
        return [
            "search" => $_GET['search'] ?? null,
            "pregador" => $_GET['pregador'] ?? null,
            "status" => $_GET['status'] ?? null,
            "data_inicio" => $_GET['data_inicio'] ?? null,
            "data_fim" => $_GET['data_fim'] ?? null,
        ];
    }

    public function show(int $id): void
    {
        $sermon = $this->sermonModel->findWithMedia($id);
        $title = "Detalhes do Sermão";

        View::render("Sermon/Views/admin/show", [
            "sermao" => $sermon,
            "title" => $title
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleSermonCreation();
            return;
        }

        $this->renderCreationForm();
    }

    private function handleSermonCreation(): void
    {
        $sermonId = $this->sermonModel->createRecord($_POST);

        if (!empty($_POST['midias'])) {
            $this->sermonModel->attachMedia($sermonId, $_POST['midias']);
        }

        header("Location: /admin/sermoes");
        exit;
    }

    private function renderCreationForm(): void
    {
        $mediaItems = $this->mediaModel->getAll();
        $preachers = $this->sermonModel->getPreachers();
        $title = "Criar Sermão";

        View::render("Sermon/Views/admin/create", [
            "title" => $title,
            "midias" => $mediaItems,
            "pregadores" => $preachers
        ]);
    }

    public function edit(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleSermonUpdate($id);
            return;
        }

        $this->renderEditForm($id);
    }

    private function handleSermonUpdate(int $id): void
    {
        $this->sermonModel->updateRecord($id, $_POST);

        if (!empty($_POST['midias'])) {
            $this->sermonModel->attachMedia($id, $_POST['midias']);
        }

        header("Location: /admin/sermoes");
        exit;
    }

    private function renderEditForm(int $id): void
    {
        $sermon = $this->sermonModel->findWithMedia($id);
        $mediaItems = $this->mediaModel->getAll();
        $sermonMedia = $this->sermonModel->getAttachedMedia($id);
        $preachers = $this->sermonModel->getPreachers();
        $title = "Editar Sermão";

        View::render("Sermon/Views/admin/edit", [
            "sermao" => $sermon,
            "midias" => $mediaItems,
            "midiasSermao" => array_column($sermonMedia, 'id'),
            "pregadores" => $preachers,
            "title" => $title
        ]);
    }

    public function delete(int $id): void
    {
        $this->sermonModel->deleteRecord($id);
        header("Location: /admin/sermoes");
        exit;
    }
}