<?php
namespace App\Modules\Sermon\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Sermon\Models\Sermon;

class PublicSermonController extends Controller
{
    private Sermon $sermonModel;

    public function __construct()
    {
        $this->sermonModel = new Sermon();
    }

    public function index(): void
    {
        $rawSermons = $this->sermonModel->getAll();
        $enrichedSermons = $this->enrichSermonsWithMedia($rawSermons);

        $title = "Sermões";

        View::render("Sermon/Views/public/index", [
            "sermoes" => $enrichedSermons,
            "title" => $title
        ]);
    }

    private function enrichSermonsWithMedia(array $rawSermons): array
    {
        $enrichedSermons = [];

        foreach ($rawSermons as $sermon) {
            $enrichedSermons[] = $this->sermonModel->findWithMedia($sermon['id']);
        }

        return $enrichedSermons;
    }

    public function show(int $id): void
    {
        $sermon = $this->sermonModel->findWithMedia($id);

        if (!$sermon) {
            http_response_code(404);
            echo "Sermão não encontrado.";
            return;
        }

        $title = $sermon["titulo"];

        View::render("Sermon/Views/public/show", [
            "sermao" => $sermon,
            "title" => $title
        ]);
    }
}