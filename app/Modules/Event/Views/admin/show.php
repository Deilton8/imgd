<?php
ob_start();
?>

<div class="max-w-4xl mx-auto mt-6 mb-10 px-4 sm:px-6">
    <!-- Card principal -->
    <div
        class="bg-white shadow-2xl rounded-2xl p-6 sm:p-8 border border-gray-200 relative overflow-hidden transition-all duration-300 hover:shadow-xl">

        <!-- Elementos decorativos -->
        <div
            class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-full -mr-20 -mt-20">
        </div>
        <div
            class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-amber-50 to-yellow-100 rounded-full -ml-16 -mb-16">
        </div>

        <!-- Cabeçalho do evento -->
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 relative z-10 mb-8">
            <div class="flex-1 text-center sm:text-left">
                <div class="inline-flex items-center gap-2 mb-2">
                    <span
                        class="text-sm font-medium px-3 py-1 rounded-full 
                        <?= $evento['status'] === 'concluido' ? 'bg-green-100 text-green-800 border border-green-200' :
                            ($evento['status'] === 'em_andamento' ? 'bg-blue-100 text-blue-800 border border-blue-200' :
                                ($evento['status'] === 'pendente' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : 'bg-red-100 text-red-800 border border-red-200')) ?>">
                        <?= ucfirst(str_replace('_', ' ', $evento['status'])) ?>
                    </span>
                    <span class="text-sm text-gray-500">ID: <?= $evento['id'] ?></span>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-3">
                    <?= htmlspecialchars($evento['titulo']) ?>
                </h1>

                <?php if (!empty($evento['descricao'])): ?>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        <?= htmlspecialchars($evento['descricao']) ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Grid de informações -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 relative z-10">
            <!-- Informações principais -->
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        Informações do Evento
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <span
                                class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                📍
                            </span>
                            <div>
                                <p class="font-medium text-gray-700">Local</p>
                                <p class="text-gray-900"><?= htmlspecialchars($evento['local']) ?></p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span
                                class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                🗓️
                            </span>
                            <div>
                                <p class="font-medium text-gray-700">Data e Horário</p>
                                <p class="text-gray-900">
                                    <?= date('d/m/Y', strtotime($evento['data_inicio'])) ?>
                                    até
                                    <?= date('d/m/Y', strtotime($evento['data_fim'])) ?>
                                </p>
                            </div>
                        </div>

                        <?php if (!empty($evento['categoria'])): ?>
                            <div class="flex items-start gap-3">
                                <span
                                    class="w-6 h-6 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    🏷️
                                </span>
                                <div>
                                    <p class="font-medium text-gray-700">Categoria</p>
                                    <p class="text-gray-900"><?= htmlspecialchars($evento['categoria']) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Informações adicionais -->
            <div class="space-y-6">
                <?php if (!empty($evento['observacoes'])): ?>
                    <div class="bg-amber-50 rounded-xl p-6 border border-amber-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                            Observações
                        </h3>
                        <p class="text-gray-700 leading-relaxed"><?= nl2br(htmlspecialchars($evento['observacoes'])) ?></p>
                    </div>
                <?php endif; ?>

                <!-- Estatísticas rápidas -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Detalhes</h3>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <p class="text-2xl font-bold text-blue-600"><?= count($evento['midias'] ?? []) ?></p>
                            <p class="text-sm text-gray-600">Mídias</p>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg">
                            <p class="text-2xl font-bold text-green-600">
                                <?= floor((strtotime($evento['data_fim']) - time()) / (60 * 60 * 24)) ?>
                            </p>
                            <p class="text-sm text-gray-600">Dias restantes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mídias relacionadas -->
        <?php if (!empty($evento['midias'])): ?>
            <div x-data="mediaGallery(<?= htmlspecialchars(json_encode($evento['midias'])) ?>)" x-cloak
                class="mt-10 relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Mídias do Evento</h3>
                    <span class="text-sm text-gray-500"><?= count($evento['midias']) ?> arquivo(s)</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    <?php foreach ($evento['midias'] as $i => $m): ?>
                        <div class="group relative bg-white rounded-xl border border-gray-200 p-3 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
                            @click="openGallery(<?= $i ?>)" role="button" tabindex="0" @keydown.enter="openGallery(<?= $i ?>)"
                            aria-label="Visualizar <?= htmlspecialchars($m['nome_arquivo']) ?>">

                            <!-- Overlay hover -->
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-xl transition-all duration-300">
                            </div>

                            <!-- Ícone de tipo de arquivo -->
                            <div class="absolute top-2 right-2 bg-white bg-opacity-90 rounded-full p-1.5 shadow-sm">
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
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-purple-100">
                                        <video src="/<?= $m['caminho_arquivo'] ?>"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                            autoplay muted></video>
                                    </div>
                                <?php elseif ($m['tipo_arquivo'] === 'audio'): ?>
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-100 to-emerald-100">
                                        <span class="text-4xl">🎵</span>
                                    </div>
                                <?php else: ?>
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                        <span class="text-4xl">📄</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Nome do arquivo -->
                            <p
                                class="text-sm font-medium text-gray-800 truncate text-center group-hover:text-blue-600 transition-colors">
                                <?= htmlspecialchars($m['nome_arquivo']) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Modal Gallery -->
                <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4"
                    style="display: none;" @keydown.escape="closeGallery" role="dialog" aria-label="Visualizador de mídia"
                    aria-modal="true">

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
                            <div class="p-4 bg-gray-900 text-white text-center mb-4">
                                <p x-text="currentMedia.nome_arquivo" class="font-medium truncate"></p>
                                <p x-text="`${currentIndex + 1} de ${midias.length}`" class="text-sm text-gray-300"></p>
                            </div>

                            <div class="flex items-center justify-center min-h-[400px] max-h-[70vh] bg-black p-4">
                                <template x-if="currentMedia.tipo_arquivo === 'imagem'">
                                    <img :src="'/' + currentMedia.caminho_arquivo" :alt="currentMedia.nome_arquivo"
                                        class="max-w-full max-h-full object-contain">
                                </template>

                                <template x-if="currentMedia.tipo_arquivo === 'video'">
                                    <video controls autoplay muted class="max-w-full max-h-full"
                                        :poster="currentMedia.thumbnail ? '/' + currentMedia.thumbnail : ''">
                                        <source :src="'/' + currentMedia.caminho_arquivo" :type="currentMedia.tipo_mime">
                                        Seu navegador não suporta o elemento de vídeo.
                                    </video>
                                </template>

                                <template x-if="currentMedia.tipo_arquivo === 'audio'">
                                    <div class="text-center p-8">
                                        <div class="text-6xl mb-4">🎵</div>
                                        <audio controls autoplay class="w-full max-w-md">
                                            <source :src="'/' + currentMedia.caminho_arquivo"
                                                :type="currentMedia.tipo_mime">
                                            Seu navegador não suporta o elemento de áudio.
                                        </audio>
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
        <?php endif; ?>

        <!-- Ações -->
        <div class="mt-10 pt-8 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex flex-wrap gap-3">
                <a href="/admin/evento/<?= $evento['id'] ?>/editar"
                    class="bg-gradient-to-r from-yellow-500 to-amber-500 hover:from-yellow-600 hover:to-amber-600 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-2 font-semibold focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    <span>✏️</span>
                    Editar Evento
                </a>

                <button onclick="window.history.back()"
                    class="border border-gray-300 hover:border-gray-400 text-gray-700 hover:text-gray-900 px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-lg flex items-center gap-2 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    <span>←</span>
                    Voltar
                </button>
            </div>

            <div class="text-sm text-gray-500 flex items-center gap-4">
                <span>Criado em: <?= date('d/m/Y H:i', strtotime($evento['created_at'] ?? 'now')) ?></span>
                <?php if (!empty($evento['updated_at'])): ?>
                    <span>Atualizado em: <?= date('d/m/Y H:i', strtotime($evento['updated_at'])) ?></span>
                <?php endif; ?>
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
            },

            closeGallery() {
                this.isOpen = false;
                document.body.style.overflow = '';
            },

            next() {
                if (this.midias.length > 1) {
                    this.currentIndex = (this.currentIndex + 1) % this.midias.length;
                }
            },

            previous() {
                if (this.midias.length > 1) {
                    this.currentIndex = (this.currentIndex - 1 + this.midias.length) % this.midias.length;
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

                // Fechar ao clicar no backdrop
                this.$watch('isOpen', (value) => {
                    if (value) {
                        this.$nextTick(() => {
                            this.$refs.modal?.addEventListener('click', (e) => {
                                if (e.target === this.$refs.modal) {
                                    this.closeGallery();
                                }
                            });
                        });
                    }
                });
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>