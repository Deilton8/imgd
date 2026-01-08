<?php
namespace App\Modules\Event\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Event\Models\Event;
use App\Modules\Media\Models\Media;

class EventController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;

    private Event $eventModel;
    private Media $mediaModel;

    public function __construct()
    {
        $this->initializeSession();
        $this->redirectIfNotAuthenticated();

        $this->eventModel = new Event();
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
        $result = $this->eventModel->getPaginatedList($page, self::DEFAULT_PER_PAGE, $filters);

        View::render("Event/Views/admin/index", [
            "eventos" => $result['data'],
            "pagination" => $result,
            "filters" => $filters,
            "title" => "Lista de Eventos"
        ]);
    }

    private function extractFiltersFromRequest(): array
    {
        return [
            "search" => $_GET['search'] ?? null,
            "status" => $_GET['status'] ?? null,
            "data_inicio" => $_GET['data_inicio'] ?? null,
            "data_fim" => $_GET['data_fim'] ?? null,
            "local" => $_GET['local'] ?? null,
        ];
    }

    public function show(int $id): void
    {
        $evento = $this->eventModel->findWithMedia($id);
        $title = "Detalhes do evento";

        View::render("Event/Views/admin/show", [
            "evento" => $evento,
            "title" => $title
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleCreatePostRequest();
            return;
        }

        $this->renderCreateForm();
    }

    private function handleCreatePostRequest(): void
    {
        $eventId = $this->eventModel->createRecord($_POST);

        if (!empty($_POST['midias'])) {
            $this->eventModel->attachMedia($eventId, $_POST['midias']);
        }

        header("Location: /admin/eventos");
        exit;
    }

    private function renderCreateForm(): void
    {
        $midias = $this->mediaModel->getAll();
        $title = "Criar Evento";

        View::render("Event/Views/admin/create", [
            "title" => $title,
            "midias" => $midias
        ]);
    }

    public function edit(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleEditPostRequest($id);
            return;
        }

        $this->renderEditForm($id);
    }

    private function handleEditPostRequest(int $id): void
    {
        $this->eventModel->updateRecord($id, $_POST);

        if (!empty($_POST['midias'])) {
            $this->eventModel->attachMedia($id, $_POST['midias']);
        }

        header("Location: /admin/eventos");
        exit;
    }

    private function renderEditForm(int $id): void
    {
        $evento = $this->eventModel->findatabaseyId($id);
        $midias = $this->mediaModel->getAll();
        $midiasEvento = $this->eventModel->getAttachedMedia($id);
        $title = "Editar Evento";

        View::render("Event/Views/admin/edit", [
            "evento" => $evento,
            "midias" => $midias,
            "midiasEvento" => array_column($midiasEvento, 'id'),
            "title" => $title
        ]);
    }

    public function delete(int $id): void
    {
        $this->eventModel->deleteRecord($id);
        header("Location: /admin/eventos");
        exit;
    }
}