<?php
namespace App\Modules\Dashboard\Models;

use App\Core\Model;
use PDO;
use PDOException;

class Dashboard extends Model
{
    protected $tables = [
        'usuarios' => 'Usuários',
        'publicacoes' => 'Publicações',
        'eventos' => 'Eventos',
        'sermoes' => 'Sermões',
        'midia' => 'Mídias',
        'mensagens_contato' => 'Mensagens'
    ];

    public function getEstatisticas(): array
    {
        $estatisticas = [];

        try {
            // Estatísticas básicas das tabelas
            foreach ($this->tables as $tabela => $label) {
                $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM {$tabela}");
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $estatisticas[$tabela] = [
                    'total' => (int) ($result['total'] ?? 0),
                    'label' => $label
                ];
            }

            // Estatísticas adicionais - garantir que todas as chaves existam
            $estatisticas['usuarios_ativos'] = $this->getUsuariosAtivos();
            $estatisticas['eventos_hoje'] = $this->getEventosHoje();
            $estatisticas['mensagens_nao_lidas'] = $this->getMensagensNaoLidas();

            // Garantir que todas as chaves esperadas existam
            $chavesEsperadas = [
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

            foreach ($chavesEsperadas as $chave) {
                if (!isset($estatisticas[$chave])) {
                    $estatisticas[$chave] = is_array($estatisticas[$chave] ?? null)
                        ? ['total' => 0, 'label' => ucfirst(str_replace('_', ' ', $chave))]
                        : 0;
                }
            }

        } catch (PDOException $e) {
            error_log("Erro ao buscar estatísticas: " . $e->getMessage());

            // Retornar estrutura vazia em caso de erro
            $estatisticas = [
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

        return $estatisticas;
    }

    private function getUsuariosAtivos(): int
    {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) AS total 
                FROM usuarios 
                WHERE status = 'ativo'
            ");
            $stmt->execute();
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            error_log("Erro ao contar usuários ativos: " . $e->getMessage());
            return 0;
        }
    }

    private function getEventosHoje(): int
    {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) AS total 
                FROM eventos 
                WHERE DATE(data_inicio) = CURDATE() 
                AND status = 'ativo'
            ");
            $stmt->execute();
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            error_log("Erro ao contar eventos de hoje: " . $e->getMessage());
            return 0;
        }
    }

    private function getMensagensNaoLidas(): int
    {
        try {
            $stmt = $this->db->prepare("
                SELECT COUNT(*) AS total 
                FROM mensagens_contato 
                WHERE lida = 0
            ");
            $stmt->execute();
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            error_log("Erro ao contar mensagens não lidas: " . $e->getMessage());
            return 0;
        }
    }

    public function getProximosEventos(int $limite = 5): array
    {
        try {
            $stmt = $this->db->prepare("
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
                LIMIT :limite
            ");
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();

            $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Formatar dados
            foreach ($eventos as &$evento) {
                $evento['data_formatada'] = date('d/m H:i', strtotime($evento['data_inicio']));
                $evento['dias_restantes'] = $this->calcularDiasRestantes($evento['data_inicio']);
            }

            return $eventos;
        } catch (PDOException $e) {
            error_log("Erro ao buscar próximos eventos: " . $e->getMessage());
            return [];
        }
    }

    public function getUltimasPublicacoes(int $limite = 5): array
    {
        try {
            $stmt = $this->db->prepare("
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
                LIMIT :limite
            ");
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();

            $publicacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Formatar dados
            foreach ($publicacoes as &$pub) {
                $pub['publicado_formatado'] = date('d/m/Y', strtotime($pub['publicado_em']));
                $pub['tempo_decorrido'] = $this->calcularTempoDecorrido($pub['publicado_em']);
            }

            return $publicacoes;
        } catch (PDOException $e) {
            error_log("Erro ao buscar últimas publicações: " . $e->getMessage());
            return [];
        }
    }

    public function getUltimosSermoes(int $limite = 5): array
    {
        try {
            $stmt = $this->db->prepare("
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
                LIMIT :limite
            ");
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();

            $sermoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Formatar dados
            foreach ($sermoes as &$sermao) {
                $sermao['data_formatada'] = date('d/m/Y', strtotime($sermao['data']));
            }

            return $sermoes;
        } catch (PDOException $e) {
            error_log("Erro ao buscar últimos sermões: " . $e->getMessage());
            return [];
        }
    }

    public function getUltimasMensagens(int $limite = 5): array
    {
        try {
            $stmt = $this->db->prepare("
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
                LIMIT :limite
            ");
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();

            $mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Formatar dados
            foreach ($mensagens as &$msg) {
                $msg['criado_formatado'] = date('d/m/Y H:i', strtotime($msg['criado_em']));
                $msg['mensagem_resumida'] = $this->resumirTexto($msg['mensagem'], 80);
            }

            return $mensagens;
        } catch (PDOException $e) {
            error_log("Erro ao buscar últimas mensagens: " . $e->getMessage());
            return [];
        }
    }

    // 📊 Dados para gráficos e análises

    public function getEventosPorStatus(): array
    {
        try {
            $sql = "
                SELECT 
                    status, 
                    COUNT(*) AS total 
                FROM eventos 
                GROUP BY status
                ORDER BY total DESC
            ";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar eventos por status: " . $e->getMessage());
            return [];
        }
    }

    public function getPublicacoesPorCategoria(): array
    {
        try {
            $sql = "
                SELECT 
                    categoria, 
                    COUNT(*) AS total 
                FROM publicacoes 
                WHERE status = 'publicado' 
                GROUP BY categoria
                ORDER BY total DESC
            ";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar publicações por categoria: " . $e->getMessage());
            return [];
        }
    }

    public function getEstatisticasMensais(int $meses = 6): array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT 
                    DATE_FORMAT(publicado_em, '%Y-%m') AS mes,
                    COUNT(*) AS total
                FROM publicacoes
                WHERE publicado_em >= DATE_SUB(NOW(), INTERVAL :meses MONTH)
                AND status = 'publicado'
                GROUP BY mes
                ORDER BY mes ASC
            ");
            $stmt->bindValue(':meses', $meses, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar estatísticas mensais: " . $e->getMessage());
            return [];
        }
    }

    public function getAtividadeRecente(int $limite = 10): array
    {
        try {
            // Unificar atividades de diferentes tabelas
            $queries = [
                "SELECT 'publicacao' as tipo, id, titulo as descricao, publicado_em as data FROM publicacoes WHERE status = 'publicado'",
                "SELECT 'evento' as tipo, id, titulo as descricao, data_inicio as data FROM eventos WHERE status = 'ativo'",
                "SELECT 'sermao' as tipo, id, titulo as descricao, data FROM sermoes WHERE status = 'publicado'",
                "SELECT 'mensagem' as tipo, id, CONCAT('Mensagem de ', nome) as descricao, criado_em as data FROM mensagens_contato"
            ];

            $unionQuery = implode(" UNION ALL ", $queries) . " ORDER BY data DESC LIMIT :limite";

            $stmt = $this->db->prepare($unionQuery);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();

            $atividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Formatar dados
            foreach ($atividades as &$atividade) {
                $atividade['data_formatada'] = date('d/m H:i', strtotime($atividade['data']));
                $atividade['icone'] = $this->getIconePorTipo($atividade['tipo']);
                $atividade['cor'] = $this->getCorPorTipo($atividade['tipo']);
            }

            return $atividades;
        } catch (PDOException $e) {
            error_log("Erro ao buscar atividade recente: " . $e->getMessage());
            return [];
        }
    }

    // Métodos auxiliares

    private function calcularDiasRestantes(string $data): string
    {
        $hoje = new \DateTime();
        $dataEvento = new \DateTime($data);
        $diferenca = $hoje->diff($dataEvento);

        if ($diferenca->days === 0) {
            return 'Hoje';
        } elseif ($diferenca->days === 1) {
            return 'Amanhã';
        } else {
            return "Em {$diferenca->days} dias";
        }
    }

    private function calcularTempoDecorrido(string $data): string
    {
        $agora = new \DateTime();
        $dataPublicacao = new \DateTime($data);
        $diferenca = $agora->diff($dataPublicacao);

        if ($diferenca->y > 0)
            return $diferenca->y . ' ano' . ($diferenca->y > 1 ? 's' : '');
        if ($diferenca->m > 0)
            return $diferenca->m . ' mês' . ($diferenca->m > 1 ? 'es' : '');
        if ($diferenca->d > 0)
            return $diferenca->d . ' dia' . ($diferenca->d > 1 ? 's' : '');
        if ($diferenca->h > 0)
            return $diferenca->h . ' hora' . ($diferenca->h > 1 ? 's' : '');
        return $diferenca->i . ' minuto' . ($diferenca->i > 1 ? 's' : '');
    }

    private function resumirTexto(string $texto, int $limite): string
    {
        if (strlen($texto) <= $limite) {
            return $texto;
        }
        return substr($texto, 0, $limite) . '...';
    }

    private function getIconePorTipo(string $tipo): string
    {
        $icones = [
            'publicacao' => '📝',
            'evento' => '📅',
            'sermao' => '🎤',
            'mensagem' => '✉️'
        ];
        return $icones[$tipo] ?? '📌';
    }

    private function getCorPorTipo(string $tipo): string
    {
        $cores = [
            'publicacao' => 'text-green-600 bg-green-100',
            'evento' => 'text-blue-600 bg-blue-100',
            'sermao' => 'text-purple-600 bg-purple-100',
            'mensagem' => 'text-orange-600 bg-orange-100'
        ];
        return $cores[$tipo] ?? 'text-gray-600 bg-gray-100';
    }
}