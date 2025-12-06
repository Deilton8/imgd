<?php
namespace App\Modules\Dashboard\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Modules\Dashboard\Models\Dashboard;

class DashboardController extends Controller
{
    private const DEFAULT_LIMIT = 6;
    private const API_ERROR_MESSAGE = 'Erro interno do servidor';
    private const DASHBOARD_TITLE = "Dashboard Principal";

    protected Dashboard $dashboardModel;

    public function __construct()
    {
        $this->initializeSession();
        $this->requireAuthentication();
        $this->dashboardModel = new Dashboard();
    }

    private function initializeSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function requireAuthentication(): void
    {
        if (empty($_SESSION["usuario"])) {
            header("Location: /admin/login");
            exit;
        }
    }

    public function index(): void
    {
        try {
            $dashboardData = $this->gatherDashboardData();
            View::render("Dashboard/Views/index", $dashboardData);

        } catch (\Exception $exception) {
            error_log("Erro no dashboard: " . $exception->getMessage());
            $this->renderDashboardWithFallbackData();
        }
    }

    private function gatherDashboardData(): array
    {
        return [
            "usuario" => $_SESSION["usuario"] ?? [],
            "title" => self::DASHBOARD_TITLE,
            "estatisticas" => $this->dashboardModel->getStatistics(),
            "eventos" => $this->dashboardModel->getUpcomingEvents(self::DEFAULT_LIMIT) ?? [],
            "publicacoes" => $this->dashboardModel->getLatestPublications(self::DEFAULT_LIMIT) ?? [],
            "sermoes" => $this->dashboardModel->getLatestSermons(self::DEFAULT_LIMIT) ?? [],
            "mensagens" => $this->dashboardModel->getLatestMessages(5) ?? [],
            "eventosPorStatus" => $this->dashboardModel->getEventsByStatus() ?? [],
            "publicacoesPorCategoria" => $this->dashboardModel->getPublicationsByCategory() ?? [],
            "atividadesRecentes" => $this->dashboardModel->getRecentActivity(8) ?? []
        ];
    }

    private function renderDashboardWithFallbackData(): void
    {
        $fallbackData = [
            "usuario" => $_SESSION["usuario"] ?? [],
            "title" => self::DASHBOARD_TITLE,
            "estatisticas" => [],
            "eventos" => [],
            "publicacoes" => [],
            "sermoes" => [],
            "mensagens" => [],
            "eventosPorStatus" => [],
            "publicacoesPorCategoria" => [],
            "atividadesRecentes" => []
        ];

        View::render("Dashboard/Views/index", $fallbackData);
    }

    public function apiEstatisticas(): void
    {
        header('Content-Type: application/json');

        try {
            $apiData = [
                'estatisticas' => $this->dashboardModel->getStatistics(),
                'eventosPorStatus' => $this->dashboardModel->getEventsByStatus(),
                'publicacoesPorCategoria' => $this->dashboardModel->getPublicationsByCategory(),
                'estatisticasMensais' => $this->dashboardModel->getMonthlyStatistics()
            ];

            echo json_encode(['success' => true, 'data' => $apiData]);
        } catch (\Exception $exception) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => self::API_ERROR_MESSAGE]);
        }
    }

    public function apiAtividades(): void
    {
        header('Content-Type: application/json');

        try {
            $limit = (int) ($_GET['limite'] ?? 10);
            $activities = $this->dashboardModel->getRecentActivity($limit);

            echo json_encode(['success' => true, 'data' => $activities]);
        } catch (\Exception $exception) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => self::API_ERROR_MESSAGE]);
        }
    }

    private function showError(string $message): void
    {
        View::render("Dashboard/Views/error", [
            "title" => "Erro",
            "mensagem" => $message
        ]);
    }
}