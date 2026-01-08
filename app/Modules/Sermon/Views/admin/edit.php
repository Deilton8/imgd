<?php
ob_start();
?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-amber-50/20 py-8 px-4 sm:px-6 lg:px-8"
    x-data="sermonFormEdit()" x-cloak>
    <div class="max-w-5xl mx-auto">

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
                            <h1 class="text-3xl font-bold text-gray-900">Editar Sermão</h1>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-amber-500 to-orange-500 text-white">
                                ID: <?= $sermao['id'] ?>
                            </span>
                        </div>
                        <p class="text-gray-600">Atualize as informações do sermão "<span
                                class="font-semibold"><?= htmlspecialchars($sermao['titulo']) ?></span>"</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/admin/sermao/<?= $sermao['id'] ?>"
                        class="group inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl hover:border-blue-400 hover:shadow-lg transition-all duration-300 font-medium text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Visualizar
                    </a>
                    <a href="/admin/sermoes"
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
                        <div :class="getStatusClasses('<?= $sermao['status'] ?>')"
                            class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full"
                                :class="getStatusDotClass('<?= $sermao['status'] ?>')"></span>
                            <span x-text="getStatusText('<?= $sermao['status'] ?>')"></span>
                        </div>
                        <div class="text-sm text-gray-600">
                            Última atualização:
                            <?= !empty($sermao['atualizado_em']) ? date('d/m/Y H:i', strtotime($sermao['atualizado_em'])) : 'Nunca' ?>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 text-sm">
                        <div class="text-gray-500">
                            Criado em: <?= date('d/m/Y H:i', strtotime($sermao['criado_em'] ?? 'now')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulário -->
        <form method="POST" class="space-y-8">

            <!-- Seção 1: Informações Básicas -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">
                            1
                        </div>
                        <h2 class="text-xl font-bold text-white">Informações do Sermão</h2>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Título -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="titulo"
                                class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Título do Sermão
                            </label>
                            <span class="text-xs text-gray-500" x-text="`${formData.titulo.length}/255`"></span>
                        </div>
                        <input type="text" name="titulo" id="titulo" required x-model="formData.titulo"
                            @input="validateForm()" :class="{'border-red-300': errors.titulo}"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white text-gray-900 placeholder-gray-400"
                            placeholder="Ex: A Esperança em Cristo, O Amor de Deus..." maxlength="255">
                        <div x-show="errors.titulo" x-transition
                            class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <span x-text="errors.titulo"></span>
                        </div>
                    </div>

                    <!-- Pregador e Data -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Pregador -->
                        <div>
                            <label for="pregador" class="block text-sm font-semibold text-gray-700 mb-2">
                                Pregador
                                <span class="text-xs text-gray-500 font-normal ml-2">(Opcional)</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="pregador" id="pregador" list="pregadores-list"
                                    x-model="formData.pregador"
                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white placeholder-gray-400"
                                    placeholder="Nome do pregador">
                                <datalist id="pregadores-list">
                                    <?php foreach ($pregadores as $pregador): ?>
                                        <option value="<?= htmlspecialchars($pregador) ?>">
                                        <?php endforeach; ?>
                                </datalist>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400">🙏</span>
                                </div>
                            </div>
                        </div>

                        <!-- Data -->
                        <div>
                            <label for="data"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Data do Sermão
                            </label>
                            <input type="date" name="data" id="data" required x-model="formData.data"
                                @change="validateForm()" :class="{'border-red-300': errors.data}"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white cursor-pointer">
                            <div x-show="errors.data" x-transition class="mt-2 text-sm text-red-600">
                                <span x-text="errors.data"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status do Sermão
                        </label>
                        <div class="relative">
                            <select name="status" id="status" x-model="formData.status" @change="updateStatusPreview()"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                <option value="rascunho" <?= $sermao['status'] === 'rascunho' ? 'selected' : '' ?>>📝
                                    Rascunho</option>
                                <option value="publicado" <?= $sermao['status'] === 'publicado' ? 'selected' : '' ?>>🌐
                                    Publicado</option>
                                <option value="arquivado" <?= $sermao['status'] === 'arquivado' ? 'selected' : '' ?>>📁
                                    Arquivado</option>
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
                </div>
            </div>

            <!-- Seção 2: Conteúdo -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">
                            2
                        </div>
                        <h2 class="text-xl font-bold text-white">Conteúdo do Sermão</h2>
                    </div>
                </div>

                <div class="p-6">
                    <div>
                        <label for="conteudo" class="block text-sm font-semibold text-gray-700 mb-2">
                            Mensagem
                            <span class="text-xs text-gray-500 font-normal ml-2">(Opcional)</span>
                        </label>
                        <textarea name="conteudo" id="conteudo" rows="12" x-model="formData.conteudo"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white resize-vertical min-h-[300px]"
                            placeholder="Digite o conteúdo completo do sermão..."></textarea>
                        <div class="flex justify-between mt-2">
                            <span class="text-xs text-gray-500">Use Markdown para formatação</span>
                            <span class="text-xs text-gray-500"
                                x-text="`${formData.conteudo.length} caracteres`"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Mídias -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden"
                x-data="{ selectedMidias: <?= json_encode($midiasSermao ?? []) ?>, searchMedia: '' }">
                <div class="bg-gradient-to-r from-purple-600 to-pink-700 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center text-white">
                            3
                        </div>
                        <h2 class="text-xl font-bold text-white">Mídias Relacionadas</h2>
                        <span class="ml-auto text-sm text-white/80"
                            x-text="`${selectedMidias.length} selecionadas`"></span>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Controles -->
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
                            <button type="button" @click="selectedMidias = []"
                                class="text-sm text-red-600 hover:text-red-800 flex items-center gap-1 transition-colors"
                                x-show="selectedMidias.length > 0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Desmarcar todas
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
                                    x-model="selectedMidias" <?= isset($midiasSermao) && in_array($m['id'], $midiasSermao) ? 'checked' : '' ?>>

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
                                        <video src="/<?= $m['caminho_arquivo'] ?>"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" autoplay muted></video>
                                    <?php elseif ($mediaType === 'audio'): ?>
                                        <div class="w-full h-full flex items-center justify-center text-white">
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-indigo-100">
                                                <span class="text-3xl opacity-70">🎵</span>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-white">
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                                <span class="text-3xl opacity-70">📄</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Badge de já associado -->
                                    <div x-show="selectedMidias.includes('<?= $m['id'] ?>')"
                                        class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-purple-600 text-white text-xs px-2 py-0.5 rounded-full">
                                        Associado
                                    </div>
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

                    <!-- Contador e stats -->
                    <div class="flex items-center justify-between text-sm text-gray-600 pt-4 border-t border-gray-200">
                        <div class="flex items-center gap-4">
                            <span>Total: <?= count($midias) ?> mídias disponíveis</span>
                            <span class="text-purple-600 font-medium"
                                x-text="`${selectedMidias.length} selecionadas`"></span>
                        </div>
                        <a href="/admin/midia" class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Adicionar mais mídias
                        </a>
                    </div>
                </div>
            </div>

            <!-- Informações do Sistema -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-gray-500 rounded-lg flex items-center justify-center text-white text-xs">
                        ⚙️
                    </span>
                    Informações do Sistema
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                    <div class="bg-white rounded-lg p-3 border border-gray-200">
                        <span class="text-gray-500">ID do Sermão:</span>
                        <span class="font-medium text-gray-800 ml-2"><?= $sermao['id'] ?></span>
                    </div>
                    <div class="bg-white rounded-lg p-3 border border-gray-200">
                        <span class="text-gray-500">Slug:</span>
                        <code
                            class="font-medium text-gray-800 ml-2 bg-gray-100 px-2 py-1 rounded text-xs"><?= $sermao['slug'] ?></code>
                    </div>
                    <div class="bg-white rounded-lg p-3 border border-gray-200">
                        <span class="text-gray-500">Criado em:</span>
                        <span class="font-medium text-gray-800 ml-2">
                            <?= date('d/m/Y H:i', strtotime($sermao['criado_em'] ?? 'now')) ?>
                        </span>
                    </div>
                    <?php if (!empty($sermao['atualizado_em'])): ?>
                        <div class="bg-white rounded-lg p-3 border border-gray-200">
                            <span class="text-gray-500">Última atualização:</span>
                            <span class="font-medium text-gray-800 ml-2">
                                <?= date('d/m/Y H:i', strtotime($sermao['atualizado_em'])) ?>
                            </span>
                        </div>
                    <?php endif; ?>
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

                        <button type="submit" name="status" value="rascunho"
                            class="px-6 py-3.5 border border-blue-300 text-blue-700 rounded-xl hover:border-blue-400 hover:text-blue-800 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            Salvar Rascunho
                        </button>

                        <button type="submit" name="status" value="publicado" :disabled="!isFormValid"
                            class="px-8 py-3.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-3 font-semibold focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 min-w-[200px]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Atualizar Sermão
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function sermonFormEdit() {
        return {
            formData: {
                titulo: '<?= addslashes($sermao['titulo']) ?>',
                pregador: '<?= addslashes($sermao['pregador']) ?>',
                data: '<?= date('Y-m-d', strtotime($sermao['data'])) ?>',
                conteudo: '<?= addslashes($sermao['conteudo']) ?>',
                status: '<?= $sermao['status'] ?>'
            },
            originalData: {},
            errors: {},
            isFormValid: true,
            hasChanges: false,
            changeCount: 0,
            changesList: [],

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

            detectChanges() {
                let changes = [];
                let count = 0;

                for (const key in this.formData) {
                    if (this.formData[key] !== this.originalData[key]) {
                        count++;
                        changes.push({
                            field: this.getFieldLabel(key),
                            value: this.formatChangeValue(key, this.formData[key])
                        });
                    }
                }

                this.changeCount = count;
                this.changesList = changes;
                this.hasChanges = count > 0;
            },

            getFieldLabel(key) {
                const labels = {
                    titulo: 'Título',
                    pregador: 'Pregador',
                    data: 'Data',
                    conteudo: 'Conteúdo',
                    status: 'Status'
                };
                return labels[key] || key;
            },

            formatChangeValue(key, value) {
                if (!value) return '(vazio)';

                if (key === 'data') {
                    return new Date(value).toLocaleDateString('pt-BR');
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

                // Validar título
                if (!this.formData.titulo.trim()) {
                    this.errors.titulo = 'Título é obrigatório';
                } else if (this.formData.titulo.trim().length < 3) {
                    this.errors.titulo = 'Título deve ter pelo menos 3 caracteres';
                }

                // Validar data
                if (!this.formData.data) {
                    this.errors.data = 'Data do sermão é obrigatória';
                }

                this.isFormValid = Object.keys(this.errors).length === 0;
            },

            getStatusClasses(status) {
                const classes = {
                    'publicado': 'bg-green-100 text-green-800 border border-green-200',
                    'rascunho': 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                    'arquivado': 'bg-gray-100 text-gray-800 border border-gray-200'
                };
                return classes[status] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getStatusDotClass(status) {
                const classes = {
                    'publicado': 'bg-green-500',
                    'rascunho': 'bg-yellow-500',
                    'arquivado': 'bg-gray-500'
                };
                return classes[status] || 'bg-gray-500';
            },

            getStatusText(status) {
                const texts = {
                    'publicado': 'Publicado',
                    'rascunho': 'Rascunho',
                    'arquivado': 'Arquivado'
                };
                return texts[status] || status;
            },

            getStatusDescription(status) {
                const descriptions = {
                    'publicado': 'Sermão publicado e visível',
                    'rascunho': 'Sermão em edição',
                    'arquivado': 'Sermão arquivado'
                };
                return descriptions[status] || '';
            },

            updateStatusPreview() {
                // Atualiza visualmente o status
            },

            resetToOriginal() {
                if (confirm('Restaurar todos os valores originais? As alterações não salvas serão perdidas.')) {
                    this.formData = { ...this.originalData };
                    this.errors = {};
                    this.isFormValid = true;
                    this.hasChanges = false;
                    this.changeCount = 0;
                    this.changesList = [];

                    // Restaurar status no select
                    document.getElementById('status').value = this.originalData.status;

                    // Restaurar mídias originais
                    const originalMidias = <?= json_encode($midiasSermao ?? []) ?>;
                    if (this.$data && this.$data.selectedMidias) {
                        this.$data.selectedMidias = [...originalMidias];
                    }
                }
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>