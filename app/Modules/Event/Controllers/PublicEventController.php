<?php
namespace App\Modules\Event\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Event\Models\Event;

class PublicEventController extends Controller
{
    private Event $eventModel;

    public function __construct()
    {
        $this->eventModel = new Event();
    }

    public function index(): void
    {
        $rawEvents = $this->eventModel->getAll();
        $enrichedEvents = $this->enrichEventsWithMedia($rawEvents);

        $title = "Eventos - IMGD";

        View::render("Event/Views/public/index", [
            "eventos" => $enrichedEvents,
            "title" => $title
        ]);
    }

    private function enrichEventsWithMedia(array $rawEvents): array
    {
        $enrichedEvents = [];

        foreach ($rawEvents as $event) {
            $enrichedEvents[] = $this->eventModel->findWithMedia($event['id']);
        }

        return $enrichedEvents;
    }

    public function show(int $id): void
    {
        $event = $this->eventModel->findWithMedia($id);

        if (!$event) {
            http_response_code(404);
            echo "Evento não encontrado.";
            return;
        }

        $title = $event["titulo"];

        View::render("Event/Views/public/show", [
            "evento" => $event,
            "title" => $title
        ]);
    }
}