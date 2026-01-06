<?php
ob_start();
$flashMessage = $_SESSION['flash'] ?? null;
$old = $_SESSION['old'] ?? [];
unset($_SESSION['flash'], $_SESSION['old']);
?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 py-8 px-4 sm:px-6 lg:px-8" x-data="userForm()"
    x-cloak>
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8">
                <div class="flex items-start gap-4">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-cyan-600 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Criar Novo Usuário</h1>
                        <p class="text-gray-600 mt-1">Preencha as informações para adicionar um novo membro ao sistema
                        </p>
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
                        Voltar
                    </a>
                </div>
            </div>

            <!-- Progress Steps -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <div class="flex items-center justify-between relative">
                    <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-gray-200 -translate-y-1/2 z-0"></div>

                    <?php
                    $steps = [
                        ['icon' => '👤', 'title' => 'Informações', 'active' => true],
                        ['icon' => '🔐', 'title' => 'Acesso', 'active' => false],
                        ['icon' => '👑', 'title' => 'Permissões', 'active' => false]
                    ];
                    ?>

                    <?php foreach ($steps as $index => $step): ?>
                        <div class="flex flex-col items-center relative z-10">
                            <div
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-100 to-blue-50 border-2 border-blue-300 text-blue-700 font-semibold text-lg shadow-sm">
                                <?= $step['icon'] ?>
                            </div>
                            <span class="mt-2 text-sm font-medium text-gray-700"><?= $step['title'] ?></span>
                        </div>
                    <?php endforeach; ?>
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
                            value="<?= htmlspecialchars($old['nome'] ?? '') ?>" @input="validateForm()"
                            :class="{'border-red-300': errors.nome}"
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
                        <div class="flex justify-between mt-1">
                            <span class="text-xs text-gray-500">Mínimo 2 caracteres</span>
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
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>" @input="validateForm()"
                            :class="{'border-red-300': errors.email}"
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

            <!-- Seção 2: Acesso e Segurança -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">2</div>
                        <h2 class="text-xl font-bold text-white">Acesso e Segurança</h2>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Senha -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="senha"
                                class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Senha
                            </label>
                            <span class="text-xs text-gray-500"
                                :class="formData.senha.length >= 6 ? 'text-green-600' : 'text-gray-500'"
                                x-text="`${formData.senha.length}/∞`"></span>
                        </div>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="senha" id="senha" required
                                x-model="formData.senha" @input="validateForm()" minlength="6"
                                :class="{'border-red-300': errors.senha}"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400 pr-12"
                                placeholder="Digite uma senha segura">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors p-2">
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
                        <div class="flex justify-between mt-1">
                            <span class="text-xs text-gray-500">Mínimo 6 caracteres</span>
                            <span class="text-xs"
                                :class="formData.senha.length >= 6 ? 'text-green-600' : 'text-gray-500'">
                                <span x-text="passwordStrength.text"></span> <span
                                    x-text="passwordStrength.score + '/5'"></span>
                            </span>
                        </div>

                        <!-- Barra de força da senha -->
                        <div class="mt-2">
                            <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full transition-all duration-300" :class="passwordStrength.color"
                                    :style="`width: ${(passwordStrength.score / 5) * 100}%`"></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Papel -->
                        <div>
                            <label for="papel" class="block text-sm font-semibold text-gray-700 mb-2">
                                Papel do Usuário
                            </label>
                            <div class="relative">
                                <select name="papel" id="papel" x-model="formData.papel"
                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                    <option value="editor" <?= ($old['papel'] ?? 'editor') === 'editor' ? 'selected' : '' ?>>✏️ Editor</option>
                                    <option value="admin" <?= ($old['papel'] ?? '') === 'admin' ? 'selected' : '' ?>>👑
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
                                <select name="status" id="status" x-model="formData.status"
                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                    <option value="ativo" <?= ($old['status'] ?? 'ativo') === 'ativo' ? 'selected' : '' ?>>
                                        🟢 Ativo</option>
                                    <option value="inativo" <?= ($old['status'] ?? '') === 'inativo' ? 'selected' : '' ?>>
                                        🔴 Inativo</option>
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

            <!-- Seção 3: Informações Importantes -->
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-3">
                    <span
                        class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center text-white text-sm">💡</span>
                    Informações Importantes
                </h2>

                <div class="space-y-3 text-sm text-amber-700">
                    <div class="flex items-start gap-3">
                        <span
                            class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">📧</span>
                        <p>O usuário receberá um email de boas-vindas com as instruções de acesso</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <span
                            class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">👑</span>
                        <p>Administradores têm acesso total ao sistema, incluindo gerenciamento de usuários</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <span
                            class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">🔒</span>
                        <p>Usuários inativos não podem fazer login no sistema</p>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <!-- Contador e validação -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full"
                                    :class="{'bg-green-500': isFormValid, 'bg-red-500': !isFormValid}"></span>
                                <span class="text-sm font-medium"
                                    :class="{'text-green-600': isFormValid, 'text-red-600': !isFormValid}">
                                    <span x-text="isFormValid ? 'Formulário válido' : 'Formulário incompleto'"></span>
                                </span>
                            </div>
                            <span class="text-xs text-gray-500">
                                Campos obrigatórios: <span x-text="requiredFieldsCompleted"></span>/<span
                                    x-text="totalRequiredFields"></span>
                            </span>
                        </div>
                        <div x-show="Object.keys(errors).length > 0" x-transition class="space-y-1">
                            <template x-for="error in Object.values(errors)" :key="error">
                                <p class="text-xs text-red-600 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    <span x-text="error"></span>
                                </p>
                            </template>
                        </div>
                    </div>

                    <!-- Botões de ação -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="button" @click="resetForm()"
                            class="px-6 py-3.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Limpar Tudo
                        </button>

                        <button type="submit" :disabled="!isFormValid"
                            class="px-8 py-3.5 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-3 font-semibold focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 min-w-[200px]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Criar Usuário
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function userForm() {
        return {
            formData: {
                nome: '<?= addslashes($old['nome'] ?? '') ?>',
                email: '<?= addslashes($old['email'] ?? '') ?>',
                senha: '',
                papel: '<?= $old['papel'] ?? 'editor' ?>',
                status: '<?= $old['status'] ?? 'ativo' ?>'
            },
            errors: {},
            isFormValid: false,
            showPassword: false,

            get totalRequiredFields() {
                return 3; // nome, email e senha
            },

            get requiredFieldsCompleted() {
                let completed = 0;
                if (this.formData.nome.trim().length >= 2) completed++;
                if (this.formData.email.trim().length > 0 && this.isValidEmail(this.formData.email)) completed++;
                if (this.formData.senha.length >= 6) completed++;
                return completed;
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

                // Validar senha
                if (!this.formData.senha) {
                    this.errors.senha = 'Senha é obrigatória';
                } else if (this.formData.senha.length < 6) {
                    this.errors.senha = 'Senha deve ter pelo menos 6 caracteres';
                }

                this.isFormValid = Object.keys(this.errors).length === 0 &&
                    this.formData.nome.trim().length >= 2 &&
                    this.formData.email.trim() &&
                    this.isValidEmail(this.formData.email) &&
                    this.formData.senha.length >= 6;
            },

            getRoleDescription(role) {
                const descriptions = {
                    'admin': 'Acesso completo ao sistema',
                    'editor': 'Pode criar e editar conteúdo'
                };
                return descriptions[role] || '';
            },

            getStatusDescription(status) {
                const descriptions = {
                    'ativo': 'Usuário pode fazer login',
                    'inativo': 'Usuário não pode fazer login'
                };
                return descriptions[status] || '';
            },

            resetForm() {
                if (confirm('Tem certeza que deseja limpar todos os campos do formulário? Todas as alterações serão perdidas.')) {
                    this.formData = {
                        nome: '',
                        email: '',
                        senha: '',
                        papel: 'editor',
                        status: 'ativo'
                    };
                    this.errors = {};
                    this.isFormValid = false;
                    this.showPassword = false;
                }
            },

            init() {
                this.validateForm();
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout.php";
?>