<?php ob_start(); ?>

<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                    <p class="text-gray-600">Visão geral do sistema</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        <?= date('d/m/Y - H:i') ?>
                    </span>
                    <button onclick="atualizarDashboard()"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                        <i class="fas fa-sync-alt"></i>
                        Atualizar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-700 rounded-2xl p-6 mb-8 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Bem-vindo,
                        <?= htmlspecialchars($usuario['nome'] ?? 'Usuário') ?>! 👋</h2>
                    <p class="text-blue-100"><?= htmlspecialchars($usuario['email'] ?? '') ?></p>
                    <div class="flex items-center gap-4 mt-3 text-sm">
                        <span
                            class="bg-white/20 px-3 py-1 rounded-full"><?= htmlspecialchars(ucfirst($usuario['papel'] ?? 'usuário')) ?></span>
                        <span
                            class="bg-white/20 px-3 py-1 rounded-full"><?= htmlspecialchars(ucfirst($usuario['status'] ?? 'ativo')) ?></span>
                        <span class="text-blue-100">Último login: <?= date('d/m/Y H:i') ?></span>
                    </div>
                </div>
                <div class="text-6xl opacity-20">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div id="loadingIndicator" class="hidden fixed top-0 left-0 w-full h-1 bg-blue-600 z-50">
            <div class="h-full bg-blue-400 animate-pulse"></div>
        </div>

        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8"
            id="estatisticasContainer">
            <?php
            $cards = [
                'usuarios' => ['👥', 'from-blue-500 to-blue-600', 'Usuários Cadastrados'],
                'usuarios_ativos' => ['✅', 'from-green-500 to-green-600', 'Usuários Ativos'],
                'publicacoes' => ['📝', 'from-purple-500 to-purple-600', 'Publicações'],
                'eventos' => ['📅', 'from-orange-500 to-orange-600', 'Eventos'],
                'eventos_hoje' => ['🎯', 'from-red-500 to-red-600', 'Eventos Hoje'],
                'sermoes' => ['🎤', 'from-indigo-500 to-indigo-600', 'Sermões'],
                'midia' => ['🎞️', 'from-pink-500 to-pink-600', 'Arquivos de Mídia'],
                'mensagens_contato' => ['✉️', 'from-teal-500 to-teal-600', 'Mensagens'],
                'mensagens_nao_lidas' => ['🔔', 'from-yellow-500 to-yellow-600', 'Mensagens Não Lidas'],
            ];

            foreach ($cards as $chave => [$emoji, $gradient, $titulo]):
                // Obter valor de forma segura
                $valor = 0;
                $label = $titulo;

                if (isset($estatisticas[$chave])) {
                    if (is_array($estatisticas[$chave])) {
                        $valor = $estatisticas[$chave]['total'] ?? 0;
                        $label = $estatisticas[$chave]['label'] ?? $titulo;
                    } else {
                        $valor = $estatisticas[$chave];
                    }
                }

                // Calcular porcentagem para a barra de progresso (máximo arbitrário de 100)
                $porcentagem = min(($valor / max($valor, 1)) * 100, 100);
                ?>
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-3xl"><?= $emoji ?></div>
                            <div class="text-2xl font-bold text-gray-900"><?= number_format($valor, 0, ',', '.') ?></div>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-1"><?= $label ?></h3>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r <?= $gradient ?> h-2 rounded-full transition-all duration-500"
                                style="width: <?= $porcentagem ?>%"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Gráficos e Métricas -->
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <!-- Gráfico de Eventos -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Eventos por Status</h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Atualizado agora</span>
                </div>
                <div class="h-64">
                    <?php if (!empty($eventosPorStatus)): ?>
                        <canvas id="chartEventos"></canvas>
                    <?php else: ?>
                        <div class="h-full flex items-center justify-center text-gray-500">
                            <div class="text-center">
                                <i class="fas fa-chart-pie text-4xl mb-2 opacity-50"></i>
                                <p>Nenhum dado disponível</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Gráfico de Publicações -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Publicações por Categoria</h3>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Atualizado agora</span>
                </div>
                <div class="h-64">
                    <?php if (!empty($publicacoesPorCategoria)): ?>
                        <canvas id="chartPublicacoes"></canvas>
                    <?php else: ?>
                        <div class="h-full flex items-center justify-center text-gray-500">
                            <div class="text-center">
                                <i class="fas fa-chart-bar text-4xl mb-2 opacity-50"></i>
                                <p>Nenhum dado disponível</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Conteúdo em Grid -->
        <div class="grid xl:grid-cols-3 gap-8 mb-8">
            <!-- Atividade Recente -->
            <div class="xl:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Atividade Recente</h3>
                        <button onclick="carregarMaisAtividades()"
                            class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <i class="fas fa-sync-alt"></i>
                            Carregar mais
                        </button>
                    </div>
                    <div class="space-y-4" id="atividadesList">
                        <?php if (!empty($atividadesRecentes)): ?>
                            <?php foreach (array_slice($atividadesRecentes, 0, 6) as $atividade): ?>
                                <div
                                    class="flex items-start gap-4 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 rounded-full <?= $atividade['cor'] ?? 'bg-gray-100 text-gray-600' ?> flex items-center justify-center text-lg">
                                        <?= $atividade['icone'] ?? '📌' ?>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            <?= htmlspecialchars($atividade['descricao'] ?? 'Atividade desconhecida') ?>
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            <?= $atividade['data_formatada'] ?? 'Data desconhecida' ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2 opacity-50"></i>
                                <p>Nenhuma atividade recente</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar com Listas -->
            <div class="space-y-8">
                <!-- Próximos Eventos -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Próximos Eventos</h3>
                    <div class="space-y-3">
                        <?php if (!empty($eventos)): ?>
                            <?php foreach (array_slice($eventos, 0, 4) as $evento): ?>
                                <div class="p-3 rounded-lg border border-gray-100 hover:bg-blue-50 transition-colors">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-medium text-gray-900 truncate">
                                                <?= htmlspecialchars($evento['titulo'] ?? 'Evento sem título') ?>
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                                <i class="fas fa-calendar"></i>
                                                <?= $evento['data_formatada'] ?? 'Data não definida' ?>
                                            </p>
                                            <p class="text-xs text-blue-600 font-medium mt-1">
                                                <?= $evento['dias_restantes'] ?? 'Data indefinida' ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-4 text-gray-500">
                                <i class="fas fa-calendar-times text-2xl mb-2 opacity-50"></i>
                                <p class="text-sm">Nenhum evento futuro</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Últimas Mensagens -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Últimas Mensagens</h3>
                    <div class="space-y-3">
                        <?php if (!empty($mensagens)): ?>
                            <?php foreach (array_slice($mensagens, 0, 3) as $mensagem): ?>
                                <div class="p-3 rounded-lg border border-gray-100 hover:bg-orange-50 transition-colors">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-medium text-gray-900">
                                                <?= htmlspecialchars($mensagem['nome'] ?? 'Remetente desconhecido') ?>
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1 truncate">
                                                <?= htmlspecialchars($mensagem['assunto'] ?? 'Sem assunto') ?>
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                <?= $mensagem['criado_formatado'] ?? 'Data desconhecida' ?>
                                            </p>
                                        </div>
                                        <?php if (!($mensagem['lida'] ?? true)): ?>
                                            <span class="flex-shrink-0 w-2 h-2 bg-red-500 rounded-full"></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-4 text-gray-500">
                                <i class="fas fa-inbox text-2xl mb-2 opacity-50"></i>
                                <p class="text-sm">Nenhuma mensagem</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuração dos gráficos
    const config = {
        eventos: <?= json_encode($eventosPorStatus ?? []) ?>,
        publicacoes: <?= json_encode($publicacoesPorCategoria ?? []) ?>
    };

    // Inicializar gráficos apenas se houver dados
    document.addEventListener('DOMContentLoaded', function () {
        // Gráfico de Eventos
        if (config.eventos && config.eventos.length > 0) {
            new Chart(document.getElementById('chartEventos'), {
                type: 'doughnut',
                data: {
                    labels: config.eventos.map(e => e.status || 'Desconhecido'),
                    datasets: [{
                        data: config.eventos.map(e => e.total || 0),
                        backgroundColor: [
                            '#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6'
                        ],
                        borderWidth: 2,
                        borderColor: '#FFFFFF'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }

        // Gráfico de Publicações
        if (config.publicacoes && config.publicacoes.length > 0) {
            new Chart(document.getElementById('chartPublicacoes'), {
                type: 'bar',
                data: {
                    labels: config.publicacoes.map(p => p.categoria || 'Sem categoria'),
                    datasets: [{
                        label: 'Publicações',
                        data: config.publicacoes.map(p => p.total || 0),
                        backgroundColor: '#3B82F6',
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            },
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    });

    // Funções de atualização
    async function atualizarDashboard() {
        const loading = document.getElementById('loadingIndicator');
        loading.classList.remove('hidden');

        try {
            const response = await fetch('/admin/dashboard/api/estatisticas');
            const data = await response.json();

            if (data.success) {
                // Aqui você pode atualizar os componentes com os novos dados
                console.log('Dashboard atualizado', data.data);
                location.reload(); // Recarregar a página por enquanto
            }
        } catch (error) {
            console.error('Erro ao atualizar dashboard:', error);
            alert('Erro ao atualizar dashboard');
        } finally {
            loading.classList.add('hidden');
        }
    }

    async function carregarMaisAtividades() {
        try {
            const response = await fetch('/admin/dashboard/api/atividades?limite=20');
            const data = await response.json();

            if (data.success) {
                // Implementar atualização da lista de atividades
                console.log('Atividades carregadas', data.data);
                alert('Funcionalidade em desenvolvimento');
            }
        } catch (error) {
            console.error('Erro ao carregar atividades:', error);
            alert('Erro ao carregar atividades');
        }
    }

    // Atualização automática a cada 5 minutos
    setInterval(atualizarDashboard, 300000);
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../Shared/Views/layout.php';