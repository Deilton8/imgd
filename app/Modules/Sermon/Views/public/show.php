<?php
ob_start();

$icones = [
    'imagem' => 'fas fa-image',
    'video' => 'fas fa-video',
    'audio' => 'fas fa-music',
    'pdf' => 'fas fa-file-pdf',
    'outros' => 'fas fa-file'
];

$cores = [
    'imagem' => 'from-yellow-500 to-yellow-600',
    'video' => 'from-blue-500 to-blue-600',
    'audio' => 'from-green-500 to-green-600',
    'pdf' => 'from-red-500 to-red-600',
    'outros' => 'from-gray-500 to-gray-600'
];

$nomes = [
    'imagem' => 'Fotos',
    'video' => 'Vídeos',
    'audio' => 'Áudios',
    'pdf' => 'Documentos',
    'outros' => 'Outros Arquivos'
];
?>

<!-- Breadcrumb -->
<nav class="bg-gray-50 py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li>
                <a href="/" class="hover:text-yellow-600 transition-colors duration-200 flex items-center">
                    <i class="fas fa-home mr-2 text-yellow-500"></i>
                    Início
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <a href="/sermoes" class="hover:text-yellow-600 transition-colors duration-200">Mensagens</a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <span class="text-gray-900 font-medium"><?= htmlspecialchars($sermao['titulo']) ?></span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Sermon Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    <?= htmlspecialchars($sermao['titulo']) ?>
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 mx-auto mb-8 rounded-full"></div>
            </div>

            <!-- Sermon Details -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 shadow-lg border border-gray-100 mb-12">
                <!-- Sermon Info Cards -->
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <?php if (!empty($sermao['data'])): ?>
                        <div
                            class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="far fa-calendar text-yellow-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-2">Data do Sermão</h3>
                                    <p class="text-gray-700 font-medium text-lg">
                                        <?= date("d \\d\\e F \\d\\e Y", strtotime($sermao['data'])) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($sermao['pregador'])): ?>
                        <div
                            class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-yellow-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-2">Pregador</h3>
                                    <p class="text-gray-700 font-medium text-lg">
                                        <?= htmlspecialchars($sermao['pregador']) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sermon Content -->
                <div class="prose prose-lg max-w-none">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-align-left text-yellow-500 mr-3"></i>
                        Mensagem
                    </h3>
                    <div
                        class="text-gray-700 leading-relaxed text-lg space-y-6 bg-white p-6 rounded-xl border border-gray-200">
                        <?= nl2br(htmlspecialchars($sermao['conteudo'])) ?>
                    </div>
                </div>
            </div>

            <!-- Media Gallery -->
            <?php if (!empty($sermao['midias'])): ?>
                <?php
                // Separar mídias por tipo
                $midiasPorTipo = [
                    'imagem' => [],
                    'video' => [],
                    'audio' => [],
                    'pdf' => [],
                    'outros' => []
                ];

                foreach ($sermao['midias'] as $m) {
                    $tipo = $m['tipo_arquivo'];
                    if (isset($midiasPorTipo[$tipo])) {
                        $midiasPorTipo[$tipo][] = $m;
                    } else {
                        $midiasPorTipo['outros'][] = $m;
                    }
                }

                // Remover categorias vazias
                $midiasPorTipo = array_filter($midiasPorTipo);
                ?>

                <div x-data="mediaPreview(<?= htmlspecialchars(json_encode($sermao['midias'])) ?>)" x-init="init()" x-cloak>
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4 flex items-center justify-center">
                            <i class="fas fa-images text-yellow-500 mr-3"></i>
                            Galeria do Sermão
                        </h2>
                        <p class="text-gray-600 text-lg">Explore os materiais relacionados a este sermão</p>
                        <div class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 mx-auto mt-4 rounded-full">
                        </div>
                    </div>

                    <!-- Filtros por Tipo -->
                    <div class="flex flex-wrap justify-center gap-4 mb-8">
                        <?php foreach ($midiasPorTipo as $tipo => $midias): ?>
                            <?php
                            $icones = [
                                'imagem' => 'fas fa-image',
                                'video' => 'fas fa-video',
                                'audio' => 'fas fa-music',
                                'pdf' => 'fas fa-file-pdf',
                                'outros' => 'fas fa-file'
                            ];

                            $cores = [
                                'imagem' => 'from-yellow-500 to-yellow-600',
                                'video' => 'from-yellow-500 to-yellow-600',
                                'audio' => 'from-yellow-500 to-yellow-600',
                                'pdf' => 'from-yellow-500 to-yellow-600',
                                'outros' => 'from-yellow-500 to-yellow-600'
                            ];

                            $nomes = [
                                'imagem' => 'Fotos',
                                'video' => 'Vídeos',
                                'audio' => 'Áudios',
                                'pdf' => 'Documentos',
                                'outros' => 'Outros Arquivos'
                            ];
                            ?>

                            <button @click="scrollToSection('<?= $tipo ?>')"
                                class="flex items-center space-x-3 bg-white hover:bg-gray-50 border-2 border-gray-200 hover:border-yellow-300 px-6 py-3 rounded-xl font-semibold text-gray-700 hover:text-yellow-700 transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-lg group">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br <?= $cores[$tipo] ?> rounded-lg flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                    <i class="<?= $icones[$tipo] ?> text-white text-sm"></i>
                                </div>
                                <div class="text-left">
                                    <div class="font-bold text-lg"><?= $nomes[$tipo] ?></div>
                                    <div class="text-sm text-gray-500"><?= count($midias) ?> arquivo(s)</div>
                                </div>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Galeria por Tipo -->
                    <div class="space-y-12">
                        <?php foreach ($midiasPorTipo as $tipo => $midias): ?>
                            <section id="section-<?= $tipo ?>" class="scroll-mt-8">
                                <!-- Cabeçalho da Seção -->
                                <div class="flex items-center justify-between mb-8">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                                            <i class="<?= $icones[$tipo] ?> text-white text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-900"><?= $nomes[$tipo] ?></h3>
                                            <p class="text-gray-600"><?= count($midias) ?> arquivo(s) disponível(is)</p>
                                        </div>
                                    </div>
                                    <div class="w-16 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-full"></div>
                                </div>

                                <!-- Grid de Mídias -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    <?php foreach ($midias as $m): ?>
                                        <?php
                                        $index = array_search($m, $sermao['midias']);
                                        $thumbnail = $m['caminho_arquivo'];
                                        ?>

                                        <div class="group relative cursor-pointer transform hover:-translate-y-2 transition-all duration-300"
                                            @click="open(<?= $index ?>)">
                                            <div class="relative overflow-hidden rounded-2xl shadow-lg border border-gray-200">
                                                <!-- Thumbnail -->
                                                <div class="relative h-full w-full overflow-hidden">
                                                    <?php if ($tipo === 'imagem'): ?>
                                                        <img src="/<?= $thumbnail ?>"
                                                            alt="<?= htmlspecialchars($m['descricao'] ?? 'Arquivo do sermão ' . $sermao['titulo']) ?>"
                                                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">

                                                    <?php elseif ($tipo === 'video'): ?>
                                                        <video
                                                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500"
                                                            muted autoplay loop>
                                                            <source src="/<?= $thumbnail ?>" type="<?= $m['tipo_mime'] ?>">
                                                        </video>
                                                    <?php else: ?>
                                                        <div
                                                            class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
                                                            <div class="text-center text-white">
                                                                <i class="<?= $icones[$tipo] ?> text-3xl mb-2"></i>
                                                                <p class="text-sm font-medium"><?= strtoupper($m['tipo_arquivo']) ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <!-- Overlay de Hover -->
                                                    <div
                                                        class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
                                                        <div
                                                            class="transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                                            <i class="fas fa-expand text-white text-2xl"></i>
                                                        </div>
                                                    </div>

                                                    <!-- Badge de Tipo -->
                                                    <div
                                                        class="absolute top-3 right-3 bg-black/70 text-white px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm capitalize">
                                                        <?= $m['tipo_arquivo'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Separador entre seções -->
                                <?php if ($tipo !== array_key_last($midiasPorTipo)): ?>
                                    <div class="mt-12 border-t border-gray-200"></div>
                                <?php endif; ?>
                            </section>
                        <?php endforeach; ?>
                    </div>

                    <!-- Enhanced Modal -->
                    <div x-show="openPreview" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="fixed inset-0 flex items-center justify-center bg-black/90 backdrop-blur-sm z-50 p-4"
                        style="display: none;">

                        <div class="relative max-w-6xl w-full max-h-[90vh] flex flex-col">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-4 text-white">
                                <div class="text-sm font-medium">
                                    <span x-text="currentIndex + 1"></span> de <span x-text="midias.length"></span>
                                    - <span x-text="current().tipo_arquivo" class="capitalize"></span>
                                </div>
                                <button @click="close()"
                                    class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 backdrop-blur-sm">
                                    <i class="fas fa-times text-white"></i>
                                </button>
                            </div>

                            <!-- Main Content -->
                            <div class="flex-1 flex items-center justify-center relative">
                                <!-- Navigation Buttons -->
                                <button @click="prev()"
                                    class="absolute left-4 w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white text-xl transition-all duration-300 transform hover:scale-110 backdrop-blur-sm z-10">
                                    <i class="fas fa-chevron-left"></i>
                                </button>

                                <button @click="next()"
                                    class="absolute right-4 w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white text-xl transition-all duration-300 transform hover:scale-110 backdrop-blur-sm z-10">
                                    <i class="fas fa-chevron-right"></i>
                                </button>

                                <!-- Media Display -->
                                <div class="w-full h-150 flex items-center justify-center">
                                    <template x-if="current().tipo_arquivo === 'imagem'">
                                        <img :src="'/' + current().caminho_arquivo"
                                            class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                                            :alt="current().descricao || 'Imagem do sermão'">
                                    </template>

                                    <template x-if="current().tipo_arquivo === 'video'">
                                        <video controls autoplay muted class="max-w-full max-h-full rounded-lg shadow-2xl">
                                            <source :src="'/' + current().caminho_arquivo" :type="current().tipo_mime">
                                        </video>
                                    </template>

                                    <template x-if="current().tipo_arquivo === 'audio'">
                                        <div class="bg-white rounded-2xl p-8 shadow-2xl max-w-md w-full">
                                            <div class="text-center mb-6">
                                                <i class="fas fa-music text-yellow-600 text-4xl mb-4"></i>
                                                <h3 class="text-xl font-bold text-gray-900"
                                                    x-text="current().descricao || 'Áudio do Sermão'"></h3>
                                            </div>
                                            <audio controls class="w-full">
                                                <source :src="'/' + current().caminho_arquivo" :type="current().tipo_mime">
                                            </audio>
                                        </div>
                                    </template>

                                    <template x-if="current().tipo_arquivo === 'pdf'">
                                        <div class="bg-white w-full h-full rounded-lg shadow-2xl">
                                            <iframe :src="'/' + current().caminho_arquivo"
                                                class="w-full h-full rounded-lg"></iframe>
                                        </div>
                                    </template>

                                    <template x-if="!['imagem','video','audio','pdf'].includes(current().tipo_arquivo)">
                                        <div class="bg-white rounded-2xl p-8 text-center max-w-md">
                                            <i class="fas fa-file-download text-yellow-600 text-4xl mb-4"></i>
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">Visualização não disponível
                                            </h3>
                                            <p class="text-gray-600 mb-4">Este tipo de arquivo não pode ser visualizado no
                                                navegador.</p>
                                            <a :href="'/' + current().caminho_arquivo" download
                                                class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                                                <i class="fas fa-download mr-2"></i>
                                                Baixar Arquivo
                                            </a>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function mediaPreview(midias) {
                        return {
                            midias,
                            currentIndex: 0,
                            openPreview: false,
                            open(i) {
                                this.currentIndex = i;
                                this.openPreview = true;
                                document.body.style.overflow = 'hidden';
                            },
                            close() {
                                this.openPreview = false;
                                document.body.style.overflow = 'auto';
                            },
                            next() {
                                this.currentIndex = (this.currentIndex + 1) % this.midias.length;
                            },
                            prev() {
                                this.currentIndex = (this.currentIndex - 1 + this.midias.length) % this.midias.length;
                            },
                            current() {
                                return this.midias[this.currentIndex];
                            },
                            init() {
                                // Navegação via teclado
                                window.addEventListener('keydown', (e) => {
                                    if (!this.openPreview) return;
                                    if (e.key === "Escape") this.close();
                                    if (e.key === "ArrowRight") this.next();
                                    if (e.key === "ArrowLeft") this.prev();
                                });

                                // Close on backdrop click
                                document.addEventListener('click', (e) => {
                                    if (this.openPreview && e.target.classList.contains('bg-black/90')) {
                                        this.close();
                                    }
                                });
                            },
                            scrollToSection(tipo) {
                                const section = document.getElementById('section-' + tipo);
                                if (section) {
                                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                                }
                            }
                        }
                    }
                </script>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    .prose {
        line-height: 1.75;
    }

    .prose p {
        margin-bottom: 1.5em;
    }

    /* Smooth animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .grid>div {
        animation: fadeIn 0.6s ease-out;
    }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout_public.php";
?>