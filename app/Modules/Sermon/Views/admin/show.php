<?php
ob_start();
?>

<div class="min-h-screen bg-gray-50/30 py-6">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Card Principal -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 border border-gray-200 relative overflow-hidden">

            <!-- Elementos Decorativos -->
            <div
                class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full -mr-24 -mt-24">
            </div>
            <div
                class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-blue-50 to-cyan-50 rounded-full -ml-16 -mb-16">
            </div>

            <!-- Cabeçalho -->
            <div class="flex flex-col lg:flex-row items-start gap-6 relative z-10 mb-8">
                <!-- Avatar do Sermão -->
                <div
                    class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg flex-shrink-0">
                    <?= strtoupper(substr($sermao['titulo'], 0, 1)) ?>
                </div>

                <div class="flex-1 min-w-0">
                    <!-- Status e Informações -->
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span :class="getStatusClasses('<?= $sermao['status'] ?>')"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold capitalize">
                            <?php if ($sermao['status'] === 'publicado'): ?>
                                🌐 Publicado
                            <?php elseif ($sermao['status'] === 'rascunho'): ?>
                                📝 Rascunho
                            <?php else: ?>
                                📁 Arquivado
                            <?php endif; ?>
                        </span>

                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                            ID: <?= $sermao['id'] ?>
                        </span>
                    </div>

                    <!-- Título -->
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight mb-4">
                        <?= htmlspecialchars($sermao['titulo']) ?>
                    </h1>

                    <!-- Metadados -->
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                        <?php if ($sermao['pregador']): ?>
                            <div class="flex items-center gap-2 bg-blue-50 px-3 py-1.5 rounded-lg">
                                <span class="text-blue-600">👤</span>
                                <span class="font-medium text-blue-700"><?= htmlspecialchars($sermao['pregador']) ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="flex items-center gap-2 bg-green-50 px-3 py-1.5 rounded-lg">
                            <span class="text-green-600">📅</span>
                            <span class="font-medium text-green-700">
                                <?= date('d/m/Y', strtotime($sermao['data'])) ?>
                            </span>
                        </div>

                        <div class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-lg">
                            <span class="text-gray-600">🕒</span>
                            <span>Criado em: <?= date('d/m/Y H:i', strtotime($sermao['criado_em'] ?? 'now')) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conteúdo -->
            <div class="relative z-10 mb-8">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50/30 rounded-2xl p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-3">
                        <span
                            class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-sm">
                            📖
                        </span>
                        Conteúdo do Sermão
                    </h3>

                    <?php if ($sermao['conteudo']): ?>
                        <div
                            class="prose prose-lg max-w-none text-gray-700 leading-relaxed bg-white rounded-xl p-6 border border-gray-200">
                            <?= nl2br(htmlspecialchars($sermao['conteudo'])) ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12 bg-white rounded-xl border-2 border-dashed border-gray-200">
                            <div class="text-6xl mb-4 text-gray-300">📝</div>
                            <p class="text-gray-500 text-lg mb-2">Nenhum conteúdo cadastrado</p>
                            <p class="text-gray-400 text-sm">Este sermão não possui conteúdo escrito</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Mídias -->
            <?php if (!empty($sermao['midias'])): ?>
                <div x-data="mediaGallery(<?= htmlspecialchars(json_encode($sermao['midias'])) ?>)" x-cloak
                    class="relative z-10">

                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-3">
                            <span
                                class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center text-white text-sm">
                                🎵
                            </span>
                            Mídias do Sermão
                        </h3>
                        <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full">
                            <?= count($sermao['midias']) ?> arquivo(s)
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <?php foreach ($sermao['midias'] as $i => $m): ?>
                            <div class="group relative bg-white rounded-xl border border-gray-200 p-4 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
                                @click="openGallery(<?= $i ?>)" role="button" tabindex="0"
                                @keydown.enter="openGallery(<?= $i ?>)"
                                aria-label="Visualizar <?= htmlspecialchars($m['nome_arquivo']) ?>">

                                <!-- Overlay hover -->
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-5 rounded-xl transition-all duration-300">
                                </div>

                                <!-- Ícone de tipo de arquivo -->
                                <div class="absolute top-3 right-3 bg-white bg-opacity-90 rounded-lg p-1.5 shadow-sm">
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

                                <!-- Informações do arquivo -->
                                <div class="text-center">
                                    <p
                                        class="text-sm font-medium text-gray-800 truncate group-hover:text-purple-600 transition-colors">
                                        <?= htmlspecialchars($m['nome_arquivo']) ?>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= strtoupper($m['tipo_arquivo']) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Modal Gallery -->
                    <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4"
                        style="display: none;" @keydown.escape="closeGallery" role="dialog"
                        aria-label="Visualizador de mídia" aria-modal="true">

                        <div class="relative max-w-6xl w-full max-h-[90vh] flex items-center justify-center">
                            <!-- Botão fechar -->
                            <button @click="closeGallery"
                                class="absolute top-4 right-4 bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-gray-100 transition-colors z-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black"
                                aria-label="Fechar visualizador">
                                ✕
                            </button>

                            <!-- Navegação -->
                            <button @click="previous" :disabled="midias.length <= 1"
                                class="absolute left-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full w-10 h-10 flex items-center justify-center backdrop-blur-sm transition-all disabled:opacity-30 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-white z-50"
                                :class="{ 'hidden': midias.length <= 1 }" aria-label="Mídia anterior">
                                ❮
                            </button>

                            <button @click="next" :disabled="midias.length <= 1"
                                class="absolute right-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full w-10 h-10 flex items-center justify-center backdrop-blur-sm transition-all disabled:opacity-30 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-white z-50"
                                :class="{ 'hidden': midias.length <= 1 }" aria-label="Próxima mídia">
                                ❯
                            </button>

                            <!-- Conteúdo da mídia -->
                            <div class="bg-white rounded-2xl overflow-hidden shadow-2xl w-full max-w-4xl">
                                <div class="p-4 bg-gray-900 text-white text-center">
                                    <p x-text="currentMedia.nome_arquivo" class="font-medium truncate"></p>
                                    <p x-text="`${currentIndex + 1} de ${midias.length}`" class="text-sm text-gray-300"></p>
                                </div>

                                <div class="flex items-center justify-center min-h-[400px] max-h-[70vh] bg-black p-4">
                                    <template x-if="currentMedia.tipo_arquivo === 'imagem'">
                                        <img :src="'/' + currentMedia.caminho_arquivo" :alt="currentMedia.nome_arquivo"
                                            class="max-w-full max-h-full object-contain">
                                    </template>

                                    <template x-if="currentMedia.tipo_arquivo === 'video'">
                                        <video controls autoplay class="max-w-full max-h-full"
                                            :poster="currentMedia.thumbnail ? '/' + currentMedia.thumbnail : ''">
                                            <source :src="'/' + currentMedia.caminho_arquivo"
                                                :type="currentMedia.tipo_mime">
                                            Seu navegador não suporta o elemento de vídeo.
                                        </video>
                                    </template>

                                    <template x-if="currentMedia.tipo_arquivo === 'audio'">
                                        <div class="text-center p-8 w-full">
                                            <div class="text-6xl mb-6 text-white">🎵</div>
                                            <audio controls autoplay class="w-full max-w-md" x-ref="audioPlayer">
                                                <source :src="'/' + currentMedia.caminho_arquivo"
                                                    :type="currentMedia.tipo_mime">
                                                Seu navegador não suporta o elemento de áudio.
                                            </audio>
                                            <p class="text-white text-sm mt-4" x-text="currentMedia.nome_arquivo"></p>
                                        </div>
                                    </template>

                                    <template x-if="!['imagem','video','audio'].includes(currentMedia.tipo_arquivo)">
                                        <div class="text-center p-8 text-white">
                                            <div class="text-6xl mb-4">📄</div>
                                            <p class="text-xl mb-4">Visualização não disponível</p>
                                            <a :href="'/' + currentMedia.caminho_arquivo"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg inline-flex items-center gap-2 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-black">
                                                📥 Baixar Arquivo
                                            </a>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-12 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                    <div class="text-6xl mb-4 text-gray-300">🎵</div>
                    <p class="text-gray-500 text-lg mb-2">Nenhuma mídia associada</p>
                    <p class="text-gray-400 text-sm">Este sermão não possui mídias anexadas</p>
                </div>
            <?php endif; ?>

            <!-- Informações do Sistema -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 mt-8">
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
            <div
                class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t border-gray-200 mt-8 relative z-10">
                <div class="flex flex-wrap gap-3">
                    <a href="/admin/sermoes"
                        class="inline-flex items-center gap-2 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        <span>←</span>
                        Voltar à Lista
                    </a>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="/admin/sermao/<?= $sermao['id'] ?>/editar"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 font-semibold focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                        <span class="text-lg">✏️</span>
                        Editar Sermão
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mediaGallery(midias) {
        return {
            midias,
            currentIndex: 0,
            isOpen: false,

            get currentMedia() {
                return this.midias[this.currentIndex];
            },

            openGallery(index) {
                this.currentIndex = index;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';

                // Auto-play audio when modal opens
                if (this.currentMedia.tipo_arquivo === 'audio') {
                    this.$nextTick(() => {
                        if (this.$refs.audioPlayer) {
                            this.$refs.audioPlayer.play().catch(e => {
                                console.log('Auto-play prevented:', e);
                            });
                        }
                    });
                }
            },

            closeGallery() {
                this.isOpen = false;
                document.body.style.overflow = '';

                // Pause audio when modal closes
                if (this.$refs.audioPlayer) {
                    this.$refs.audioPlayer.pause();
                }
            },

            next() {
                if (this.midias.length > 1) {
                    this.currentIndex = (this.currentIndex + 1) % this.midias.length;
                    this.handleMediaChange();
                }
            },

            previous() {
                if (this.midias.length > 1) {
                    this.currentIndex = (this.currentIndex - 1 + this.midias.length) % this.midias.length;
                    this.handleMediaChange();
                }
            },

            handleMediaChange() {
                // Handle audio play when changing media
                if (this.currentMedia.tipo_arquivo === 'audio') {
                    this.$nextTick(() => {
                        if (this.$refs.audioPlayer) {
                            this.$refs.audioPlayer.play().catch(e => {
                                console.log('Auto-play prevented:', e);
                            });
                        }
                    });
                }
            },

            init() {
                // Navegação por teclado
                window.addEventListener('keydown', (e) => {
                    if (!this.isOpen) return;

                    switch (e.key) {
                        case 'Escape':
                            this.closeGallery();
                            break;
                        case 'ArrowRight':
                            this.next();
                            break;
                        case 'ArrowLeft':
                            this.previous();
                            break;
                    }
                });
            }
        }
    }

    // Funções auxiliares para classes CSS
    function getStatusClasses(status) {
        const classes = {
            'publicado': 'bg-green-100 text-green-800 border border-green-200',
            'rascunho': 'bg-yellow-100 text-yellow-800 border border-yellow-200',
            'arquivado': 'bg-gray-100 text-gray-800 border border-gray-200'
        };
        return classes[status] || 'bg-gray-100 text-gray-800 border border-gray-200';
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>