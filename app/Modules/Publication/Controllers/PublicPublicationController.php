<?php
namespace App\Modules\Publication\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Publication\Models\Publication;

class PublicPublicationController extends Controller
{
    private Publication $publicationModel;

    public function __construct()
    {
        $this->publicationModel = new Publication();
    }

    public function index(): void
    {
        $rawPublications = $this->publicationModel->getAll();
        $publications = $this->enrichPublicationsWithMedia($rawPublications);

        $title = "Publicações - IMGD";

        View::render("Publication/Views/public/index", [
            "publicacoes" => $publications,
            "title" => $title
        ]);
    }

    private function enrichPublicationsWithMedia(array $rawPublications): array
    {
        $enrichedPublications = [];

        foreach ($rawPublications as $publication) {
            $enrichedPublications[] = $this->publicationModel->findWithMedia($publication['id']);
        }

        return $enrichedPublications;
    }

    public function show(int $id): void
    {
        $publication = $this->publicationModel->findWithMedia($id);

        if (!$publication) {
            http_response_code(404);
            echo "Publicação não encontrada.";
            return;
        }

        $title = $publication["titulo"];

        View::render("Publication/Views/public/show", [
            "publicacao" => $publication,
            "title" => $title
        ]);
    }
}