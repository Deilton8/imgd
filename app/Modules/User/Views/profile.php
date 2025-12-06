<?php
ob_start();

// Calcular tempo desde a criação de forma mais precisa
$criadoEm = DateTime::createFromFormat('Y-m-d H:i:s', $usuario['criado_em']);
$hoje = new DateTime();
$intervalo = $hoje->diff($criadoEm);
$diasCadastro = $intervalo->days;

// Preparar dados para exibição
$dadosUsuario = [
    'id' => (int) $usuario['id'],
    'nome' => htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'),
    'email' => htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'),
    'papel' => htmlspecialchars($usuario['papel'] ?? 'user'),
    'status' => htmlspecialchars($usuario['status'] ?? 'ativo'),
    'inicial' => strtoupper(substr($usuario['nome'], 0, 1)),
    'criado_em' => $usuario['criado_em'] ? date('d/m/Y \à\s H:i', strtotime($usuario['criado_em'])) : 'N/A',
    'atualizado_em' => !empty($usuario['atualizado_em']) ? date('d/m/Y \à\s H:i', strtotime($usuario['atualizado_em'])) : null,
    'eh_usuario_atual' => ($usuario['id'] == ($_SESSION['usuario']['id'] ?? 0))
];

// Classes CSS reutilizáveis
$classes = [
    'badge' => [
        'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
        'user' => 'bg-blue-100 text-blue-800 border-blue-200',
        'ativo' => 'bg-green-100 text-green-800 border-green-200',
        'inativo' => 'bg-red-100 text-red-800 border-red-200'
    ],
    'botao' => [
        'primario' => 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50',
        'alerta' => 'bg-orange-100 text-orange-700 border-orange-300 hover:bg-orange-200',
        'sucesso' => 'bg-green-100 text-green-700 border-green-300 hover:bg-green-200'
    ]
];
?>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Cabeçalho -->
    <header class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Perfil do Usuário</h1>
                <p class="text-gray-600 mt-2">Visualize e gerencie as informações do usuário</p>
            </div>
            <a href="/admin/usuarios"
                class="inline-flex items-center gap-2 text-gray-700 hover:text-gray-900 transition-colors duration-200 font-medium px-4 py-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 self-start">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Voltar para lista
            </a>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main>
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
            <div class="relative overflow-hidden">
                <!-- Elementos decorativos de fundo -->
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50" aria-hidden="true">
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full -mr-32 -mt-32 opacity-50"
                    aria-hidden="true"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-100 rounded-full -ml-24 -mb-24 opacity-50"
                    aria-hidden="true"></div>

                <div class="relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 p-8">
                        <!-- Sidebar - Informações principais -->
                        <div class="lg:col-span-1 space-y-6">
                            <!-- Card do perfil -->
                            <div
                                class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg">
                                <!-- Avatar -->
                                <div class="text-center mb-6">
                                    <div class="w-32 h-32 rounded-full bg-white/20 backdrop-blur-sm border-2 border-white/30 flex items-center justify-center text-4xl font-bold mx-auto mb-4 shadow-lg"
                                        role="img" aria-label="Avatar do usuário <?= $dadosUsuario['nome'] ?>">
                                        <?= $dadosUsuario['inicial'] ?>
                                    </div>

                                    <h2 class="text-2xl font-bold mb-2 break-words"><?= $dadosUsuario['nome'] ?></h2>
                                    <p class="text-blue-100 break-words"><?= $dadosUsuario['email'] ?></p>
                                </div>

                                <!-- Badges -->
                                <div class="flex flex-wrap gap-2 justify-center mb-6">
                                    <span
                                        class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium border border-white/30 capitalize">
                                        <?= $dadosUsuario['papel'] ?>
                                    </span>
                                    <span
                                        class="px-3 py-1.5 rounded-full text-sm font-medium border border-white/30 capitalize <?= $dadosUsuario['status'] === 'ativo' ? 'bg-green-500/30 text-green-100' : 'bg-red-500/30 text-red-100' ?>">
                                        <?= $dadosUsuario['status'] ?>
                                    </span>
                                </div>

                                <!-- Estatística de tempo -->
                                <div
                                    class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 text-center">
                                    <p class="text-sm text-blue-200 mb-1">No sistema há</p>
                                    <p class="text-2xl font-bold"><?= $diasCadastro ?> dias</p>
                                </div>
                            </div>

                            <!-- Ações rápidas -->
                            <div class="space-y-3">
                                <a href="/admin/usuario/<?= $dadosUsuario['id'] ?>/editar"
                                    class="w-full inline-flex items-center justify-center gap-3 <?= $classes['botao']['primario'] ?> font-medium px-4 py-3 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 border">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Editar Usuário
                                </a>

                                <?php if (!$dadosUsuario['eh_usuario_atual']): ?>
                                    <button type="button" onclick="confirmToggleStatus()"
                                        class="w-full inline-flex items-center justify-center gap-3 <?= $dadosUsuario['status'] === 'ativo' ? $classes['botao']['alerta'] : $classes['botao']['sucesso'] ?> font-medium px-4 py-3 rounded-xl border transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <?= $dadosUsuario['status'] === 'ativo' ? 'Desativar' : 'Ativar' ?> Usuário
                                    </button>
                                <?php else: ?>
                                    <div class="text-center p-3 bg-yellow-50 border border-yellow-200 rounded-xl">
                                        <p class="text-sm text-yellow-700">Você não pode alterar seu próprio status</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Conteúdo principal - Informações detalhadas -->
                        <div class="lg:col-span-3">
                            <div class="space-y-6">
                                <!-- Informações Pessoais -->
                                <section aria-labelledby="info-pessoais-title">
                                    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                                        <h3 id="info-pessoais-title"
                                            class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-3">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Informações Pessoais
                                        </h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nome
                                                    Completo</label>
                                                <p class="text-gray-900 font-medium break-words">
                                                    <?= $dadosUsuario['nome'] ?></p>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                <p class="text-gray-900 font-medium break-words">
                                                    <?= $dadosUsuario['email'] ?></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">ID do
                                                    Usuário</label>
                                                <p class="font-mono text-gray-900 font-medium">
                                                    #<?= $dadosUsuario['id'] ?></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Status da
                                                    Conta</label>
                                                <span
                                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium border <?= $classes['badge'][$dadosUsuario['status']] ?>">
                                                    <span
                                                        class="w-2 h-2 rounded-full <?= $dadosUsuario['status'] === 'ativo' ? 'bg-green-500' : 'bg-red-500' ?>"
                                                        aria-hidden="true"></span>
                                                    <?= ucfirst($dadosUsuario['status']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Informações do Sistema -->
                                <section aria-labelledby="info-sistema-title">
                                    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                                        <h3 id="info-sistema-title"
                                            class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-3">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Informações do Sistema
                                        </h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Papel/Função</label>
                                                <span
                                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium border <?= $classes['badge'][$dadosUsuario['papel']] ?>">
                                                    <?php if ($dadosUsuario['papel'] === 'admin'): ?>
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                        </svg>
                                                    <?php else: ?>
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    <?php endif; ?>
                                                    <?= ucfirst($dadosUsuario['papel']) ?>
                                                </span>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Data de
                                                    Criação</label>
                                                <p class="text-gray-900 font-medium"><?= $dadosUsuario['criado_em'] ?>
                                                </p>
                                            </div>
                                            <?php if ($dadosUsuario['atualizado_em']): ?>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Última
                                                        Atualização</label>
                                                    <p class="text-gray-900 font-medium">
                                                        <?= $dadosUsuario['atualizado_em'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Tempo no
                                                    Sistema</label>
                                                <p class="text-gray-900 font-medium">
                                                    <?= $diasCadastro ?> dia<?= $diasCadastro !== 1 ? 's' : '' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Área para estatísticas futuras -->
                                <section aria-labelledby="estatisticas-title">
                                    <div
                                        class="bg-gradient-to-br from-indigo-50 to-blue-100 rounded-2xl p-6 border border-indigo-200">
                                        <h3 id="estatisticas-title"
                                            class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-3">
                                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                            Estatísticas
                                        </h3>
                                        <div class="text-center py-6">
                                            <svg class="w-12 h-12 text-indigo-400 mx-auto mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                            <p class="text-gray-600 font-medium">Estatísticas em desenvolvimento</p>
                                            <p class="text-sm text-gray-500 mt-1">Em breve você poderá acompanhar
                                                métricas detalhadas de uso</p>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function confirmToggleStatus() {
        const usuario = {
            id: <?= $dadosUsuario['id'] ?>,
            nome: '<?= addslashes($dadosUsuario['nome']) ?>',
            statusAtual: '<?= $dadosUsuario['status'] ?>'
        };

        const novoStatus = usuario.statusAtual === 'ativo' ? 'inativo' : 'ativo';
        const acao = novoStatus === 'ativo' ? 'ativar' : 'desativar';
        const mensagem = `Tem certeza que deseja ${acao} o usuário "${usuario.nome}"?\n\nEsta ação pode afetar o acesso do usuário ao sistema.`;

        if (confirm(mensagem)) {
            window.location.href = `/admin/usuario/${usuario.id}/mudar-status`;
        }
    }

    // Melhorar acessibilidade
    document.addEventListener('DOMContentLoaded', function () {
        // Foco no conteúdo principal
        const main = document.querySelector('main');
        if (main) {
            main.setAttribute('tabindex', '-1');
            main.focus();
        }
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout.php";
?>