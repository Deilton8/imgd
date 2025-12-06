<?php
namespace App\Modules\Dashboard\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Dashboard\Models\Dashboard;

class DashboardController extends Controller
{
    protected Dashboard $dashboardModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->requireAuth();
        $this->dashboardModel = new Dashboard();
    }

    public function index(): void
    {
        $title = "Dashboard Principal";
        $usuario = $_SESSION["usuario"] ?? [];

        try {
            // Garantir que todos os dados existam
            $estatisticas = $this->dashboardModel->getEstatisticas();
            $eventos = $this->dashboardModel->getProximosEventos(6) ?? [];
            $publicacoes = $this->dashboardModel->getUltimasPublicacoes(6) ?? [];
            $sermoes = $this->dashboardModel->getUltimosSermoes(6) ?? [];
            $mensagens = $this->dashboardModel->getUltimasMensagens(5) ?? [];
            $eventosPorStatus = $this->dashboardModel->getEventosPorStatus() ?? [];
            $publicacoesPorCategoria = $this->dashboardModel->getPublicacoesPorCategoria() ?? [];
            $atividadesRecentes = $this->dashboardModel->getAtividadeRecente(8) ?? [];

            $dados = [
                "usuario" => $usuario,
                "title" => $title,
                "estatisticas" => $estatisticas,
                "eventos" => $eventos,
                "publicacoes" => $publicacoes,
                "sermoes" => $sermoes,
                "mensagens" => $mensagens,
                "eventosPorStatus" => $eventosPorStatus,
                "publicacoesPorCategoria" => $publicacoesPorCategoria,
                "atividadesRecentes" => $atividadesRecentes
            ];

            View::render("Dashboard/Views/index", $dados);

        } catch (\Exception $e) {
            error_log("Erro no dashboard: " . $e->getMessage());

            // Dados fallback em caso de erro
            $dadosFallback = [
                "usuario" => $usuario,
                "title" => $title,
                "estatisticas" => [],
                "eventos" => [],
                "publicacoes" => [],
                "sermoes" => [],
                "mensagens" => [],
                "eventosPorStatus" => [],
                "publicacoesPorCategoria" => [],
                "atividadesRecentes" => []
            ];

            View::render("Dashboard/Views/index", $dadosFallback);
        }
    }

    public function apiEstatisticas(): void
    {
        header('Content-Type: application/json');

        try {
            $dados = [
                'estatisticas' => $this->dashboardModel->getEstatisticas(),
                'eventosPorStatus' => $this->dashboardModel->getEventosPorStatus(),
                'publicacoesPorCategoria' => $this->dashboardModel->getPublicacoesPorCategoria(),
                'estatisticasMensais' => $this->dashboardModel->getEstatisticasMensais()
            ];

            echo json_encode(['success' => true, 'data' => $dados]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Erro ao buscar estatísticas']);
        }
    }

    public function apiAtividades(): void
    {
        header('Content-Type: application/json');

        try {
            $limite = (int) ($_GET['limite'] ?? 10);
            $atividades = $this->dashboardModel->getAtividadeRecente($limite);

            echo json_encode(['success' => true, 'data' => $atividades]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => 'Erro ao buscar atividades']);
        }
    }

    private function requireAuth(): void
    {
        if (empty($_SESSION["usuario"])) {
            header("Location: /admin/login");
            exit;
        }
    }

    private function showError(string $mensagem): void
    {
        View::render("Dashboard/Views/error", [
            "title" => "Erro",
            "mensagem" => $mensagem
        ]);
    }
}