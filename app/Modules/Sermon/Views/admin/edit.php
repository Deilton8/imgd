<?php
ob_start();
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
                            <h1 class="text-3xl font-bold text-gray-900">Editar Sermão</h1>
                            <p class="text-gray-600 mt-1 text-lg">ID: <?= $sermao['id'] ?> • Atualize as informações do
                                sermão</p>
                        </div>
                    </div>

                    <a href="/admin/sermoes"
                        class="inline-flex items-center gap-2 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        <span>←</span>
                        Voltar à Lista
                    </a>
                </div>
            </div>

            <!-- Formulário -->
            <form method="POST" class="space-y-8" x-data="sermonForm()">

                <!-- Seção: Informações Básicas -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span
                            class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-sm">
                            1
                        </span>
                        Informações do Sermão
                    </h2>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Título -->
                        <div>
                            <label for="titulo"
                                class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Título do Sermão
                            </label>
                            <input type="text" name="titulo" id="titulo" required x-model="formData.titulo"
                                value="<?= htmlspecialchars($sermao['titulo']) ?>"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white placeholder-gray-400"
                                placeholder="Ex: A Esperança em Cristo, O Amor de Deus..." maxlength="255">
                            <p class="text-xs text-gray-500 mt-1" x-text="`${formData.titulo.length}/255 caracteres`">
                            </p>
                        </div>

                        <!-- Pregador e Data -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Pregador -->
                            <div>
                                <label for="pregador" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Pregador
                                </label>
                                <div class="relative">
                                    <input type="text" name="pregador" id="pregador" list="pregadores-list"
                                        x-model="formData.pregador" value="<?= htmlspecialchars($sermao['pregador']) ?>"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white placeholder-gray-400"
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
                                    value="<?= date('Y-m-d', strtotime($sermao['data'])) ?>"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white cursor-pointer">
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status" id="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white appearance-none cursor-pointer">
                                <option value="rascunho" <?= $sermao['status'] === 'rascunho' ? 'selected' : '' ?>>📝
                                    Rascunho</option>
                                <option value="publicado" <?= $sermao['status'] === 'publicado' ? 'selected' : '' ?>>🌐
                                    Publicado</option>
                                <option value="arquivado" <?= $sermao['status'] === 'arquivado' ? 'selected' : '' ?>>📁
                                    Arquivado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Seção: Conteúdo -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span
                            class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center text-white text-sm">
                            2
                        </span>
                        Conteúdo do Sermão
                    </h2>

                    <div>
                        <label for="conteudo" class="block text-sm font-semibold text-gray-700 mb-2">
                            Mensagem
                        </label>
                        <textarea name="conteudo" id="conteudo" rows="12" x-model="formData.conteudo"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-300 bg-white hover:bg-green-50 focus:bg-white resize-vertical min-h-[300px]"
                            placeholder="Digite o conteúdo completo do sermão..."><?= htmlspecialchars($sermao['conteudo']) ?></textarea>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-xs text-gray-500" x-text="`${formData.conteudo.length} caracteres`"></p>
                            <p class="text-xs text-gray-400">Use Markdown para formatação</p>
                        </div>
                    </div>
                </div>

                <!-- Seção: Mídias -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-200"
                    x-data="{ selectedMidias: <?= json_encode($midiasSermao ?? []) ?> }">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span
                            class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center text-white text-sm">
                            3
                        </span>
                        Mídias Relacionadas
                        <span class="text-sm font-normal text-gray-600 ml-2"
                            x-text="`(${selectedMidias.length} selecionadas)`"></span>
                    </h2>

                    <p class="text-sm text-gray-600 mb-4">
                        Selecione áudios, vídeos ou imagens relacionados a este sermão
                    </p>

                    <?php if (!empty($midias)): ?>
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 max-h-96 overflow-y-auto p-2">
                            <?php foreach ($midias as $m): ?>
                                <label
                                    class="group relative bg-white rounded-xl border-2 border-gray-200 p-3 hover:border-purple-400 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
                                    :class="{ 'border-purple-500 bg-purple-50 shadow-md': selectedMidias.includes('<?= $m['id'] ?>') }">

                                    <input type="checkbox" name="midias[]" value="<?= $m['id'] ?>"
                                        class="absolute top-3 right-3 w-5 h-5 text-purple-600 rounded focus:ring-purple-500 cursor-pointer"
                                        x-model="selectedMidias" <?= in_array($m['id'], $midiasSermao ?? []) ? 'checked' : '' ?>>

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
                                            <img src="/<?= $m['caminho_arquivo'] ?>"
                                                alt="<?= htmlspecialchars($m['nome_arquivo']) ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        <?php elseif ($m['tipo_arquivo'] === 'video'): ?>
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-100 to-pink-100">
                                                <span class="text-3xl opacity-70">🎬</span>
                                            </div>
                                        <?php elseif ($m['tipo_arquivo'] === 'audio'): ?>
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-indigo-100">
                                                <span class="text-3xl opacity-70">🎵</span>
                                            </div>
                                        <?php else: ?>
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                                <span class="text-3xl opacity-70">📄</span>
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
                    <?php else: ?>
                        <div class="text-center py-8">
                            <div class="text-6xl mb-4 text-gray-300">📁</div>
                            <p class="text-gray-500 text-lg mb-2">Nenhuma mídia disponível</p>
                            <p class="text-gray-400 text-sm mb-4">Faça upload de mídias primeiro para associá-las ao sermão
                            </p>
                            <a href="/admin/midia/criar"
                                class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition-colors">
                                <span>📤</span>
                                Fazer Upload de Mídia
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Informações do Sistema -->
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <span
                            class="w-6 h-6 bg-gray-500 rounded-lg flex items-center justify-center text-white text-xs">
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
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-200">
                    <div class="flex flex-wrap gap-3">
                        <a href="/admin/sermoes"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 flex items-center gap-2">
                            <span>←</span>
                            Cancelar
                        </a>

                        <button type="button" @click="resetToOriginal()"
                            class="px-6 py-3 border border-amber-300 text-amber-700 rounded-xl hover:border-amber-400 hover:text-amber-800 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 flex items-center gap-2">
                            <span>🔄</span>
                            Restaurar Original
                        </button>

                        <a href="/admin/sermao/<?= $sermao['id'] ?>"
                            class="px-6 py-3 border border-blue-300 text-blue-700 rounded-xl hover:border-blue-400 hover:text-blue-800 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 flex items-center gap-2">
                            <span>👁️</span>
                            Visualizar
                        </a>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit" name="status" value="rascunho"
                            class="px-6 py-3 border border-blue-300 text-blue-700 rounded-xl hover:border-blue-400 hover:text-blue-800 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 flex items-center gap-2">
                            <span>💾</span>
                            Salvar Rascunho
                        </button>

                        <button type="submit" name="status" value="publicado"
                            class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-3 font-semibold focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 min-w-[180px] justify-center">
                            <span class="text-lg">🚀</span>
                            Atualizar Sermão
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function sermonForm() {
        return {
            formData: {
                titulo: '<?= addslashes($sermao['titulo']) ?>',
                pregador: '<?= addslashes($sermao['pregador']) ?>',
                data: '<?= date('Y-m-d', strtotime($sermao['data'])) ?>',
                conteudo: '<?= addslashes($sermao['conteudo']) ?>'
            },

            resetToOriginal() {
                if (confirm('Tem certeza que deseja restaurar todos os valores originais? As alterações não salvas serão perdidas.')) {
                    this.formData = {
                        titulo: '<?= addslashes($sermao['titulo']) ?>',
                        pregador: '<?= addslashes($sermao['pregador']) ?>',
                        data: '<?= date('Y-m-d', strtotime($sermao['data'])) ?>',
                        conteudo: '<?= addslashes($sermao['conteudo']) ?>'
                    };

                    // Restaurar status original
                    document.getElementById('status').value = '<?= $sermao['status'] ?>';

                    // Restaurar mídias originais
                    const originalMidias = <?= json_encode($midiasSermao ?? []) ?>;
                    document.querySelectorAll('input[name="midias[]"]').forEach(checkbox => {
                        checkbox.checked = originalMidias.includes(checkbox.value);
                    });
                }
            },

            init() {
                // Inicializar contadores
                this.formData.titulo = '<?= addslashes($sermao['titulo']) ?>';
                this.formData.conteudo = '<?= addslashes($sermao['conteudo']) ?>';
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>