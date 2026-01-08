<?php ob_start(); ?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header com gradiente sutil -->
    <div class="bg-white/80 backdrop-blur-sm shadow-sm border-b border-gray-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                    <p class="text-gray-600 mt-1">Visão geral do sistema em tempo real</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-lg">
                        <i class="fas fa-clock text-gray-500 text-sm"></i>
                        <span class="text-sm font-medium text-gray-700" id="currentTime">
                            <?= date('d/m/Y - H:i') ?>
                        </span>
                    </div>
                    <button onclick="atualizarDashboard()"
                        class="relative group bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2.5 rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 flex items-center gap-2 shadow-md hover:shadow-lg active:scale-95 transform"
                        aria-label="Atualizar dados do dashboard">
                        <i class="fas fa-sync-alt transition-transform group-hover:rotate-180 duration-500"></i>
                        <span class="font-medium">Atualizar</span>
                        <span
                            class="absolute -top-2 -right-2 bg-blue-500 text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse hidden"
                            id="updateBadge">!</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading State Aprimorado -->
    <div id="loadingIndicator" class="hidden fixed top-0 left-0 w-full h-1 z-50">
        <div
            class="h-full bg-gradient-to-r from-blue-500 via-blue-600 to-purple-600 animate-[loading_1.5s_ease-in-out_infinite]">
        </div>
    </div>

    <!-- Notificação Toast -->
    <div id="notificationToast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white rounded-xl shadow-2xl border border-gray-200 p-4 max-w-sm animate-slideIn">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center" id="toastIcon">
                    <!-- Icon será inserido via JS -->
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900" id="toastTitle"></h4>
                    <p class="text-sm text-gray-600 mt-1" id="toastMessage"></p>
                </div>
                <button onclick="hideToast()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="h-1 bg-gray-200 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-blue-500 animate-[progress_3s_linear]" id="toastProgress"></div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Welcome Card com Avatar -->
        <div
            class="bg-gradient-to-r from-blue-600 via-blue-700 to-purple-700 rounded-2xl p-6 mb-8 text-white shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div
                            class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center text-2xl backdrop-blur-sm">
                            <?= strtoupper(substr($usuario['nome'] ?? 'U', 0, 1)) ?>
                        </div>
                        <?php if (($usuario['status'] ?? 'ativo') === 'ativo'): ?>
                            <div
                                class="absolute bottom-1 right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-blue-700">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-1">Olá, <?= htmlspecialchars($usuario['nome'] ?? 'Usuário') ?>!
                            👋</h2>
                        <p class="text-blue-100 opacity-90"><?= htmlspecialchars($usuario['email'] ?? '') ?></p>
                        <div class="flex items-center gap-3 mt-3 text-sm">
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full flex items-center gap-2">
                                <i class="fas fa-user-tag text-xs"></i>
                                <?= htmlspecialchars(ucfirst($usuario['papel'] ?? 'usuário')) ?>
                            </span>
                            <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full flex items-center gap-2">
                                <i
                                    class="fas fa-circle text-xs <?= ($usuario['status'] ?? 'ativo') === 'ativo' ? 'text-green-300' : 'text-red-300' ?>"></i>
                                <?= htmlspecialchars(ucfirst($usuario['status'] ?? 'ativo')) ?>
                            </span>
                            <span class="text-blue-100 opacity-90 flex items-center gap-2">
                                <i class="fas fa-sign-in-alt"></i>
                                Último login: <?= date('d/m/Y H:i') ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="text-6xl opacity-20 hidden lg:block transform hover:scale-110 transition-transform">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>

        <!-- Cards de Estatísticas com Skeleton Loading -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8"
            id="estatisticasContainer">
            <?php
            $cards = [
                'usuarios' => ['👥', 'from-blue-500 to-blue-600', 'Usuários Cadastrados', 'fas fa-users'],
                'usuarios_ativos' => ['✅', 'from-emerald-500 to-emerald-600', 'Usuários Ativos', 'fas fa-user-check'],
                'publicacoes' => ['📝', 'from-purple-500 to-purple-600', 'Publicações', 'fas fa-file-alt'],
                'eventos' => ['📅', 'from-amber-500 to-amber-600', 'Eventos', 'fas fa-calendar'],
                'eventos_hoje' => ['🎯', 'from-rose-500 to-rose-600', 'Eventos Hoje', 'fas fa-bullseye'],
                'sermoes' => ['🎤', 'from-indigo-500 to-indigo-600', 'Sermões', 'fas fa-microphone'],
                'midia' => ['🎞️', 'from-pink-500 to-pink-600', 'Arquivos de Mídia', 'fas fa-photo-video'],
                'mensagens_contato' => ['✉️', 'from-teal-500 to-teal-600', 'Mensagens', 'fas fa-envelope'],
                'mensagens_nao_lidas' => ['🔔', 'from-yellow-500 to-yellow-600', 'Não Lidas', 'fas fa-bell'],
            ];

            foreach ($cards as $chave => [$emoji, $gradient, $titulo, $icone]):
                $valor = 0;
                $label = $titulo;
                $variacao = 0;

                if (isset($estatisticas[$chave])) {
                    if (is_array($estatisticas[$chave])) {
                        $valor = $estatisticas[$chave]['total'] ?? 0;
                        $label = $estatisticas[$chave]['label'] ?? $titulo;
                        $variacao = $estatisticas[$chave]['variacao'] ?? 0;
                    } else {
                        $valor = $estatisticas[$chave];
                    }
                }

                $porcentagem = min(($valor / max($valor, 1)) * 100, 100);
                ?>
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 hover:border-blue-200 cursor-pointer"
                    onclick="abrirDetalhes('<?= $chave ?>')" role="button" tabindex="0"
                    aria-label="Ver detalhes de <?= $label ?>"
                    onkeypress="if(event.key === 'Enter') abrirDetalhes('<?= $chave ?>')">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="relative">
                                <div class="text-3xl group-hover:scale-110 transition-transform duration-300">
                                    <?= $emoji ?>
                                </div>
                                <div
                                    class="absolute -top-2 -right-2 text-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="fas fa-external-link-alt text-blue-500"></i>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900"><?= number_format($valor, 0, ',', '.') ?>
                                </div>
                                <?php if ($variacao != 0): ?>
                                    <div
                                        class="text-xs font-medium flex items-center gap-1 mt-1 <?= $variacao > 0 ? 'text-emerald-600' : 'text-rose-600' ?>">
                                        <i class="fas fa-arrow-<?= $variacao > 0 ? 'up' : 'down' ?> text-xs"></i>
                                        <?= abs($variacao) ?>%
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="<?= $icone ?> text-gray-400"></i>
                            <?= $label ?>
                        </h3>
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                            <span>Progresso</span>
                            <span class="font-medium"><?= round($porcentagem) ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r <?= $gradient ?> h-2 rounded-full transition-all duration-700 ease-out"
                                style="width: <?= $porcentagem ?>%"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Gráficos e Métricas -->
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <!-- Gráfico de Eventos Aprimorado -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Eventos por Status</h3>
                        <p class="text-sm text-gray-500 mt-1">Distribuição dos eventos</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Atualizado agora</span>
                        <button onclick="exportarGrafico('eventos')"
                            class="text-gray-400 hover:text-gray-600 transition-colors" aria-label="Exportar gráfico">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
                <div class="h-64 relative">
                    <?php if (!empty($eventosPorStatus)): ?>
                        <canvas id="chartEventos"></canvas>
                        <div class="absolute inset-0 flex items-center justify-center bg-white/80 backdrop-blur-sm hidden"
                            id="chartEventosLoading">
                            <div class="text-center">
                                <div
                                    class="w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto mb-2">
                                </div>
                                <p class="text-sm text-gray-600">Carregando...</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="h-full flex items-center justify-center text-gray-500">
                            <div class="text-center">
                                <i class="fas fa-chart-pie text-4xl mb-2 opacity-30"></i>
                                <p class="text-gray-400">Nenhum dado disponível</p>
                                <p class="text-sm text-gray-400 mt-1">Adicione eventos para visualizar</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Gráfico de Publicações Aprimorado -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Publicações por Categoria</h3>
                        <p class="text-sm text-gray-500 mt-1">Volume mensal de publicações</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            <span class="text-xs text-gray-600">Publicações</span>
                        </div>
                    </div>
                </div>
                <div class="h-64">
                    <?php if (!empty($publicacoesPorCategoria)): ?>
                        <canvas id="chartPublicacoes"></canvas>
                    <?php else: ?>
                        <div class="h-full flex items-center justify-center text-gray-500">
                            <div class="text-center">
                                <i class="fas fa-chart-bar text-4xl mb-2 opacity-30"></i>
                                <p class="text-gray-400">Nenhum dado disponível</p>
                                <p class="text-sm text-gray-400 mt-1">Crie publicações para visualizar</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Conteúdo em Grid -->
        <div class="grid xl:grid-cols-3 gap-8 mb-8">
            <!-- Atividade Recente Aprimorada -->
            <div class="xl:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Atividade Recente</h3>
                            <p class="text-sm text-gray-500 mt-1">Últimas ações no sistema</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="relative group">
                                <button onclick="filtrarAtividades('todas')"
                                    class="text-sm text-gray-600 hover:text-blue-600 flex items-center gap-1 transition-colors"
                                    aria-label="Filtrar atividades">
                                    <i class="fas fa-filter"></i>
                                    <span class="hidden sm:inline">Filtrar</span>
                                </button>
                                <div
                                    class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 hidden group-hover:block z-10">
                                    <button onclick="filtrarAtividades('todas')"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Todas</button>
                                    <button onclick="filtrarAtividades('hoje')"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Hoje</button>
                                    <button onclick="filtrarAtividades('semana')"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Esta
                                        semana</button>
                                </div>
                            </div>
                            <button onclick="carregarMaisAtividades()"
                                class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-lg transition-colors flex items-center gap-2"
                                aria-label="Carregar mais atividades">
                                <i class="fas fa-plus"></i>
                                <span>Carregar mais</span>
                            </button>
                        </div>
                    </div>
                    <div class="space-y-3" id="atividadesList">
                        <?php if (!empty($atividadesRecentes)): ?>
                            <?php foreach (array_slice($atividadesRecentes, 0, 6) as $index => $atividade): ?>
                                <div class="group flex items-start gap-4 p-4 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/50 transition-all duration-200 cursor-pointer"
                                    onclick="verDetalhesAtividade(<?= $index ?>)" role="button" tabindex="0">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 rounded-xl <?= $atividade['cor'] ?? 'bg-gradient-to-br from-gray-100 to-gray-200' ?> flex items-center justify-center text-lg group-hover:scale-105 transition-transform">
                                        <?= $atividade['icone'] ?? '📌' ?>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            <?= htmlspecialchars($atividade['descricao'] ?? 'Atividade desconhecida') ?>
                                        </p>
                                        <div class="flex items-center gap-3 mt-2">
                                            <span class="text-xs text-gray-500 flex items-center gap-1">
                                                <i class="fas fa-user text-gray-400"></i>
                                                <?= htmlspecialchars($atividade['usuario'] ?? 'Sistema') ?>
                                            </span>
                                            <span class="text-xs text-gray-500 flex items-center gap-1">
                                                <i class="fas fa-clock text-gray-400"></i>
                                                <?= $atividade['data_formatada'] ?? 'Data desconhecida' ?>
                                            </span>
                                        </div>
                                    </div>
                                    <i
                                        class="fas fa-chevron-right text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all"></i>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-10 text-gray-500">
                                <div
                                    class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-inbox text-2xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-400">Nenhuma atividade recente</p>
                                <p class="text-sm text-gray-400 mt-1">As atividades aparecerão aqui</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div id="atividadesLoading" class="hidden">
                        <?php for ($i = 0; $i < 3; $i++): ?>
                            <div class="animate-pulse p-4 border-b">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-200 rounded-xl"></div>
                                    <div class="flex-1">
                                        <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                                        <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar Aprimorada -->
            <div class="space-y-8">
                <!-- Próximos Eventos com Contador -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Próximos Eventos</h3>
                        <span class="text-xs font-medium bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                            <?= count($eventos ?? []) ?> eventos
                        </span>
                    </div>
                    <div class="space-y-3">
                        <?php if (!empty($eventos)): ?>
                            <?php foreach (array_slice($eventos, 0, 4) as $evento): ?>
                                <div class="group p-4 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-white transition-all duration-200 cursor-pointer"
                                    onclick="abrirEvento(<?= $evento['id'] ?? 0 ?>)" role="button" tabindex="0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span
                                                    class="text-xs font-medium <?= $evento['status'] === 'confirmado' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' ?> px-2 py-1 rounded-full">
                                                    <?= ucfirst($evento['status'] ?? 'agendado') ?>
                                                </span>
                                                <?php if (isset($evento['prioridade']) && $evento['prioridade'] === 'alta'): ?>
                                                    <span
                                                        class="text-xs font-medium bg-rose-100 text-rose-700 px-2 py-1 rounded-full">Alta</span>
                                                <?php endif; ?>
                                            </div>
                                            <h4
                                                class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors truncate">
                                                <?= htmlspecialchars($evento['titulo'] ?? 'Evento sem título') ?>
                                            </h4>
                                            <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                                <span class="flex items-center gap-1">
                                                    <i class="fas fa-calendar text-gray-400"></i>
                                                    <?= $evento['data_formatada'] ?? 'Data não definida' ?>
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <i class="fas fa-clock text-gray-400"></i>
                                                    <?= $evento['hora_formatada'] ?? '--:--' ?>
                                                </span>
                                            </div>
                                            <p class="text-xs text-blue-600 font-medium mt-2 flex items-center gap-1">
                                                <i class="fas fa-hourglass-half"></i>
                                                <?= $evento['dias_restantes'] ?? 'Data indefinida' ?>
                                            </p>
                                        </div>
                                        <i
                                            class="fas fa-chevron-right text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all mt-6"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-8 text-gray-500">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-calendar-plus text-gray-400"></i>
                                </div>
                                <p class="text-gray-400">Nenhum evento programado</p>
                                <button onclick="criarNovoEvento()"
                                    class="text-sm text-blue-600 hover:text-blue-700 mt-2 font-medium">
                                    Criar primeiro evento
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Últimas Mensagens com Marcadores -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Últimas Mensagens</h3>
                        <?php if (!empty($mensagens) && isset($estatisticas['mensagens_nao_lidas'])): ?>
                            <span class="relative">
                                <i class="fas fa-envelope text-gray-400"></i>
                                <?php if ($estatisticas['mensagens_nao_lidas'] > 0): ?>
                                    <span
                                        class="absolute -top-2 -right-2 bg-rose-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                                        <?= min($estatisticas['mensagens_nao_lidas'], 9) ?>        <?= $estatisticas['mensagens_nao_lidas'] > 9 ? '+' : '' ?>
                                    </span>
                                <?php endif; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="space-y-3">
                        <?php if (!empty($mensagens)): ?>
                            <?php foreach (array_slice($mensagens, 0, 3) as $mensagem): ?>
                                <div class="group p-4 rounded-xl border <?= !($mensagem['lida'] ?? true) ? 'border-amber-200 bg-amber-50/50' : 'border-gray-100' ?> hover:border-blue-200 hover:bg-blue-50/50 transition-all duration-200 cursor-pointer"
                                    onclick="abrirMensagem(<?= $mensagem['id'] ?? 0 ?>)" role="button" tabindex="0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-2">
                                                <h4 class="text-sm font-semibold text-gray-900 truncate">
                                                    <?= htmlspecialchars($mensagem['nome'] ?? 'Remetente desconhecido') ?>
                                                </h4>
                                                <?php if (!($mensagem['lida'] ?? true)): ?>
                                                    <span
                                                        class="flex-shrink-0 w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                                <?php endif; ?>
                                            </div>
                                            <p class="text-xs text-gray-600 truncate mb-2">
                                                <?= htmlspecialchars($mensagem['assunto'] ?? 'Sem assunto') ?>
                                            </p>
                                            <div class="flex items-center justify-between text-xs text-gray-500">
                                                <span class="flex items-center gap-1">
                                                    <i class="fas fa-clock text-gray-400"></i>
                                                    <?= $mensagem['criado_formatado'] ?? 'Data desconhecida' ?>
                                                </span>
                                                <?php if (!empty($mensagem['prioridade'])): ?>
                                                    <span
                                                        class="text-xs font-medium <?= $mensagem['prioridade'] === 'alta' ? 'text-rose-600' : 'text-gray-600' ?>">
                                                        <?= ucfirst($mensagem['prioridade']) ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <i
                                            class="fas fa-chevron-right text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all ml-2"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-8 text-gray-500">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-comments text-gray-400"></i>
                                </div>
                                <p class="text-gray-400">Caixa de entrada vazia</p>
                                <p class="text-sm text-gray-400 mt-1">Novas mensagens aparecerão aqui</p>
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
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<style>
    @keyframes loading {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes progress {
        from {
            width: 100%;
        }

        to {
            width: 0%;
        }
    }

    .animate-slideIn {
        animation: slideIn 0.3s ease-out;
    }

    .animate-progress {
        animation: progress 3s linear;
    }
</style>

<script>
    // Configuração dos gráficos
    const config = {
        eventos: <?= json_encode($eventosPorStatus ?? []) ?>,
        publicacoes: <?= json_encode($publicacoesPorCategoria ?? []) ?>
    };

    // Atualizar horário em tempo real
    function atualizarHorario() {
        const now = new Date();
        const options = {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        document.getElementById('currentTime').textContent =
            now.toLocaleDateString('pt-BR', options).replace(',', ' -');
    }
    setInterval(atualizarHorario, 60000);

    // Inicializar gráficos
    document.addEventListener('DOMContentLoaded', function () {
        // Gráfico de Eventos (Rosca)
        if (config.eventos && config.eventos.length > 0) {
            const ctxEventos = document.getElementById('chartEventos');
            new Chart(ctxEventos, {
                type: 'doughnut',
                data: {
                    labels: config.eventos.map(e => e.status || 'Desconhecido'),
                    datasets: [{
                        data: config.eventos.map(e => e.total || 0),
                        backgroundColor: [
                            '#10B981', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'
                        ],
                        borderWidth: 3,
                        borderColor: '#FFFFFF',
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    family: "'Inter', sans-serif"
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#1F2937',
                            bodyColor: '#4B5563',
                            borderColor: '#E5E7EB',
                            borderWidth: 1,
                            cornerRadius: 8,
                            padding: 12,
                            displayColors: true
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 1000
                    }
                },
                plugins: [{
                    beforeDraw: function (chart) {
                        const width = chart.width,
                            height = chart.height,
                            ctx = chart.ctx;

                        ctx.restore();
                        const fontSize = (height / 200).toFixed(2);
                        ctx.font = fontSize + "em 'Inter', sans-serif";
                        ctx.textBaseline = "middle";

                        const total = config.eventos.reduce((sum, e) => sum + (e.total || 0), 0);
                        const text = total.toString(),
                            textX = Math.round((width - ctx.measureText(text).width) / 2),
                            textY = height / 2;

                        ctx.fillStyle = '#1F2937';
                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }]
            });
        }

        // Gráfico de Publicações (Barras)
        if (config.publicacoes && config.publicacoes.length > 0) {
            new Chart(document.getElementById('chartPublicacoes'), {
                type: 'bar',
                data: {
                    labels: config.publicacoes.map(p => p.categoria || 'Sem categoria'),
                    datasets: [{
                        label: 'Publicações',
                        data: config.publicacoes.map(p => p.total || 0),
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                        hoverBackgroundColor: 'rgba(59, 130, 246, 1)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: {
                                    family: "'Inter', sans-serif"
                                }
                            },
                            grid: {
                                drawBorder: false,
                                color: 'rgba(229, 231, 235, 0.5)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: "'Inter', sans-serif"
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#1F2937',
                            bodyColor: '#4B5563',
                            borderColor: '#E5E7EB',
                            borderWidth: 1,
                            cornerRadius: 8,
                            padding: 12
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        }
    });

    // Sistema de Notificações
    function showNotification(type, title, message, duration = 3000) {
        const toast = document.getElementById('notificationToast');
        const icon = document.getElementById('toastIcon');
        const toastTitle = document.getElementById('toastTitle');
        const toastMessage = document.getElementById('toastMessage');
        const progress = document.getElementById('toastProgress');

        const icons = {
            success: 'fas fa-check-circle text-emerald-500',
            error: 'fas fa-exclamation-circle text-rose-500',
            info: 'fas fa-info-circle text-blue-500',
            warning: 'fas fa-exclamation-triangle text-amber-500'
        };

        icon.className = icons[type] || icons.info;
        toastTitle.textContent = title;
        toastMessage.textContent = message;

        progress.style.animation = `progress ${duration}ms linear`;

        toast.classList.remove('hidden');

        setTimeout(() => {
            hideToast();
        }, duration);
    }

    function hideToast() {
        document.getElementById('notificationToast').classList.add('hidden');
    }

    // Funções de atualização aprimoradas
    async function atualizarDashboard() {
        const loading = document.getElementById('loadingIndicator');
        loading.classList.remove('hidden');

        // Mostrar animação nos cards
        document.querySelectorAll('#estatisticasContainer > div').forEach(card => {
            card.classList.add('animate-pulse');
        });

        try {
            const response = await fetch('/admin/dashboard/api/estatisticas', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) throw new Error('Erro na requisição');

            const data = await response.json();

            if (data.success) {
                showNotification('success', 'Atualizado!', 'Dashboard atualizado com sucesso');

                // Atualizar badges se houver novas informações
                if (data.data?.novas_mensagens > 0) {
                    const badge = document.getElementById('updateBadge');
                    badge.textContent = data.data.novas_mensagens > 9 ? '9+' : data.data.novas_mensagens;
                    badge.classList.remove('hidden');
                }

                // Aqui você pode implementar a atualização parcial dos componentes
                // Por enquanto, vamos recarregar após um pequeno delay para ver a animação
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                throw new Error(data.message || 'Erro desconhecido');
            }
        } catch (error) {
            console.error('Erro ao atualizar dashboard:', error);
            showNotification('error', 'Erro!', 'Não foi possível atualizar o dashboard');
        } finally {
            loading.classList.add('hidden');
            document.querySelectorAll('#estatisticasContainer > div').forEach(card => {
                card.classList.remove('animate-pulse');
            });
        }
    }

    async function carregarMaisAtividades() {
        const container = document.getElementById('atividadesList');
        const loading = document.getElementById('atividadesLoading');

        loading.classList.remove('hidden');

        try {
            const response = await fetch('/admin/dashboard/api/atividades?limite=20');
            const data = await response.json();

            if (data.success) {
                // Simular carregamento de mais atividades
                setTimeout(() => {
                    showNotification('info', 'Carregado!', 'Mais atividades carregadas');
                    loading.classList.add('hidden');
                }, 1500);
            }
        } catch (error) {
            console.error('Erro ao carregar atividades:', error);
            showNotification('error', 'Erro!', 'Não foi possível carregar mais atividades');
            loading.classList.add('hidden');
        }
    }

    // Funções auxiliares
    function abrirDetalhes(categoria) {
        showNotification('info', 'Detalhes', `Abrindo detalhes de ${categoria}`);
        // Implementar navegação para detalhes
    }

    function filtrarAtividades(filtro) {
        showNotification('info', 'Filtro aplicado', `Mostrando atividades: ${filtro}`);
        // Implementar filtragem
    }

    function verDetalhesAtividade(index) {
        showNotification('info', 'Atividade', `Visualizando atividade ${index + 1}`);
        // Implementar visualização de detalhes
    }

    function abrirEvento(id) {
        showNotification('info', 'Evento', `Abrindo evento #${id}`);
        // Implementar navegação para evento
    }

    function abrirMensagem(id) {
        showNotification('info', 'Mensagem', `Abrindo mensagem #${id}`);
        // Implementar navegação para mensagem
    }

    function criarNovoEvento() {
        showNotification('info', 'Novo Evento', 'Redirecionando para criação de evento');
        // Implementar criação de evento
    }

    function exportarGrafico(tipo) {
        showNotification('success', 'Exportado!', `Gráfico de ${tipo} exportado`);
        // Implementar exportação
    }

    // Atualização automática a cada 2 minutos
    setInterval(atualizarDashboard, 120000);

    // Inicializar horário
    atualizarHorario();
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../Shared/Views/layout.php';