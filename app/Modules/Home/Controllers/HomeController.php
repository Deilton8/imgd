<?php
namespace App\Modules\Home\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Event\Models\Event;
use App\Modules\Sermon\Models\Sermon;
use App\Modules\Publication\Models\Publication;

class HomeController extends Controller
{
    private const RECENT_ITEMS_LIMIT = 3;
    private const DEFAULT_CHURCH_TITLE = "Igreja Ministério da Graça de Deus - IMGD";

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
            "title" => self::DEFAULT_CHURCH_TITLE,
            "eventos" => $this->getRecentEvents(),
            "sermoes" => $this->getRecentSermons(),
            "publicacoes" => $this->getRecentPublications(),
            "proximo_evento" => $nextEvent
        ];

        View::render("Home/Views/index", $data);
    }

    private function getRecentEvents(): array
    {
        return $this->getRecentItemsWithMedia(
            $this->eventModel,
            'findWithMedia'
        );
    }

    private function getRecentSermons(): array
    {
        return $this->getRecentItemsWithMedia(
            $this->sermonModel,
            'findWithMedia'
        );
    }

    private function getRecentPublications(): array
    {
        return $this->getRecentItemsWithMedia(
            $this->publicationModel,
            'findWithMedia'
        );
    }

    private function getRecentItemsWithMedia(object $model, string $mediaMethod): array
    {
        $allItems = $model->getAll();
        $recentItems = array_slice($allItems, 0, self::RECENT_ITEMS_LIMIT);

        return array_map(
            fn($item) => $model->$mediaMethod($item['id']),
            $recentItems
        );
    }
}