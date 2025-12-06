<?php
namespace App\Modules\Home\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Event\Models\Event;
use App\Modules\Sermon\Models\Sermon;
use App\Modules\Publication\Models\Publication;

class HomeController extends Controller
{
    private const ITEMS_LIMIT = 3;

    private Event $eventModel;
    private Sermon $sermonModel;
    private Publication $publicationModel;

    public function __construct()
    {
        $this->eventModel = new Event();
        $this->sermonModel = new Sermon();
        $this->publicationModel = new Publication();
    }

    public function index(): void
    {
        $nextEvent = $this->eventModel->getNextEvent();

        $data = [
            "title" => "Igreja Ministério da Graça de Deus - IMGD",
            "eventos" => $this->getRecentEvents(),
            "sermoes" => $this->getRecentSermons(),
            "publicacoes" => $this->getRecentPublications(),
            "proximo_evento" => $nextEvent
        ];

        View::render("Home/Views/index", $data);
    }

    private function getRecentEvents(): array
    {
        return $this->getItemsWithMedia(
            $this->eventModel,
            'findWithMedia'
        );
    }

    private function getRecentSermons(): array
    {
        return $this->getItemsWithMedia(
            $this->sermonModel,
            'findWithMedia'
        );
    }

    private function getRecentPublications(): array
    {
        return $this->getItemsWithMedia(
            $this->publicationModel,
            'findWithMedia'
        );
    }

    private function getItemsWithMedia(object $model, string $mediaMethod): array
    {
        $items = array_slice($model->all(), 0, self::ITEMS_LIMIT);

        return array_map(
            fn($item) => $model->$mediaMethod($item['id']),
            $items
        );
    }
}