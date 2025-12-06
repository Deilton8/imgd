<?php
ob_start();
$flashMessage = $_SESSION['flash'] ?? null;
$old = $_SESSION['old'] ?? [];
unset($_SESSION['flash'], $_SESSION['old']);

// Preferir dados antigos (em caso de erro) ou dados do usuário
$userData = !empty($old) ? array_merge($usuario, $old) : $usuario;
?>

<div class="min-h-screen bg-gray-50/30 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Card Principal -->
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-gray-200">

            <!-- Cabeçalho -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center text-white text-xl">
                            ✏️
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Editar Usuário</h1>
                            <p class="text-gray-600 mt-1 text-lg">ID: <?= $userData['id'] ?> • Atualize as informações
                                de <strong><?= htmlspecialchars($userData['nome']) ?></strong></p>
                        </div>
                    </div>

                    <a href="/admin/usuarios"
                        class="inline-flex items-center gap-2 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        <span>←</span>
                        Voltar à Lista
                    </a>
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
                    class="mb-6 p-4 rounded-2xl border-l-4 <?= $flashMessage['type'] === 'error' ? 'bg-red-50 border-red-400 text-red-700' : 'bg-green-50 border-green-400 text-green-700' ?>">
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
            <form method="POST" class="space-y-8" x-data="userForm()">

                <!-- Seção: Informações Básicas -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span
                            class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-sm">
                            1
                        </span>
                        Informações Básicas
                    </h2>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- ID (readonly) -->
                        <div class="bg-white rounded-xl p-4 border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ID do Usuário</label>
                            <div class="flex items-center gap-3">
                                <span
                                    class="text-lg font-mono text-gray-800 bg-gray-100 px-3 py-1 rounded-lg">#<?= $userData['id'] ?></span>
                                <span class="text-xs text-gray-500">Identificador único do usuário</span>
                            </div>
                        </div>

                        <!-- Nome -->
                        <div>
                            <label for="nome"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Nome Completo
                            </label>
                            <input type="text" name="nome" id="nome" x-model="formData.nome"
                                value="<?= htmlspecialchars($userData['nome']) ?>" required minlength="2"
                                maxlength="100"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white placeholder-gray-400"
                                placeholder="Digite o nome completo do usuário">
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-xs text-gray-500">Mínimo 2 caracteres</p>
                                <p class="text-xs text-gray-500" x-text="`${formData.nome.length}/100 caracteres`"></p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Email
                            </label>
                            <input type="email" name="email" id="email" x-model="formData.email"
                                value="<?= htmlspecialchars($userData['email']) ?>" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white placeholder-gray-400"
                                placeholder="exemplo@dominio.com">
                        </div>
                    </div>
                </div>

                <!-- Seção: Segurança e Acesso -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span
                            class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center text-white text-sm">
                            2
                        </span>
                        Segurança e Acesso
                    </h2>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Senha -->
                        <div>
                            <label for="senha" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nova Senha
                                <span class="text-gray-500 font-normal text-sm">(opcional)</span>
                            </label>
                            <div class="relative">
                                <input :type="showPassword ? 'text' : 'password'" name="senha" id="senha"
                                    x-model="formData.senha" minlength="6"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white hover:bg-green-50 focus:bg-white placeholder-gray-400 pr-12"
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
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-xs text-gray-500">Mínimo 6 caracteres. Deixe em branco para manter a
                                    atual</p>
                                <p class="text-xs"
                                    :class="formData.senha.length >= 6 ? 'text-green-600' : 'text-gray-500'"
                                    x-text="formData.senha.length > 0 ? `${formData.senha.length}/∞ caracteres` : ''">
                                </p>
                            </div>
                        </div>

                        <!-- Papel e Status -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Papel -->
                            <div>
                                <label for="papel" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Papel do Usuário
                                </label>
                                <select name="papel" id="papel"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white hover:bg-green-50 focus:bg-white appearance-none cursor-pointer">
                                    <option value="editor" <?= $userData['papel'] === 'editor' ? 'selected' : '' ?>>
                                        ✏️ Editor
                                    </option>
                                    <option value="admin" <?= $userData['papel'] === 'admin' ? 'selected' : '' ?>>
                                        👑 Administrador
                                    </option>
                                </select>
                                <p class="text-xs text-gray-500 mt-1"
                                    x-text="getRoleDescription(document.getElementById('papel').value)"></p>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Status da Conta
                                </label>
                                <select name="status" id="status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white hover:bg-green-50 focus:bg-white appearance-none cursor-pointer">
                                    <option value="ativo" <?= $userData['status'] === 'ativo' ? 'selected' : '' ?>>
                                        🟢 Ativo
                                    </option>
                                    <option value="inativo" <?= $userData['status'] === 'inativo' ? 'selected' : '' ?>>
                                        🔴 Inativo
                                    </option>
                                </select>
                                <p class="text-xs text-gray-500 mt-1"
                                    x-text="getStatusDescription(document.getElementById('status').value)"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seção: Informações do Sistema -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <span
                            class="w-6 h-6 bg-gray-500 rounded-lg flex items-center justify-center text-white text-xs">
                            ⚙️
                        </span>
                        Informações do Sistema
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                        <div class="bg-white rounded-lg p-3 border border-gray-200">
                            <span class="text-gray-500">ID do Usuário:</span>
                            <span class="font-medium text-gray-800 ml-2"><?= $userData['id'] ?></span>
                        </div>
                        <div class="bg-white rounded-lg p-3 border border-gray-200">
                            <span class="text-gray-500">Criado em:</span>
                            <span class="font-medium text-gray-800 ml-2">
                                <?= date('d/m/Y H:i', strtotime($userData['criado_em'] ?? 'now')) ?>
                            </span>
                        </div>
                        <?php if (!empty($userData['atualizado_em'])): ?>
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <span class="text-gray-500">Última atualização:</span>
                                <span class="font-medium text-gray-800 ml-2">
                                    <?= date('d/m/Y H:i', strtotime($userData['atualizado_em'])) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Ações -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-200">
                    <div class="flex flex-wrap gap-3">
                        <a href="/admin/usuarios"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 flex items-center gap-2">
                            <span>←</span>
                            Cancelar
                        </a>

                        <button type="button" @click="resetToOriginal()"
                            class="px-6 py-3 border border-amber-300 text-amber-700 rounded-xl hover:border-amber-400 hover:text-amber-800 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 flex items-center gap-2">
                            <span>🔄</span>
                            Restaurar Original
                        </button>

                        <a href="/admin/usuario/<?= $userData['id'] ?>"
                            class="px-6 py-3 border border-blue-300 text-blue-700 rounded-xl hover:border-blue-400 hover:text-blue-800 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 flex items-center gap-2">
                            <span>👁️</span>
                            Visualizar
                        </a>
                    </div>

                    <button type="submit"
                        class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-3 font-semibold focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 min-w-[180px] justify-center">
                        <span class="text-lg">💾</span>
                        Atualizar Usuário
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function userForm() {
        return {
            formData: {
                nome: '<?= addslashes($userData['nome']) ?>',
                email: '<?= addslashes($userData['email']) ?>',
                senha: ''
            },
            showPassword: false,

            resetToOriginal() {
                if (confirm('Tem certeza que deseja restaurar todos os valores originais? As alterações não salvas serão perdidas.')) {
                    this.formData = {
                        nome: '<?= addslashes($userData['nome']) ?>',
                        email: '<?= addslashes($userData['email']) ?>',
                        senha: ''
                    };

                    // Restaurar selects originais
                    document.getElementById('papel').value = '<?= $userData['papel'] ?>';
                    document.getElementById('status').value = '<?= $userData['status'] ?>';
                }
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

            init() {
                // Atualizar descrições quando os selects mudarem
                document.getElementById('papel').addEventListener('change', (e) => {
                    this.$nextTick(() => {
                        // A descrição será atualizada automaticamente via x-text
                    });
                });

                document.getElementById('status').addEventListener('change', (e) => {
                    this.$nextTick(() => {
                        // A descrição será atualizada automaticamente via x-text
                    });
                });
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout.php";
?>