<?php
namespace App\Modules\Sermon\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Sermon\Models\Sermon;
use App\Modules\Media\Models\Media;

class SermonController extends Controller
{
    private $sermonModel;
    private $mediaModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION["usuario"])) {
            header("Location: /admin/login");
            exit();
        }

        $this->sermonModel = new Sermon();
        $this->mediaModel = new Media();
    }

    public function index()
    {
        $page = $_GET['page'] ?? 1;

        $filters = [
            "search" => $_GET['search'] ?? null,
            "pregador" => $_GET['pregador'] ?? null,
            "status" => $_GET['status'] ?? null,
            "data_inicio" => $_GET['data_inicio'] ?? null,
            "data_fim" => $_GET['data_fim'] ?? null,
        ];

        $result = $this->sermonModel->list($page, 10, $filters);
        $pregadores = $this->sermonModel->getPregadores();

        View::render("Sermon/Views/admin/index", [
            "sermoes" => $result['data'],
            "pagination" => $result,
            "filters" => $filters,
            "pregadores" => $pregadores,
            "title" => "Lista de Sermões"
        ]);
    }

    public function show($id)
    {
        $sermao = $this->sermonModel->findWithMedia($id);
        $title = "Detalhes do Sermão";
        View::render("Sermon/Views/admin/show", ["sermao" => $sermao, "title" => $title]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sermaoId = $this->sermonModel->create($_POST);

            if (!empty($_POST['midias'])) {
                $this->sermonModel->attachMedia($sermaoId, $_POST['midias']);
            }

            header("Location: /admin/sermoes");
            exit;
        }

        $midias = $this->mediaModel->all();
        $pregadores = $this->sermonModel->getPregadores();
        $title = "Criar Sermão";

        View::render("Sermon/Views/admin/create", [
            "title" => $title,
            "midias" => $midias,
            "pregadores" => $pregadores
        ]);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->sermonModel->update($id, $_POST);

            // atualizar mídias vinculadas
            if (!empty($_POST['midias'])) {
                $this->sermonModel->attachMedia($id, $_POST['midias']);
            }

            header("Location: /admin/sermoes");
            exit;
        }

        $sermao = $this->sermonModel->findWithMedia($id);
        $midias = $this->mediaModel->all();
        $midiasSermao = $this->sermonModel->getMedia($id);
        $pregadores = $this->sermonModel->getPregadores();
        $title = "Editar Sermão";

        View::render("Sermon/Views/admin/edit", [
            "sermao" => $sermao,
            "midias" => $midias,
            "midiasSermao" => array_column($midiasSermao, 'id'),
            "pregadores" => $pregadores,
            "title" => $title
        ]);
    }

    public function delete($id)
    {
        $this->sermonModel->delete($id);
        header("Location: /admin/sermoes");
        exit;
    }
}