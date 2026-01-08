<?php
ob_start();
?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8 px-4 sm:px-6 lg:px-8" x-data="eventForm()"
    x-cloak>
    <div class="max-w-5xl mx-auto">

        <!-- Header com progresso -->
        <div class="mb-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8">
                <div>
                    <div class="flex items-center gap-4 mb-3">
                        <div
                            class="w-14 h-14 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Criar Novo Evento</h1>
                            <p class="text-gray-600 mt-1">Preencha as informações para adicionar um novo evento</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/admin/eventos"
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
                        ['icon' => '📝', 'title' => 'Informações', 'active' => true],
                        ['icon' => '📍', 'title' => 'Localização', 'active' => false],
                        ['icon' => '📎', 'title' => 'Mídias', 'active' => false],
                        ['icon' => '👁️', 'title' => 'Revisão', 'active' => false]
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

        <!-- Formulário -->
        <form method="POST" class="space-y-8">

            <!-- Seção 1: Informações Básicas -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">
                            1
                        </div>
                        <h2 class="text-xl font-bold text-white">Informações Básicas</h2>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Título -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="titulo"
                                class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Título do Evento
                            </label>
                            <span class="text-xs text-gray-500" x-text="`${formData.titulo.length}/255`"></span>
                        </div>
                        <input type="text" name="titulo" id="titulo" required x-model="formData.titulo"
                            @input="validateForm()" :class="{'border-red-300': errors.titulo}"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400"
                            placeholder="Ex: Conferência de Tecnologia 2024" maxlength="255">
                        <div x-show="errors.titulo" x-transition
                            class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <span x-text="errors.titulo"></span>
                        </div>
                    </div>

                    <!-- Descrição -->
                    <div>
                        <label for="descricao" class="block text-sm font-semibold text-gray-700 mb-2">
                            Descrição
                            <span class="text-xs text-gray-500 font-normal ml-2">(Opcional)</span>
                        </label>
                        <textarea name="descricao" id="descricao" rows="4" x-model="formData.descricao"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white resize-vertical min-h-[140px]"
                            placeholder="Descreva o evento, objetivos, público-alvo..."></textarea>
                        <div class="flex justify-between mt-1">
                            <span class="text-xs text-gray-500">Máx. 2000 caracteres</span>
                            <span class="text-xs text-gray-500" x-text="`${formData.descricao.length}/2000`"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Localização e Data -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">
                            2
                        </div>
                        <h2 class="text-xl font-bold text-white">Localização e Data</h2>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Local -->
                        <div>
                            <label for="local" class="block text-sm font-semibold text-gray-700 mb-2">
                                Local do Evento
                                <span class="text-xs text-gray-500 font-normal ml-2">(Opcional)</span>
                            </label>
                            <input type="text" name="local" id="local" x-model="formData.local"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white"
                                placeholder="Ex: Centro de Convenções, Auditório Principal...">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Status do Evento
                            </label>
                            <div class="relative">
                                <select name="status" id="status"
                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                    <option value="pendente">🟡 Pendente</option>
                                    <option value="em_andamento">🔵 Em andamento</option>
                                    <option value="concluido">🟢 Concluído</option>
                                    <option value="cancelado">🔴 Cancelado</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Data Início -->
                        <div>
                            <label for="data_inicio"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Data e Hora de Início
                            </label>
                            <input type="datetime-local" name="data_inicio" id="data_inicio" required
                                x-model="formData.data_inicio" @change="validateDates()"
                                :class="{'border-red-300': errors.data_inicio}"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white cursor-pointer">
                            <div x-show="errors.data_inicio" x-transition class="mt-2 text-sm text-red-600">
                                <span x-text="errors.data_inicio"></span>
                            </div>
                        </div>

                        <!-- Data Fim -->
                        <div>
                            <label for="data_fim" class="block text-sm font-semibold text-gray-700 mb-2">
                                Data e Hora de Término
                                <span class="text-xs text-gray-500 font-normal ml-2">(Opcional)</span>
                            </label>
                            <input type="datetime-local" name="data_fim" id="data_fim" x-model="formData.data_fim"
                                @change="validateDates()" :class="{'border-red-300': errors.data_fim}"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white cursor-pointer"
                                :disabled="!formData.data_inicio">
                        </div>
                    </div>

                    <!-- Preview das datas -->
                    <div x-show="formData.data_inicio" x-transition
                        class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 border border-green-200">
                        <h4 class="font-medium text-green-800 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Pré-visualização das Datas
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-gray-600">Início:</span>
                                <span class="font-medium text-gray-800 ml-2"
                                    x-text="formatDatePreview(formData.data_inicio)"></span>
                            </div>
                            <div x-show="formData.data_fim">
                                <span class="text-gray-600">Término:</span>
                                <span class="font-medium text-gray-800 ml-2"
                                    x-text="formatDatePreview(formData.data_fim)"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Mídias -->
            <?php if (!empty($midias)): ?>
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden"
                    x-data="{ selectedMidias: [], searchMedia: '' }">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-700 px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">
                                3
                            </div>
                            <h2 class="text-xl font-bold text-white">Mídias Relacionadas</h2>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Controles de busca -->
                        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                            <div class="flex-1 max-w-md">
                                <div class="relative">
                                    <input type="text" x-model.debounce.300ms="searchMedia" placeholder="Buscar mídias..."
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-gray-50 hover:bg-white">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600">
                                    <span x-text="selectedMidias.length"></span> selecionadas
                                </span>
                                <button type="button" @click="selectedMidias = []"
                                    class="text-sm text-red-600 hover:text-red-800 flex items-center gap-1 transition-colors"
                                    x-show="selectedMidias.length > 0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Limpar
                                </button>
                            </div>
                        </div>

                        <!-- Grid de mídias -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                            <?php foreach ($midias as $m): ?>
                                <?php
                                $mediaType = $m['tipo_arquivo'];
                                $typeColors = [
                                    'imagem' => 'from-blue-500 to-cyan-500',
                                    'video' => 'from-purple-500 to-pink-500',
                                    'audio' => 'from-amber-500 to-yellow-500',
                                    'documento' => 'from-gray-600 to-gray-700'
                                ];
                                $typeIcons = [
                                    'imagem' => '🖼️',
                                    'video' => '🎬',
                                    'audio' => '🎵',
                                    'documento' => '📄'
                                ];
                                ?>
                                <label
                                    class="group relative bg-white rounded-xl border-2 border-gray-200 p-3 hover:border-purple-400 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
                                    :class="{ 'border-purple-500 shadow-md': selectedMidias.includes('<?= $m['id'] ?>') }"
                                    x-show="!searchMedia || '<?= htmlspecialchars($m['nome_arquivo']) ?>'.toLowerCase().includes(searchMedia.toLowerCase())">

                                    <input type="checkbox" name="midias[]" value="<?= $m['id'] ?>" class="sr-only"
                                        x-model="selectedMidias">

                                    <!-- Checkbox visual -->
                                    <div class="absolute top-3 right-3 w-5 h-5 rounded border border-gray-300 group-hover:border-purple-400 transition-colors flex items-center justify-center"
                                        :class="{
                                     'bg-purple-500 border-purple-500': selectedMidias.includes('<?= $m['id'] ?>'),
                                     'bg-white': !selectedMidias.includes('<?= $m['id'] ?>')
                                 }">
                                        <svg x-show="selectedMidias.includes('<?= $m['id'] ?>')" class="w-3 h-3 text-white"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>

                                    <!-- Ícone de tipo -->
                                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm rounded-lg p-1.5 shadow-sm">
                                        <span class="text-xs"><?= $typeIcons[$mediaType] ?? '📁' ?></span>
                                    </div>

                                    <!-- Preview -->
                                    <div
                                        class="aspect-square rounded-lg overflow-hidden bg-gradient-to-br <?= $typeColors[$mediaType] ?? 'from-gray-100 to-gray-200' ?> mb-3 relative">
                                        <?php if ($mediaType === 'imagem'): ?>
                                            <img src="/<?= $m['caminho_arquivo'] ?>"
                                                alt="<?= htmlspecialchars($m['nome_arquivo']) ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        <?php elseif ($mediaType === 'video'): ?>
                                            <div class="w-full h-full flex items-center justify-center">
                                                <video src="/<?= $m['caminho_arquivo'] ?>"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                    autoplay muted loop playsinline>
                                                </video>
                                            </div>
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-white">
                                                <span class="text-3xl opacity-80"><?= $typeIcons[$mediaType] ?? '📁' ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Nome do arquivo -->
                                    <p class="text-sm font-medium text-gray-800 truncate text-center group-hover:text-purple-600 transition-colors mb-1"
                                        :class="{ 'text-purple-600': selectedMidias.includes('<?= $m['id'] ?>') }">
                                        <?= htmlspecialchars($m['nome_arquivo']) ?>
                                    </p>

                                    <!-- Informações -->
                                    <div class="flex items-center justify-center gap-2 text-xs text-gray-500">
                                        <span class="uppercase"><?= $mediaType ?></span>
                                        <span>•</span>
                                        <span><?= round($m['tamanho'] / 1024, 1) ?> KB</span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Empty state sem mídias -->
                <div class="bg-white rounded-2xl shadow-lg border-2 border-dashed border-gray-300 p-8 text-center">
                    <div
                        class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Nenhuma mídia disponível</h3>
                    <p class="text-gray-500 mb-6">Faça upload de mídias primeiro para associá-las ao evento</p>
                    <a href="/admin/midia"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-medium transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Ir para Upload de Mídias
                    </a>
                </div>
            <?php endif; ?>

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
                            class="px-8 py-3.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-3 font-semibold focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 min-w-[200px]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Criar Evento
                        </button>
                    </div>
                </div>
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
                local: '',
                data_inicio: '',
                data_fim: ''
            },
            errors: {},
            isFormValid: false,

            get totalRequiredFields() {
                return 2; // título e data_inicio
            },

            get requiredFieldsCompleted() {
                let completed = 0;
                if (this.formData.titulo.trim().length > 0) completed++;
                if (this.formData.data_inicio) completed++;
                return completed;
            },

            validateForm() {
                this.errors = {};

                // Validar título
                if (!this.formData.titulo.trim()) {
                    this.errors.titulo = 'Título é obrigatório';
                } else if (this.formData.titulo.trim().length < 3) {
                    this.errors.titulo = 'Título deve ter pelo menos 3 caracteres';
                }

                // Validar data início
                if (!this.formData.data_inicio) {
                    this.errors.data_inicio = 'Data de início é obrigatória';
                } else {
                    const startDate = new Date(this.formData.data_inicio);
                    const now = new Date();
                    if (startDate < now) {
                        this.errors.data_inicio = 'Data de início deve ser no futuro';
                    }
                }

                // Validar data fim
                if (this.formData.data_fim) {
                    const startDate = new Date(this.formData.data_inicio);
                    const endDate = new Date(this.formData.data_fim);
                    if (endDate <= startDate) {
                        this.errors.data_fim = 'Data de término deve ser após a data de início';
                    }
                }

                this.isFormValid = Object.keys(this.errors).length === 0 &&
                    this.formData.titulo.trim() &&
                    this.formData.data_inicio;
            },

            validateDates() {
                this.validateForm();
            },

            formatDatePreview(dateString) {
                if (!dateString) return '';
                const date = new Date(dateString);
                return date.toLocaleDateString('pt-BR', {
                    weekday: 'long',
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            },

            resetForm() {
                if (confirm('Tem certeza que deseja limpar todos os campos do formulário? Todas as alterações serão perdidas.')) {
                    this.formData = {
                        titulo: '',
                        descricao: '',
                        local: '',
                        data_inicio: '',
                        data_fim: ''
                    };
                    this.errors = {};
                    this.isFormValid = false;

                    // Limpar checkboxes de mídias
                    document.querySelectorAll('input[name="midias[]"]').forEach(checkbox => {
                        checkbox.checked = false;
                    });

                    // Resetar estado das mídias se estiver usando Alpine
                    if (this.$data.selectedMidias) {
                        this.$data.selectedMidias = [];
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

                // Validar ao carregar
                this.validateForm();
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>