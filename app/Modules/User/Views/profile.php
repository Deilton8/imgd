<?php
ob_start();

// Calcular tempo desde a criação
$criadoEm = DateTime::createFromFormat('Y-m-d H:i:s', $usuario['criado_em']);
$hoje = new DateTime();
$intervalo = $hoje->diff($criadoEm);
$diasCadastro = $intervalo->days;

// Preparar dados
$dadosUsuario = [
    'id' => (int) $usuario['id'],
    'nome' => htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'),
    'email' => htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'),
    'papel' => htmlspecialchars($usuario['papel'] ?? 'user'),
    'status' => htmlspecialchars($usuario['status'] ?? 'ativo'),
    'inicial' => strtoupper(substr($usuario['nome'], 0, 1)),
    'criado_em' => date('d/m/Y \à\s H:i', strtotime($usuario['criado_em'])),
    'atualizado_em' => !empty($usuario['atualizado_em']) ? date('d/m/Y \à\s H:i', strtotime($usuario['atualizado_em'])) : null,
    'eh_usuario_atual' => ($usuario['id'] == ($_SESSION['usuario']['id'] ?? 0))
];
?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 py-8 px-4 sm:px-6 lg:px-8" x-data="userProfile()"
    x-cloak>
    <div class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-6">
                <div class="flex items-start gap-4">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-cyan-600 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-3xl font-bold text-gray-900">Perfil do Usuário</h1>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-500 to-cyan-500 text-white">
                                ID: <?= $dadosUsuario['id'] ?>
                            </span>
                        </div>
                        <p class="text-gray-600">Visualize todas as informações do usuário</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/admin/usuarios"
                        class="group inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl hover:border-gray-400 hover:shadow-lg transition-all duration-300 font-medium text-gray-700">
                        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Voltar à Lista
                    </a>
                </div>
            </div>

            <!-- Status Banner -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div :class="getStatusClasses('<?= $dadosUsuario['status'] ?>')"
                            class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full"
                                :class="getStatusDotClass('<?= $dadosUsuario['status'] ?>')"></span>
                            <span x-text="getStatusText('<?= $dadosUsuario['status'] ?>')"></span>
                        </div>

                        <div class="text-sm text-gray-600">
                            <span class="font-medium"><?= $dadosUsuario['nome'] ?></span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-sm text-gray-500">
                            Criado em: <?= $dadosUsuario['criado_em'] ?>
                        </div>
                        <?php if ($dadosUsuario['atualizado_em']): ?>
                            <div class="text-sm text-gray-500">
                                Atualizado: <?= $dadosUsuario['atualizado_em'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Coluna 1: Perfil e Estatísticas -->
            <div class="space-y-8">
                <!-- Card de Perfil -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-600 to-blue-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Perfil</h2>
                    </div>

                    <div class="p-6 text-center">
                        <!-- Avatar -->
                        <div
                            class="w-32 h-32 mx-auto mb-6 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center text-white text-4xl font-bold shadow-lg">
                            <?= $dadosUsuario['inicial'] ?>
                        </div>

                        <!-- Nome e Email -->
                        <h3 class="text-xl font-bold text-gray-900 mb-2"><?= $dadosUsuario['nome'] ?></h3>
                        <p class="text-gray-600 mb-4 break-words"><?= $dadosUsuario['email'] ?></p>

                        <!-- Badges -->
                        <div class="flex flex-wrap gap-2 justify-center mb-6">
                            <span :class="getRoleClasses('<?= $dadosUsuario['papel'] ?>')"
                                class="px-3 py-1.5 rounded-full text-xs font-semibold capitalize">
                                <?= $dadosUsuario['papel'] === 'admin' ? '👑 Administrador' : '✏️ Editor' ?>
                            </span>
                            <span :class="getStatusClasses('<?= $dadosUsuario['status'] ?>')"
                                class="px-3 py-1.5 rounded-full text-xs font-semibold capitalize">
                                <?= $dadosUsuario['status'] === 'ativo' ? '🟢 Ativo' : '🔴 Inativo' ?>
                            </span>
                        </div>

                        <!-- Estatística de Tempo -->
                        <div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl p-4 border border-cyan-200">
                            <p class="text-sm text-gray-600 mb-1">No sistema há</p>
                            <p class="text-2xl font-bold text-gray-900"><?= $diasCadastro ?>
                                dia<?= $diasCadastro !== 1 ? 's' : '' ?></p>
                        </div>
                    </div>
                </div>

                <!-- Card de Ações Rápidas -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Ações</h2>
                    </div>

                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="/admin/usuario/<?= $dadosUsuario['id'] ?>/editar"
                                class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition-all duration-300">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Editar Usuário</p>
                                        <p class="text-xs text-gray-600">Modificar informações</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <?php if (!$dadosUsuario['eh_usuario_atual']): ?>
                                <button @click="toggleStatus()"
                                    class="group flex items-center justify-between p-4 bg-gradient-to-r from-amber-50 to-orange-100 hover:from-amber-100 hover:to-orange-200 rounded-xl transition-all duration-300 w-full text-left">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900" x-text="statusActionText"></p>
                                            <p class="text-xs text-gray-600" x-text="statusActionDescription"></p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-amber-400 group-hover:text-amber-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            <?php else: ?>
                                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-center">
                                    <p class="text-sm text-yellow-700">Você não pode alterar seu próprio status</p>
                                </div>
                            <?php endif; ?>

                            <button @click="showDeleteModal = true" <?= $dadosUsuario['eh_usuario_atual'] ? 'disabled' : '' ?>
                                class="group flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-rose-100 hover:from-red-100 hover:to-rose-200 rounded-xl transition-all duration-300 w-full text-left <?= $dadosUsuario['eh_usuario_atual'] ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-red-500 to-rose-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-red-900">Excluir Usuário</p>
                                        <p class="text-xs text-red-600">Remover permanentemente</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-red-400 group-hover:text-red-600 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna 2: Informações Detalhadas -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Card de Informações Pessoais -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Informações Pessoais</h2>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Nome Completo
                                </h3>
                                <p class="text-gray-700 text-lg break-words"><?= $dadosUsuario['nome'] ?></p>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Email
                                </h3>
                                <p class="text-gray-700 text-lg break-words"><?= $dadosUsuario['email'] ?></p>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                    </svg>
                                    ID do Usuário
                                </h3>
                                <p class="font-mono text-gray-700 text-lg">#<?= $dadosUsuario['id'] ?></p>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Status da Conta
                                </h3>
                                <span :class="getStatusClasses('<?= $dadosUsuario['status'] ?>')"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold">
                                    <span class="w-2 h-2 rounded-full"
                                        :class="getStatusDotClass('<?= $dadosUsuario['status'] ?>')"></span>
                                    <span x-text="getStatusText('<?= $dadosUsuario['status'] ?>')"></span>
                                </span>
                                <p class="text-sm text-gray-500 mt-1"
                                    x-text="getStatusDescription('<?= $dadosUsuario['status'] ?>')"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card de Informações do Sistema -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-violet-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Informações do Sistema</h2>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Papel/Função
                                </h3>
                                <p class="font-medium text-gray-900"
                                    x-text="getRoleText('<?= $dadosUsuario['papel'] ?>')"></p>
                                <p class="text-sm text-gray-500 mt-1"
                                    x-text="getRoleDescription('<?= $dadosUsuario['papel'] ?>')"></p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Criado em
                                </h3>
                                <p class="font-medium text-gray-900"><?= $dadosUsuario['criado_em'] ?></p>
                            </div>

                            <?php if ($dadosUsuario['atualizado_em']): ?>
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Última atualização
                                    </h3>
                                    <p class="font-medium text-gray-900"><?= $dadosUsuario['atualizado_em'] ?></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Estatística de Tempo -->
                        <div
                            class="mt-6 p-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl border border-indigo-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Tempo no Sistema</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1"><?= $diasCadastro ?>
                                        dia<?= $diasCadastro !== 1 ? 's' : '' ?></p>
                                </div>
                                <div class="text-indigo-600 text-3xl">📅</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card de Estatísticas (placeholder) -->
                <div class="bg-gradient-to-r from-indigo-50 to-blue-100 rounded-2xl p-6 border border-indigo-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-3">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Estatísticas
                    </h3>
                    <div class="text-center py-6">
                        <svg class="w-12 h-12 text-indigo-400 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <p class="text-gray-600 font-medium">Estatísticas em desenvolvimento</p>
                        <p class="text-sm text-gray-500 mt-1">Em breve você poderá acompanhar métricas detalhadas de uso
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação de Exclusão -->
        <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="display: none;">
            <div class="absolute inset-0 bg-black bg-opacity-50" @click="showDeleteModal = false"></div>

            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                <div class="text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2">Excluir Usuário</h2>
                    <p class="text-gray-600 mb-1">
                        <strong class="font-semibold"><?= $dadosUsuario['nome'] ?></strong>
                    </p>
                    <p class="text-gray-500 text-sm mb-6">
                        Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.
                    </p>

                    <div class="flex justify-center gap-3">
                        <button @click="showDeleteModal = false"
                            class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium">
                            Cancelar
                        </button>
                        <a href="/admin/usuario/<?= $dadosUsuario['id'] ?>/deletar"
                            class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 font-medium">
                            Sim, Excluir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function userProfile() {
        return {
            showDeleteModal: false,
            currentStatus: '<?= $dadosUsuario['status'] ?>',

            get statusActionText() {
                return this.currentStatus === 'ativo' ? 'Desativar Usuário' : 'Ativar Usuário';
            },

            get statusActionDescription() {
                return this.currentStatus === 'ativo' ? 'Impedir login no sistema' : 'Permitir login no sistema';
            },

            getStatusClasses(status) {
                const classes = {
                    'ativo': 'bg-green-100 text-green-800 border border-green-200',
                    'inativo': 'bg-red-100 text-red-800 border border-red-200'
                };
                return classes[status] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getStatusDotClass(status) {
                const classes = {
                    'ativo': 'bg-green-500',
                    'inativo': 'bg-red-500'
                };
                return classes[status] || 'bg-gray-500';
            },

            getStatusText(status) {
                const texts = {
                    'ativo': 'Ativo',
                    'inativo': 'Inativo'
                };
                return texts[status] || status;
            },

            getStatusDescription(status) {
                const descriptions = {
                    'ativo': 'Usuário pode fazer login no sistema',
                    'inativo': 'Usuário não pode fazer login'
                };
                return descriptions[status] || '';
            },

            getRoleClasses(role) {
                const classes = {
                    'admin': 'bg-purple-100 text-purple-800 border border-purple-200',
                    'editor': 'bg-blue-100 text-blue-800 border border-blue-200'
                };
                return classes[role] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getRoleText(role) {
                const texts = {
                    'admin': 'Administrador',
                    'editor': 'Editor'
                };
                return texts[role] || role;
            },

            getRoleDescription(role) {
                const descriptions = {
                    'admin': 'Acesso completo ao sistema',
                    'editor': 'Pode criar e editar conteúdo'
                };
                return descriptions[role] || '';
            },

            toggleStatus() {
                const novoStatus = this.currentStatus === 'ativo' ? 'inativo' : 'ativo';
                const acao = novoStatus === 'ativo' ? 'ativar' : 'desativar';
                const mensagem = `Tem certeza que deseja ${acao} o usuário "<?= addslashes($dadosUsuario['nome']) ?>"?\n\nEsta ação pode afetar o acesso do usuário ao sistema.`;

                if (confirm(mensagem)) {
                    window.location.href = `/admin/usuario/<?= $dadosUsuario['id'] ?>/mudar-status`;
                }
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout.php";
?>