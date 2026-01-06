<?php
ob_start();
$flashMessage = $_SESSION['flash'] ?? null;
$old = $_SESSION['old'] ?? [];
unset($_SESSION['flash'], $_SESSION['old']);

// Preferir dados antigos (em caso de erro) ou dados do usuário
$userData = !empty($old) ? array_merge($usuario, $old) : $usuario;
?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-amber-50/30 py-8 px-4 sm:px-6 lg:px-8"
    x-data="userFormEdit()" x-cloak>
    <div class="max-w-4xl mx-auto">

        <!-- Header com status -->
        <div class="mb-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8">
                <div class="flex items-start gap-4">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-3xl font-bold text-gray-900">Editar Usuário</h1>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-amber-500 to-orange-500 text-white">
                                ID: <?= $userData['id'] ?>
                            </span>
                        </div>
                        <p class="text-gray-600">Atualize as informações de <span
                                class="font-semibold"><?= htmlspecialchars($userData['nome']) ?></span></p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/admin/usuario/<?= $userData['id'] ?>"
                        class="group inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl hover:border-blue-400 hover:shadow-lg transition-all duration-300 font-medium text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Visualizar
                    </a>
                    <a href="/admin/usuarios"
                        class="group inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl hover:border-gray-400 hover:shadow-lg transition-all duration-300 font-medium text-gray-700">
                        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Voltar
                    </a>
                </div>
            </div>

            <!-- Status Banner -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div :class="getStatusClasses('<?= $userData['status'] ?>')"
                            class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full"
                                :class="getStatusDotClass('<?= $userData['status'] ?>')"></span>
                            <span x-text="getStatusText('<?= $userData['status'] ?>')"></span>
                        </div>
                        <div class="text-sm text-gray-600">
                            Última atualização:
                            <?= !empty($userData['atualizado_em']) ? date('d/m/Y H:i', strtotime($userData['atualizado_em'])) : 'Nunca' ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 text-sm">
                        <div class="text-gray-500">
                            Criado em: <?= date('d/m/Y H:i', strtotime($userData['criado_em'] ?? 'now')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificação Flash -->
        <?php if ($flashMessage): ?>
            <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="mb-8 p-4 rounded-2xl border-l-4 <?= $flashMessage['type'] === 'error' ? 'bg-red-50 border-red-400 text-red-700' : 'bg-green-50 border-green-400 text-green-700' ?>">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-lg"><?= $flashMessage['type'] === 'error' ? '❌' : '✅' ?></span>
                        <p class="font-medium"><?= htmlspecialchars($flashMessage['message']) ?></p>
                    </div>
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <!-- Formulário -->
        <form method="POST" class="space-y-8">

            <!-- Seção 1: Informações Básicas -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">1</div>
                        <h2 class="text-xl font-bold text-white">Informações Básicas</h2>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- ID (readonly) -->
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ID do Usuário</label>
                        <div class="flex items-center gap-3">
                            <span
                                class="text-lg font-mono text-gray-800 bg-white px-4 py-2 rounded-lg border border-gray-300 shadow-sm">#<?= $userData['id'] ?></span>
                            <span class="text-xs text-gray-500">Identificador único do usuário</span>
                        </div>
                    </div>

                    <!-- Nome -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="nome" class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Nome Completo
                            </label>
                            <span class="text-xs text-gray-500" x-text="`${formData.nome.length}/100`"></span>
                        </div>
                        <input type="text" name="nome" id="nome" required x-model="formData.nome"
                            @input="validateForm()" :class="{'border-red-300': errors.nome}"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400"
                            placeholder="Digite o nome completo do usuário" maxlength="100">
                        <div x-show="errors.nome" x-transition
                            class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <span x-text="errors.nome"></span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="email"
                                class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Email
                            </label>
                        </div>
                        <input type="email" name="email" id="email" required x-model="formData.email"
                            @input="validateForm()" :class="{'border-red-300': errors.email}"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400"
                            placeholder="exemplo@dominio.com">
                        <div x-show="errors.email" x-transition
                            class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <span x-text="errors.email"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Segurança e Acesso -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">2</div>
                        <h2 class="text-xl font-bold text-white">Segurança e Acesso</h2>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Senha -->
                    <div>
                        <label for="senha" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nova Senha
                            <span class="text-xs text-gray-500 font-normal ml-2">(Opcional)</span>
                        </label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="senha" id="senha"
                                x-model="formData.senha" minlength="6" :class="{'border-red-300': errors.senha}"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400 pr-12"
                                placeholder="Digite apenas se desejar alterar a senha">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-300 p-2 rounded-lg hover:bg-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    x-show="!showPassword">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    x-show="showPassword" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="errors.senha" x-transition
                            class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <span x-text="errors.senha"></span>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <p class="text-xs text-gray-500">Mínimo 6 caracteres. Deixe em branco para manter a atual
                            </p>
                            <p class="text-xs" :class="formData.senha.length >= 6 ? 'text-green-600' : 'text-gray-500'"
                                x-text="formData.senha.length > 0 ? `${formData.senha.length}/∞ caracteres` : ''"></p>
                        </div>

                        <!-- Barra de força da senha (apenas se preenchida) -->
                        <div x-show="formData.senha.length > 0" x-transition class="mt-2">
                            <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full transition-all duration-300" :class="passwordStrength.color"
                                    :style="`width: ${(passwordStrength.score / 5) * 100}%`"></div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1"
                                x-text="`Força: ${passwordStrength.text} (${passwordStrength.score}/5)`"></div>
                        </div>
                    </div>

                    <!-- Papel e Status -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Papel -->
                        <div>
                            <label for="papel" class="block text-sm font-semibold text-gray-700 mb-2">
                                Papel do Usuário
                            </label>
                            <div class="relative">
                                <select name="papel" id="papel" x-model="formData.papel" @change="detectChanges()"
                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                    <option value="editor" <?= $userData['papel'] === 'editor' ? 'selected' : '' ?>>✏️
                                        Editor</option>
                                    <option value="admin" <?= $userData['papel'] === 'admin' ? 'selected' : '' ?>>👑
                                        Administrador</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1" x-text="getRoleDescription(formData.papel)"></p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Status da Conta
                            </label>
                            <div class="relative">
                                <select name="status" id="status" x-model="formData.status" @change="detectChanges()"
                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                    <option value="ativo" <?= $userData['status'] === 'ativo' ? 'selected' : '' ?>>🟢 Ativo
                                    </option>
                                    <option value="inativo" <?= $userData['status'] === 'inativo' ? 'selected' : '' ?>>🔴
                                        Inativo</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1" x-text="getStatusDescription(formData.status)"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview de Status -->
            <div x-show="formData.status" x-transition
                class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                <h4 class="font-medium text-green-800 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Status Atual
                </h4>
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="flex items-center gap-3">
                        <span :class="getStatusClasses(formData.status)"
                            class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full" :class="getStatusDotClass(formData.status)"></span>
                            <span x-text="getStatusText(formData.status)"></span>
                        </span>
                        <span class="text-sm text-gray-600" x-text="getStatusDescription(formData.status)"></span>
                    </div>
                    <div class="sm:ml-auto">
                        <span class="text-sm text-gray-500">
                            Papel: <span class="font-medium" x-text="getRoleText(formData.papel)"></span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Informações do Sistema -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">⚙️</div>
                        <h2 class="text-xl font-bold text-white">Informações do Sistema</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <div class="text-gray-500 mb-1">ID do Usuário</div>
                            <div class="font-mono text-gray-800 font-semibold">#<?= $userData['id'] ?></div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <div class="text-gray-500 mb-1">Criado em</div>
                            <div class="font-medium text-gray-800">
                                <?= date('d/m/Y H:i', strtotime($userData['criado_em'] ?? 'now')) ?></div>
                        </div>
                        <?php if (!empty($userData['atualizado_em'])): ?>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <div class="text-gray-500 mb-1">Última atualização</div>
                                <div class="font-medium text-gray-800">
                                    <?= date('d/m/Y H:i', strtotime($userData['atualizado_em'])) ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <!-- Contador de alterações -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full animate-pulse"
                                    :class="{'bg-green-500': hasChanges, 'bg-gray-300': !hasChanges}"></span>
                                <span class="text-sm font-medium"
                                    :class="{'text-green-600': hasChanges, 'text-gray-500': !hasChanges}">
                                    <span x-text="hasChanges ? 'Alterações detectadas' : 'Nenhuma alteração'"></span>
                                </span>
                            </div>
                            <span class="text-xs text-gray-500" x-show="hasChanges">
                                <span x-text="changeCount"></span> campo(s) modificado(s)
                            </span>
                        </div>

                        <!-- Lista de alterações -->
                        <div x-show="hasChanges && changesList.length > 0" x-transition class="space-y-1">
                            <template x-for="change in changesList" :key="change.field">
                                <p class="text-xs text-gray-600 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="font-medium" x-text="change.field"></span>:
                                    <span class="text-gray-500" x-text="change.value"></span>
                                </p>
                            </template>
                        </div>
                    </div>

                    <!-- Botões de ação -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="button" @click="resetToOriginal()"
                            class="px-6 py-3.5 border border-amber-300 text-amber-700 rounded-xl hover:border-amber-400 hover:text-amber-800 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Restaurar Original
                        </button>

                        <button type="submit" :disabled="!isFormValid"
                            class="px-8 py-3.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-3 font-semibold focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 min-w-[200px]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Salvar Alterações
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function userFormEdit() {
        return {
            formData: {
                nome: '<?= addslashes($userData['nome']) ?>',
                email: '<?= addslashes($userData['email']) ?>',
                senha: '',
                papel: '<?= $userData['papel'] ?>',
                status: '<?= $userData['status'] ?>'
            },
            originalData: {},
            errors: {},
            isFormValid: true,
            hasChanges: false,
            changeCount: 0,
            changesList: [],
            showPassword: false,

            init() {
                // Salvar dados originais
                this.originalData = { ...this.formData };

                // Validar ao carregar
                this.validateForm();
                this.detectChanges();

                // Observar mudanças
                this.$watch('formData', () => {
                    this.detectChanges();
                }, { deep: true });
            },

            get passwordStrength() {
                let score = 0;
                const password = this.formData.senha;

                if (password.length >= 6) score++;
                if (password.length >= 8) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;
                if (/[^A-Za-z0-9]/.test(password)) score++;

                const colors = [
                    'bg-red-500',
                    'bg-orange-500',
                    'bg-yellow-500',
                    'bg-blue-500',
                    'bg-green-500'
                ];

                const texts = [
                    'Muito fraca',
                    'Fraca',
                    'Média',
                    'Forte',
                    'Muito forte'
                ];

                return {
                    score: Math.min(score, 5),
                    color: colors[Math.min(score, 4)],
                    text: texts[Math.min(score, 4)]
                };
            },

            isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            },

            detectChanges() {
                let changes = [];
                let count = 0;

                for (const key in this.formData) {
                    if (key !== 'senha' && this.formData[key] !== this.originalData[key]) {
                        count++;
                        changes.push({
                            field: this.getFieldLabel(key),
                            value: this.formatChangeValue(key, this.formData[key])
                        });
                    }
                    // Para senha, só conta se estiver preenchida
                    if (key === 'senha' && this.formData.senha.length > 0) {
                        count++;
                        changes.push({
                            field: 'Senha',
                            value: 'Nova senha definida'
                        });
                    }
                }

                this.changeCount = count;
                this.changesList = changes;
                this.hasChanges = count > 0;
            },

            getFieldLabel(key) {
                const labels = {
                    'nome': 'Nome',
                    'email': 'Email',
                    'papel': 'Papel',
                    'status': 'Status'
                };
                return labels[key] || key;
            },

            formatChangeValue(key, value) {
                if (!value) return '(vazio)';

                if (key === 'papel') {
                    return this.getRoleText(value);
                }

                if (key === 'status') {
                    return this.getStatusText(value);
                }

                if (value.length > 30) {
                    return value.substring(0, 30) + '...';
                }

                return value;
            },

            validateForm() {
                this.errors = {};

                // Validar nome
                if (!this.formData.nome.trim()) {
                    this.errors.nome = 'Nome é obrigatório';
                } else if (this.formData.nome.trim().length < 2) {
                    this.errors.nome = 'Nome deve ter pelo menos 2 caracteres';
                }

                // Validar email
                if (!this.formData.email.trim()) {
                    this.errors.email = 'Email é obrigatório';
                } else if (!this.isValidEmail(this.formData.email)) {
                    this.errors.email = 'Email inválido';
                }

                // Validar senha (apenas se preenchida)
                if (this.formData.senha.length > 0 && this.formData.senha.length < 6) {
                    this.errors.senha = 'Senha deve ter pelo menos 6 caracteres';
                }

                this.isFormValid = Object.keys(this.errors).length === 0;
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

            resetToOriginal() {
                if (confirm('Restaurar todos os valores originais? As alterações não salvas serão perdidas.')) {
                    this.formData = { ...this.originalData };
                    this.errors = {};
                    this.isFormValid = true;
                    this.hasChanges = false;
                    this.changeCount = 0;
                    this.changesList = [];

                    // Restaurar selects
                    document.getElementById('papel').value = this.originalData.papel;
                    document.getElementById('status').value = this.originalData.status;
                }
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout.php";
?>