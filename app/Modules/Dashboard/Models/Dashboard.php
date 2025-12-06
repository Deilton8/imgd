<?php
namespace App\Modules\Dashboard\Models;

use App\Core\Model;
use PDO;
use PDOException;
use DateTime;

class Dashboard extends Model
{
    private const DEFAULT_LIMIT = 5;
    private const STATISTICS_MONTHS = 6;

    private array $tableLabels = [
        'usuarios' => 'Usuários',
        'publicacoes' => 'Publicações',
        'eventos' => 'Eventos',
        'sermoes' => 'Sermões',
        'midia' => 'Mídias',
        'mensagens_contato' => 'Mensagens'
    ];

    private array $activityIcons = [
        'publicacao' => '📝',
        'evento' => '📅',
        'sermao' => '🎤',
        'mensagem' => '✉️'
    ];

    private array $activityColors = [
        'publicacao' => 'text-green-600 bg-green-100',
        'evento' => 'text-blue-600 bg-blue-100',
        'sermao' => 'text-purple-600 bg-purple-100',
        'mensagem' => 'text-orange-600 bg-orange-100'
    ];

    public function getStatistics(): array
    {
        $statistics = [];

        try {
            $statistics = $this->getBasicTableStatistics();
            $statistics = array_merge($statistics, $this->getAdditionalStatistics());

            $statistics = $this->ensureAllStatisticsKeys($statistics);

        } catch (PDOException $exception) {
            error_log("Erro ao buscar estatísticas: " . $exception->getMessage());
            $statistics = $this->getFallbackStatistics();
        }

        return $statistics;
    }

    private function getBasicTableStatistics(): array
    {
        $statistics = [];

        foreach ($this->tableLabels as $tableName => $label) {
            $query = "SELECT COUNT(*) AS total FROM {$tableName}";
            $statement = $this->database->query($query);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $statistics[$tableName] = [
                'total' => (int) ($result['total'] ?? 0),
                'label' => $label
            ];
        }

        return $statistics;
    }

    private function getAdditionalStatistics(): array
    {
        return [
            'usuarios_ativos' => $this->countActiveUsers(),
            'eventos_hoje' => $this->countTodayEvents(),
            'mensagens_nao_lidas' => $this->countUnreadMessages()
        ];
    }

    private function ensureAllStatisticsKeys(array $statistics): array
    {
        $expectedKeys = [
            'usuarios',
            'publicacoes',
            'eventos',
            'sermoes',
            'midia',
            'mensagens_contato',
            'usuarios_ativos',
            'eventos_hoje',
            'mensagens_nao_lidas'
        ];

        foreach ($expectedKeys as $key) {
            if (!isset($statistics[$key])) {
                $statistics[$key] = is_array($statistics[$key] ?? null)
                    ? ['total' => 0, 'label' => ucfirst(str_replace('_', ' ', $key))]
                    : 0;
            }
        }

        return $statistics;
    }

    private function countActiveUsers(): int
    {
        try {
            $query = "SELECT COUNT(*) AS total FROM usuarios WHERE status = 'ativo'";
            $statement = $this->database->query($query);
            return (int) $statement->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $exception) {
            error_log("Erro ao contar usuários ativos: " . $exception->getMessage());
            return 0;
        }
    }

    private function countTodayEvents(): int
    {
        try {
            $query = "
                SELECT COUNT(*) AS total 
                FROM eventos 
                WHERE DATE(data_inicio) = CURDATE() 
                AND status = 'ativo'
            ";

            $statement = $this->database->query($query);
            return (int) $statement->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $exception) {
            error_log("Erro ao contar eventos de hoje: " . $exception->getMessage());
            return 0;
        }
    }

    private function countUnreadMessages(): int
    {
        try {
            $query = "SELECT COUNT(*) AS total FROM mensagens_contato WHERE lida = 0";
            $statement = $this->database->query($query);
            return (int) $statement->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $exception) {
            error_log("Erro ao contar mensagens não lidas: " . $exception->getMessage());
            return 0;
        }
    }

    private function getFallbackStatistics(): array
    {
        return [
            'usuarios' => ['total' => 0, 'label' => 'Usuários'],
            'publicacoes' => ['total' => 0, 'label' => 'Publicações'],
            'eventos' => ['total' => 0, 'label' => 'Eventos'],
            'sermoes' => ['total' => 0, 'label' => 'Sermões'],
            'midia' => ['total' => 0, 'label' => 'Mídias'],
            'mensagens_contato' => ['total' => 0, 'label' => 'Mensagens'],
            'usuarios_ativos' => 0,
            'eventos_hoje' => 0,
            'mensagens_nao_lidas' => 0
        ];
    }

    public function getUpcomingEvents(int $limit = self::DEFAULT_LIMIT): array
    {
        try {
            $query = "
                SELECT 
                    id, 
                    titulo, 
                    data_inicio, 
                    data_fim,
                    local,
                    status,
                    imagem,
                    descricao
                FROM eventos
                WHERE data_inicio >= NOW() 
                AND status = 'ativo'
                ORDER BY data_inicio ASC
                LIMIT :limit
            ";

            $statement = $this->database->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();

            $events = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->formatEventsData($events);
        } catch (PDOException $exception) {
            error_log("Erro ao buscar próximos eventos: " . $exception->getMessage());
            return [];
        }
    }

    private function formatEventsData(array $events): array
    {
        foreach ($events as &$event) {
            $event['data_formatada'] = date('d/m H:i', strtotime($event['data_inicio']));
            $event['dias_restantes'] = $this->calculateDaysRemaining($event['data_inicio']);
        }

        return $events;
    }

    public function getLatestPublications(int $limit = self::DEFAULT_LIMIT): array
    {
        try {
            $query = "
                SELECT 
                    p.id,
                    p.titulo,
                    p.categoria,
                    p.publicado_em,
                    p.status,
                    p.resumo,
                    p.imagem,
                    u.nome as autor
                FROM publicacoes p
                LEFT JOIN usuarios u ON p.autor_id = u.id
                WHERE p.status = 'publicado'
                ORDER BY p.publicado_em DESC
                LIMIT :limit
            ";

            $statement = $this->database->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();

            $publications = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->formatPublicationsData($publications);
        } catch (PDOException $exception) {
            error_log("Erro ao buscar últimas publicações: " . $exception->getMessage());
            return [];
        }
    }

    private function formatPublicationsData(array $publications): array
    {
        foreach ($publications as &$publication) {
            $publication['publicado_formatado'] = date('d/m/Y', strtotime($publication['publicado_em']));
            $publication['tempo_decorrido'] = $this->calculateElapsedTime($publication['publicado_em']);
        }

        return $publications;
    }

    public function getLatestSermons(int $limit = self::DEFAULT_LIMIT): array
    {
        try {
            $query = "
                SELECT 
                    id,
                    titulo,
                    pregador,
                    data,
                    duracao,
                    livro_biblico,
                    versiculo,
                    audio_url,
                    video_url
                FROM sermoes
                WHERE status = 'publicado'
                ORDER BY data DESC
                LIMIT :limit
            ";

            $statement = $this->database->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();

            $sermons = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->formatSermonsData($sermons);
        } catch (PDOException $exception) {
            error_log("Erro ao buscar últimos sermões: " . $exception->getMessage());
            return [];
        }
    }

    private function formatSermonsData(array $sermons): array
    {
        foreach ($sermons as &$sermon) {
            $sermon['data_formatada'] = date('d/m/Y', strtotime($sermon['data']));
        }

        return $sermons;
    }

    public function getLatestMessages(int $limit = self::DEFAULT_LIMIT): array
    {
        try {
            $query = "
                SELECT 
                    id,
                    nome,
                    email,
                    assunto,
                    mensagem,
                    criado_em,
                    lida
                FROM mensagens_contato
                ORDER BY criado_em DESC
                LIMIT :limit
            ";

            $statement = $this->database->prepare($query);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();

            $messages = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->formatMessagesData($messages);
        } catch (PDOException $exception) {
            error_log("Erro ao buscar últimas mensagens: " . $exception->getMessage());
            return [];
        }
    }

    private function formatMessagesData(array $messages): array
    {
        foreach ($messages as &$message) {
            $message['criado_formatado'] = date('d/m/Y H:i', strtotime($message['criado_em']));
            $message['mensagem_resumida'] = $this->summarizeText($message['mensagem'], 80);
        }

        return $messages;
    }

    public function getEventsByStatus(): array
    {
        try {
            $query = "
                SELECT 
                    status, 
                    COUNT(*) AS total 
                FROM eventos 
                GROUP BY status
                ORDER BY total DESC
            ";

            return $this->database->query($query)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log("Erro ao buscar eventos por status: " . $exception->getMessage());
            return [];
        }
    }

    public function getPublicationsByCategory(): array
    {
        try {
            $query = "
                SELECT 
                    categoria, 
                    COUNT(*) AS total 
                FROM publicacoes 
                WHERE status = 'publicado' 
                GROUP BY categoria
                ORDER BY total DESC
            ";

            return $this->database->query($query)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log("Erro ao buscar publicações por categoria: " . $exception->getMessage());
            return [];
        }
    }

    public function getMonthlyStatistics(int $months = self::STATISTICS_MONTHS): array
    {
        try {
            $query = "
                SELECT 
                    DATE_FORMAT(publicado_em, '%Y-%m') AS mes,
                    COUNT(*) AS total
                FROM publicacoes
                WHERE publicado_em >= DATE_SUB(NOW(), INTERVAL :meses MONTH)
                AND status = 'publicado'
                GROUP BY mes
                ORDER BY mes ASC
            ";

            $statement = $this->database->prepare($query);
            $statement->bindValue(':meses', $months, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log("Erro ao buscar estatísticas mensais: " . $exception->getMessage());
            return [];
        }
    }

    public function getRecentActivity(int $limit = 10): array
    {
        try {
            $activityQueries = [
                "SELECT 'publicacao' as tipo, id, titulo as descricao, publicado_em as data FROM publicacoes WHERE status = 'publicado'",
                "SELECT 'evento' as tipo, id, titulo as descricao, data_inicio as data FROM eventos WHERE status = 'ativo'",
                "SELECT 'sermao' as tipo, id, titulo as descricao, data FROM sermoes WHERE status = 'publicado'",
                "SELECT 'mensagem' as tipo, id, CONCAT('Mensagem de ', nome) as descricao, criado_em as data FROM mensagens_contato"
            ];

            $unionQuery = implode(" UNION ALL ", $activityQueries) . " ORDER BY data DESC LIMIT :limit";

            $statement = $this->database->prepare($unionQuery);
            $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();

            $activities = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->formatActivitiesData($activities);
        } catch (PDOException $exception) {
            error_log("Erro ao buscar atividade recente: " . $exception->getMessage());
            return [];
        }
    }

    private function formatActivitiesData(array $activities): array
    {
        foreach ($activities as &$activity) {
            $activity['data_formatada'] = date('d/m H:i', strtotime($activity['data']));
            $activity['icone'] = $this->getIconByType($activity['tipo']);
            $activity['cor'] = $this->getColorByType($activity['tipo']);
        }

        return $activities;
    }

    private function calculateDaysRemaining(string $date): string
    {
        $today = new DateTime();
        $eventDate = new DateTime($date);
        $difference = $today->diff($eventDate);

        if ($difference->days === 0) {
            return 'Hoje';
        } elseif ($difference->days === 1) {
            return 'Amanhã';
        } else {
            return "Em {$difference->days} dias";
        }
    }

    private function calculateElapsedTime(string $date): string
    {
        $now = new DateTime();
        $publicationDate = new DateTime($date);
        $difference = $now->diff($publicationDate);

        if ($difference->y > 0)
            return $difference->y . ' ano' . ($difference->y > 1 ? 's' : '');
        if ($difference->m > 0)
            return $difference->m . ' mês' . ($difference->m > 1 ? 'es' : '');
        if ($difference->d > 0)
            return $difference->d . ' dia' . ($difference->d > 1 ? 's' : '');
        if ($difference->h > 0)
            return $difference->h . ' hora' . ($difference->h > 1 ? 's' : '');
        return $difference->i . ' minuto' . ($difference->i > 1 ? 's' : '');
    }

    private function summarizeText(string $text, int $limit): string
    {
        if (strlen($text) <= $limit) {
            return $text;
        }
        return substr($text, 0, $limit) . '...';
    }

    private function getIconByType(string $type): string
    {
        return $this->activityIcons[$type] ?? '📌';
    }

    private function getColorByType(string $type): string
    {
        return $this->activityColors[$type] ?? 'text-gray-600 bg-gray-100';
    }
}