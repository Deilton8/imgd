<?php
ob_start();
?>

<div class="max-w-4xl mx-auto mt-6 mb-10 px-4 sm:px-6">
    <!-- Card principal -->
    <div class="bg-white shadow-2xl rounded-2xl p-6 sm:p-8 border border-gray-200 relative overflow-hidden">

        <!-- Elementos decorativos -->
        <div
            class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-full -mr-20 -mt-20">
        </div>
        <div
            class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-green-50 to-emerald-100 rounded-full -ml-16 -mb-16">
        </div>

        <!-- Cabeçalho -->
        <div class="mb-8 relative z-10">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                        <span
                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white">
                            📅
                        </span>
                        Criar Novo Evento
                    </h1>
                    <p class="text-gray-600 mt-2 text-lg">Preencha as informações abaixo para adicionar um novo evento
                        ao sistema.</p>
                </div>

                <a href="/admin/eventos"
                    class="inline-flex items-center gap-2 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    <span>←</span>
                    Voltar à Lista
                </a>
            </div>
        </div>

        <!-- Formulário -->
        <form method="POST" class="space-y-8 relative z-10" x-data="eventForm()">

            <!-- Seção: Informações Básicas -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-sm">
                        1
                    </span>
                    Informações Básicas do Evento
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Título -->
                    <div class="lg:col-span-2">
                        <label for="titulo"
                            class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <span class="text-red-500">*</span>
                            Título do Evento
                        </label>
                        <input type="text" name="titulo" id="titulo" required x-model="formData.titulo"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white placeholder-gray-400"
                            placeholder="Ex: Conferência de Tecnologia 2024" maxlength="255">
                        <p class="text-xs text-gray-500 mt-1" x-text="`${formData.titulo.length}/255 caracteres`"></p>
                    </div>

                    <!-- Descrição -->
                    <div class="lg:col-span-2">
                        <label for="descricao" class="block text-sm font-semibold text-gray-700 mb-2">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="4" x-model="formData.descricao"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white resize-vertical min-h-[120px]"
                            placeholder="Descreva o evento, objetivos, público-alvo..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Seção: Local e Data -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center text-white text-sm">
                        2
                    </span>
                    Localização e Data
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Local -->
                    <div>
                        <label for="local" class="block text-sm font-semibold text-gray-700 mb-2">Local do
                            Evento</label>
                        <input type="text" name="local" id="local"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white hover:bg-green-50 focus:bg-white"
                            placeholder="Ex: Centro de Convenções, Auditório Principal...">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status do
                            Evento</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white hover:bg-green-50 focus:bg-white appearance-none cursor-pointer">
                            <option value="pendente">🟡 Pendente</option>
                            <option value="em_andamento">🔵 Em andamento</option>
                            <option value="concluido">🟢 Concluído</option>
                            <option value="cancelado">🔴 Cancelado</option>
                        </select>
                    </div>

                    <!-- Data Início -->
                    <div>
                        <label for="data_inicio"
                            class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <span class="text-red-500">*</span>
                            Data e Hora de Início
                        </label>
                        <input type="date" name="data_inicio" id="data_inicio" required x-model="formData.data_inicio"
                            @change="validateDates()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white hover:bg-green-50 focus:bg-white cursor-pointer">
                    </div>

                    <!-- Data Fim -->
                    <div>
                        <label for="data_fim" class="block text-sm font-semibold text-gray-700 mb-2">Data e Hora de
                            Término</label>
                        <input type="date" name="data_fim" id="data_fim" x-model="formData.data_fim"
                            @change="validateDates()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white hover:bg-green-50 focus:bg-white cursor-pointer">
                    </div>

                    <!-- Validação de datas -->
                    <div class="lg:col-span-2" x-show="dateError" x-transition>
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                            <p class="text-red-700 text-sm font-medium flex items-center gap-2">
                                <span class="text-red-500">⚠</span>
                                <span x-text="dateError"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção: Mídias -->
            <?php if (!empty($midias)): ?>
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-200"
                    x-data="{ selectedMidias: [] }">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center text-white text-sm">
                            3
                        </span>
                        Mídias Relacionadas
                        <span class="text-sm font-normal text-gray-600 ml-2"
                            x-text="`(${selectedMidias.length} selecionadas)`"></span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <?php foreach ($midias as $m): ?>
                            <label
                                class="group relative bg-white rounded-xl border-2 border-gray-200 p-3 hover:border-purple-400 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
                                :class="{ 'border-purple-500 bg-purple-50 shadow-md': selectedMidias.includes('<?= $m['id'] ?>') }">

                                <input type="checkbox" name="midias[]" value="<?= $m['id'] ?>"
                                    class="absolute top-3 right-3 w-5 h-5 text-purple-600 rounded focus:ring-purple-500 cursor-pointer"
                                    x-model="selectedMidias">

                                <!-- Overlay de seleção -->
                                <div class="absolute inset-0 bg-purple-500 bg-opacity-0 group-hover:bg-opacity-5 rounded-xl transition-all duration-300"
                                    :class="{ 'bg-opacity-10': selectedMidias.includes('<?= $m['id'] ?>') }"></div>

                                <!-- Ícone de tipo -->
                                <div class="absolute top-3 left-3 bg-white bg-opacity-90 rounded-lg p-1.5 shadow-sm">
                                    <?php if ($m['tipo_arquivo'] === 'imagem'): ?>
                                        <span class="text-xs">🖼️</span>
                                    <?php elseif ($m['tipo_arquivo'] === 'video'): ?>
                                        <span class="text-xs">🎬</span>
                                    <?php elseif ($m['tipo_arquivo'] === 'audio'): ?>
                                        <span class="text-xs">🎵</span>
                                    <?php else: ?>
                                        <span class="text-xs">📄</span>
                                    <?php endif; ?>
                                </div>

                                <!-- Preview -->
                                <div class="aspect-square rounded-lg overflow-hidden bg-gray-100 mb-3">
                                    <?php if ($m['tipo_arquivo'] === 'imagem'): ?>
                                        <img src="/<?= $m['caminho_arquivo'] ?>" alt="<?= htmlspecialchars($m['nome_arquivo']) ?>"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <?php elseif ($m['tipo_arquivo'] === 'video'): ?>
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-100 to-pink-100">
                                            <video src="/<?= $m['caminho_arquivo'] ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                autoplay muted></video>
                                        </div>
                                    <?php elseif ($m['tipo_arquivo'] === 'audio'): ?>
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-100 to-emerald-100">
                                            <span class="text-4xl opacity-70">🎵</span>
                                        </div>
                                    <?php else: ?>
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                            <span class="text-4xl opacity-70">📄</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Nome do arquivo -->
                                <p class="text-sm font-medium text-gray-800 truncate text-center group-hover:text-purple-600 transition-colors"
                                    :class="{ 'text-purple-600': selectedMidias.includes('<?= $m['id'] ?>') }">
                                    <?= htmlspecialchars($m['nome_arquivo']) ?>
                                </p>

                                <!-- Tipo e tamanho -->
                                <p class="text-xs text-gray-500 text-center mt-1">
                                    <?= strtoupper($m['tipo_arquivo']) ?> •
                                    <?= round($m['tamanho'] / (1024 * 1024), 2) ?>MB
                                </p>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($midias)): ?>
                        <div class="text-center py-8">
                            <div class="text-6xl mb-4 text-gray-300">📁</div>
                            <p class="text-gray-500 text-lg">Nenhuma mídia disponível</p>
                            <p class="text-gray-400 text-sm">Faça upload de mídias primeiro para associá-las ao evento</p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-200">
                <div class="flex flex-wrap gap-3">
                    <button type="button" onclick="window.history.back()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 flex items-center gap-2">
                        <span>←</span>
                        Cancelar
                    </button>

                    <button type="button" @click="clearForm()"
                        class="px-6 py-3 border border-amber-300 text-amber-700 rounded-xl hover:border-amber-400 hover:text-amber-800 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 flex items-center gap-2">
                        <span>🔄</span>
                        Limpar Formulário
                    </button>
                </div>

                <button type="submit"
                    class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-3 font-semibold focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 min-w-[180px] justify-center">
                    <span class="text-lg">💾</span>
                    Criar Evento
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function eventForm() {
        return {
            formData: {
                titulo: '',
                descricao: '',
                data_inicio: '',
                data_fim: ''
            },
            dateError: '',

            validateDates() {
                this.dateError = '';

                if (!this.formData.data_inicio) return;

                const inicio = new Date(this.formData.data_inicio);
                const fim = this.formData.data_fim ? new Date(this.formData.data_fim) : null;

                // Validar se data de início é no futuro
                if (inicio < new Date()) {
                    this.dateError = 'A data de início deve ser uma data futura.';
                    return;
                }

                // Validar se data fim é após data início
                if (fim && fim <= inicio) {
                    this.dateError = 'A data de término deve ser posterior à data de início.';
                    return;
                }
            },

            clearForm() {
                if (confirm('Tem certeza que deseja limpar todos os campos do formulário?')) {
                    this.formData = {
                        titulo: '',
                        descricao: '',
                        data_inicio: '',
                        data_fim: ''
                    };
                    this.dateError = '';

                    // Limpar checkboxes de mídias
                    if (this.$el.querySelectorAll('input[type="checkbox"]')) {
                        this.$el.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                            checkbox.checked = false;
                        });
                    }
                }
            },

            init() {
                // Configurar data mínima para os campos de data
                const now = new Date();
                now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
                const minDateTime = now.toISOString().slice(0, 16);

                document.getElementById('data_inicio').min = minDateTime;
                document.getElementById('data_fim').min = minDateTime;
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>