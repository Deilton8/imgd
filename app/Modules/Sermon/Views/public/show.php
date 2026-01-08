<?php
ob_start();

$icones = [
    'imagem' => 'fas fa-images',
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

<!-- Enhanced Page Header -->
<section
    class="relative bg-gradient-to-br from-yellow-900 via-yellow-800 to-yellow-700 py-24 text-white overflow-hidden"
    role="banner">
    <!-- Background pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\" 60\"
            height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\"
            fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36
            34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6
            4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-6xl mx-auto">
            <!-- Sermon title and meta -->
            <div class="space-y-8">
                <div class="inline-flex items-center space-x-3 bg-white/10 backdrop-blur-sm px-5 py-2.5 rounded-full">
                    <i class="fas fa-bible text-yellow-300 text-lg"></i>
                    <span class="text-sm font-semibold">Mensagem Inspiradora</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-bold leading-tight tracking-tight">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-yellow-100">
                        <?= htmlspecialchars($sermao['titulo']) ?>
                    </span>
                </h1>

                <!-- Quick info row -->
                <div class="flex flex-wrap gap-6 items-center">
                    <?php if (!empty($sermao['data'])): ?>
                        <div class="flex items-center text-yellow-100">
                            <div
                                class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3">
                                <i class="far fa-calendar-alt text-yellow-300"></i>
                            </div>
                            <div>
                                <div class="font-semibold">Data</div>
                                <div class="text-lg font-bold"><?= date("d/m/Y", strtotime($sermao['data'])) ?></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($sermao['pregador'])): ?>
                        <div class="flex items-center text-yellow-100">
                            <div
                                class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-user-tie text-yellow-300"></i>
                            </div>
                            <div>
                                <div class="font-semibold">Pregador</div>
                                <div class="text-lg font-bold"><?= htmlspecialchars($sermao['pregador']) ?></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Audio indicator -->
                    <?php
                    $hasAudio = false;
                    if (!empty($sermao['midias'])) {
                        foreach ($sermao['midias'] as $midia) {
                            if ($midia['tipo_arquivo'] === 'audio') {
                                $hasAudio = true;
                                break;
                            }
                        }
                    }
                    ?>
                    <?php if ($hasAudio): ?>
                        <div class="ml-auto">
                            <span
                                class="inline-flex items-center px-5 py-2.5 rounded-full text-sm font-bold text-white bg-gradient-to-r from-green-500 to-green-600 shadow-lg">
                                <i class="fas fa-headphones mr-2"></i>
                                VERSÃO EM ÁUDIO DISPONÍVEL
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative bottom gradient -->
    <div class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Enhanced Breadcrumb -->
<nav class="bg-white/95 backdrop-blur-sm py-4 border-b border-yellow-100 shadow-sm sticky top-0 z-40"
    aria-label="Navegação">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-3 text-sm">
            <li>
                <a href="/"
                    class="flex items-center text-gray-600 hover:text-yellow-600 transition-all duration-300 group"
                    aria-label="Ir para início">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-2 group-hover:scale-110 transition-transform">
                        <i class="fas fa-home text-yellow-500 text-sm"></i>
                    </div>
                    <span class="font-medium">Início</span>
                </a>
            </li>
            <li class="flex items-center text-gray-400">
                <i class="fas fa-chevron-right text-xs mx-2"></i>
            </li>
            <li>
                <a href="/sermoes"
                    class="flex items-center text-gray-600 hover:text-yellow-600 transition-all duration-300 group"
                    aria-label="Ir para mensagens">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-2 group-hover:scale-110 transition-transform">
                        <i class="fas fa-bible text-yellow-500 text-sm"></i>
                    </div>
                    <span class="font-medium">Mensagens</span>
                </a>
            </li>
            <li class="flex items-center text-gray-400">
                <i class="fas fa-chevron-right text-xs mx-2"></i>
            </li>
            <li class="flex items-center">
                <span class="text-gray-900 font-semibold truncate max-w-xs md:max-w-md flex items-center">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                    <?= htmlspecialchars($sermao['titulo']) ?>
                </span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<main class="py-16 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Sermon Content Grid -->
            <div class="grid lg:grid-cols-1 gap-8">
                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About Sermon Card -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 border-b border-yellow-200 px-8 py-6">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-align-left text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">Mensagem Completa</h2>
                                    <p class="text-gray-600">Palavra que edifica e transforma</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-8">
                            <div class="prose prose-lg max-w-none">
                                <div class="text-gray-700 leading-relaxed space-y-6 text-lg">
                                    <?= nl2br(htmlspecialchars($sermao['conteudo'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Cards -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Date Card -->
                        <?php if (!empty($sermao['data'])): ?>
                            <div
                                class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start space-x-4 mb-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class="far fa-calendar-alt text-yellow-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">Data do Sermão</h3>
                                        <p class="text-gray-500 text-sm">Quando foi pregado</p>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-700">
                                        <i class="fas fa-calendar-day text-yellow-500 mr-3"></i>
                                        <div>
                                            <div class="font-semibold">Data</div>
                                            <div class="text-lg font-bold text-gray-900">
                                                <?= date("d \\d\\e F \\d\\e Y", strtotime($sermao['data'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <i class="fas fa-clock text-yellow-500 mr-3"></i>
                                        <div>
                                            <div class="font-semibold">Dia da Semana</div>
                                            <div class="text-lg font-bold text-gray-900">
                                                <?= date("l", strtotime($sermao['data'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Preacher Card -->
                        <?php if (!empty($sermao['pregador'])): ?>
                            <div
                                class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start space-x-4 mb-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user-tie text-yellow-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">Pregador</h3>
                                        <p class="text-gray-500 text-sm">Quem compartilhou esta mensagem</p>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex items-start text-gray-700">
                                        <i class="fas fa-user text-yellow-500 mr-3 mt-1"></i>
                                        <div>
                                            <div class="font-semibold mb-1">Nome</div>
                                            <div class="text-lg font-bold text-gray-900">
                                                <?= htmlspecialchars($sermao['pregador']) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Other sermons by this preacher -->
                                    <?php if (isset($outrosSermoes) && !empty($outrosSermoes)): ?>
                                        <a href="/sermoes?pregador=<?= urlencode($sermao['pregador']) ?>"
                                            class="inline-flex items-center justify-center w-full mt-4 px-4 py-3 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 text-blue-700 rounded-xl font-semibold transition-all duration-300 transform hover:scale-[1.02] group/maplink">
                                            <i class="fas fa-list mr-3 group-hover/maplink:scale-110 transition-transform"></i>
                                            Ver outras mensagens deste pregador
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Media Gallery -->
            <?php if (!empty($sermao['midias'])): ?>
                <?php
                // Organizar mídias por tipo
                $midiasPorTipo = [
                    'audio' => ['nome' => 'Áudio', 'icone' => 'fas fa-music', 'cor' => 'from-green-500 to-green-600'],
                    'imagem' => ['nome' => 'Fotos', 'icone' => 'fas fa-images', 'cor' => 'from-yellow-500 to-yellow-600'],
                    'video' => ['nome' => 'Vídeos', 'icone' => 'fas fa-video', 'cor' => 'from-blue-500 to-blue-600'],
                    'pdf' => ['nome' => 'Documentos', 'icone' => 'fas fa-file-pdf', 'cor' => 'from-red-500 to-red-600'],
                ];

                $midiasAgrupadas = [];
                foreach ($sermao['midias'] as $m) {
                    $tipo = $m['tipo_arquivo'];
                    if (!isset($midiasAgrupadas[$tipo])) {
                        $midiasAgrupadas[$tipo] = [];
                    }
                    $midiasAgrupadas[$tipo][] = $m;
                }

                // Ordenar para mostrar áudio primeiro
                uksort($midiasAgrupadas, function ($a, $b) {
                    $order = ['audio' => 0, 'imagem' => 1, 'video' => 2, 'pdf' => 3, 'outros' => 4];
                    return ($order[$a] ?? 5) <=> ($order[$b] ?? 5);
                });
                ?>

                <div class="mt-16 pt-16 border-t border-gray-200">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center space-x-3 mb-6">
                            <div class="w-12 h-1 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full"></div>
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-images text-white text-2xl"></i>
                            </div>
                            <div class="w-12 h-1 bg-gradient-to-r from-yellow-500 to-yellow-400 rounded-full"></div>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Materiais do Sermão</h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Acesse os áudios, vídeos, fotos e materiais complementares desta mensagem
                        </p>
                    </div>

                    <!-- Category Filters -->
                    <div class="flex flex-wrap justify-center gap-3 mb-10">
                        <button
                            class="category-filter active px-5 py-2.5 rounded-xl bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 flex items-center"
                            data-category="all">
                            <i class="fas fa-layer-group mr-2"></i>
                            Tudo
                        </button>

                        <?php foreach ($midiasPorTipo as $tipo => $info): ?>
                            <?php if (!empty($midiasAgrupadas[$tipo])): ?>
                                <button
                                    class="category-filter px-5 py-2.5 rounded-xl bg-white border-2 border-yellow-200 text-yellow-700 font-semibold transition-all duration-300 hover:border-yellow-300 hover:bg-yellow-50 flex items-center"
                                    data-category="<?= $tipo ?>">
                                    <i class="<?= $info['icone'] ?> mr-2"></i>
                                    <?= $info['nome'] ?> (<?= count($midiasAgrupadas[$tipo]) ?>)
                                </button>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- Enhanced Media Gallery -->
                    <div x-data="enhancedMediaGallery(<?= htmlspecialchars(json_encode($sermao['midias'])) ?>)">
                        <!-- Media Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="media-grid">
                            <?php foreach ($sermao['midias'] as $index => $m): ?>
                                <div class="media-item category-<?= $m['tipo_arquivo'] ?> group" data-index="<?= $index ?>">
                                    <div class="relative overflow-hidden rounded-2xl shadow-lg border border-gray-200 hover:border-yellow-300 transition-all duration-300 transform hover:-translate-y-2 cursor-pointer h-64"
                                        @click="openPreview(<?= $index ?>)">

                                        <!-- Media Preview -->
                                        <div class="absolute inset-0 bg-gray-100 flex items-center justify-center">
                                            <?php if ($m['tipo_arquivo'] === 'imagem'): ?>
                                                <img src="/<?= $m['caminho_arquivo'] ?>"
                                                    alt="<?= htmlspecialchars($m['descricao'] ?? $sermao['titulo']) ?>"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                    loading="lazy">
                                            <?php elseif ($m['tipo_arquivo'] === 'video'): ?>
                                                <video
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                    muted loop playsinline autoplay>
                                                    <source src="/<?= $m['caminho_arquivo'] ?>" type="<?= $m['tipo_mime'] ?>">
                                                </video>
                                            <?php elseif ($m['tipo_arquivo'] === 'audio'): ?>
                                                <div class="text-center p-6">
                                                    <div
                                                        class="w-24 h-24 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                                        <i class="fas fa-music text-white text-3xl"></i>
                                                    </div>
                                                    <h4 class="font-semibold text-gray-900 mb-2">
                                                        <?= $m['descricao'] ?? 'Áudio do Sermão' ?>
                                                    </h4>
                                                    <p class="text-sm text-gray-500">CLIQUE PARA OUVIR</p>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-center p-6">
                                                    <div
                                                        class="w-16 h-16 bg-gradient-to-br <?= $midiasPorTipo[$m['tipo_arquivo']]['cor'] ?? 'from-gray-500 to-gray-600' ?> rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                                        <i
                                                            class="<?= $midiasPorTipo[$m['tipo_arquivo']]['icone'] ?? 'fas fa-file' ?> text-white text-2xl"></i>
                                                    </div>
                                                    <h4 class="font-semibold text-gray-900 mb-2"><?= $m['descricao'] ?? 'Arquivo' ?>
                                                    </h4>
                                                    <p class="text-sm text-gray-500"><?= strtoupper($m['tipo_arquivo']) ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Hover Overlay -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                            <div
                                                class="p-4 w-full transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                                <div class="flex items-center justify-between text-white">
                                                    <div class="flex-1 min-w-0">
                                                        <h4 class="font-semibold truncate"><?= $m['descricao'] ?? 'Arquivo' ?>
                                                        </h4>
                                                        <p class="text-sm text-gray-200"><?= strtoupper($m['tipo_arquivo']) ?>
                                                        </p>
                                                    </div>
                                                    <div class="ml-4">
                                                        <i class="fas fa-expand text-lg"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Type Badge -->
                                        <div class="absolute top-3 right-3">
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white bg-black/70 backdrop-blur-sm capitalize">
                                                <?= $m['tipo_arquivo'] ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Enhanced Fullscreen Modal -->
                        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="fixed inset-0 z-50" style="display: none;"
                            @keydown.escape="closePreview"
                            x-effect="isOpen ? $el.style.display = 'block' : $el.style.display = 'none'">

                            <!-- Gradient Backdrop with Blur -->
                            <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/60 to-black/80 backdrop-blur-md"
                                @click="closePreview"></div>

                            <!-- Floating Controls Container -->
                            <div class="absolute top-4 left-4 right-4 z-30 flex items-center justify-between">
                                <!-- Left Controls -->
                                <div class="flex items-center space-x-3">
                                    <button @click="prevItem"
                                        class="group flex items-center justify-center w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full transition-all duration-300 hover:scale-110"
                                        aria-label="Anterior">
                                        <i
                                            class="fas fa-chevron-left text-white group-hover:text-yellow-300 transition-colors"></i>
                                    </button>
                                    <button @click="nextItem"
                                        class="group flex items-center justify-center w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full transition-all duration-300 hover:scale-110"
                                        aria-label="Próximo">
                                        <i
                                            class="fas fa-chevron-right text-white group-hover:text-yellow-300 transition-colors"></i>
                                    </button>
                                </div>

                                <!-- Center Info -->
                                <div class="absolute left-1/2 transform -translate-x-1/2">
                                    <div class="bg-black/40 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-white font-medium text-sm"
                                                x-text="currentItem.descricao || 'Arquivo do sermão'"></span>
                                            <span class="text-gray-300 text-xs">
                                                <span x-text="currentIndex + 1"></span>/<span x-text="items.length"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Controls -->
                                <div class="flex items-center space-x-3">
                                    <button @click="closePreview"
                                        class="group flex items-center justify-center w-12 h-12 bg-red-500/20 hover:bg-red-500/30 backdrop-blur-sm rounded-full transition-all duration-300 hover:scale-110"
                                        aria-label="Fechar visualizador">
                                        <i class="fas fa-times text-white group-hover:text-red-300 transition-colors"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Main Content Area -->
                            <div class="absolute inset-0 flex items-center justify-center p-4">
                                <!-- Image Preview -->
                                <template x-if="currentItem.tipo_arquivo === 'imagem'">
                                    <div class="relative group max-w-5xl max-h-[85vh]">
                                        <div class="relative">
                                            <div
                                                class="absolute -inset-4 bg-gradient-to-r from-yellow-400/20 via-transparent to-blue-400/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                            </div>
                                            <img :src="'/' + currentItem.caminho_arquivo"
                                                :alt="currentItem.descricao || 'Imagem do sermão'"
                                                class="relative rounded-xl shadow-2xl transform transition-transform duration-500 group-hover:scale-[1.02] max-w-full max-h-[85vh] object-contain cursor-pointer"
                                                @click="closePreview">
                                        </div>
                                    </div>
                                </template>

                                <!-- Video Preview -->
                                <template x-if="currentItem.tipo_arquivo === 'video'">
                                    <div class="relative group max-w-4xl w-full">
                                        <div
                                            class="absolute -inset-4 bg-gradient-to-r from-purple-400/20 via-transparent to-pink-400/20 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        </div>
                                        <video controls autoplay class="relative rounded-xl shadow-2xl w-full max-h-[85vh]"
                                            x-ref="videoPlayer">
                                            <source :src="'/' + currentItem.caminho_arquivo" :type="currentItem.tipo_mime">
                                        </video>
                                    </div>
                                </template>

                                <!-- Audio Preview -->
                                <template x-if="currentItem.tipo_arquivo === 'audio'">
                                    <div
                                        class="bg-gradient-to-br from-gray-900/90 to-black/90 backdrop-blur-lg rounded-2xl p-8 shadow-2xl border border-gray-700/50 max-w-md">
                                        <div class="text-center mb-6">
                                            <div
                                                class="w-24 h-24 bg-gradient-to-br from-green-500/20 to-green-600/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-500/30">
                                                <i class="fas fa-music text-green-300 text-3xl"></i>
                                            </div>
                                            <h3 class="text-xl font-semibold text-white mb-2"
                                                x-text="currentItem.descricao || 'Áudio do Sermão'"></h3>
                                            <p class="text-gray-400 text-sm"
                                                x-text="formatFileSize(currentItem.tamanho_arquivo || 0)"></p>
                                        </div>

                                        <audio controls class="w-full rounded-lg bg-gray-800/50" x-ref="audioPlayer">
                                            <source :src="'/' + currentItem.caminho_arquivo" :type="currentItem.tipo_mime">
                                        </audio>

                                        <!-- Audio Controls -->
                                        <div class="flex justify-center space-x-4 mt-6">
                                            <button @click="$refs.audioPlayer.play()"
                                                class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg transition-all duration-300 transform hover:scale-105">
                                                <i class="fas fa-play mr-2"></i>Play
                                            </button>
                                            <button @click="$refs.audioPlayer.pause()"
                                                class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-all duration-300">
                                                <i class="fas fa-pause mr-2"></i>Pause
                                            </button>
                                        </div>
                                    </div>
                                </template>

                                <!-- PDF Preview -->
                                <template x-if="currentItem.tipo_arquivo === 'pdf'">
                                    <div
                                        class="relative group w-full max-w-6xl h-[85vh] bg-white rounded-xl shadow-2xl overflow-hidden">
                                        <div
                                            class="absolute top-0 left-0 right-0 z-10 bg-gradient-to-r from-gray-800 to-gray-900 p-3">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex space-x-2">
                                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                                    </div>
                                                    <span class="text-white text-sm font-medium truncate"
                                                        x-text="currentItem.descricao || 'Documento PDF'"></span>
                                                </div>
                                                <div class="text-gray-400 text-sm">
                                                    <span x-text="formatFileSize(currentItem.tamanho_arquivo || 0)"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <iframe :src="'/' + currentItem.caminho_arquivo" class="w-full h-full pt-12"
                                            frameborder="0"></iframe>
                                    </div>
                                </template>

                                <!-- Other Files -->
                                <template x-if="!['imagem','video','audio','pdf'].includes(currentItem.tipo_arquivo)">
                                    <div
                                        class="bg-gradient-to-br from-gray-900/90 to-black/90 backdrop-blur-lg rounded-2xl p-8 shadow-2xl border border-gray-700/50 max-w-md text-center">
                                        <div
                                            class="w-32 h-32 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-full flex items-center justify-center mx-auto mb-6 border border-blue-500/30">
                                            <i class="fas fa-file-alt text-blue-300 text-4xl"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-white mb-3"
                                            x-text="currentItem.descricao || 'Arquivo'"></h3>
                                        <p class="text-gray-400 mb-2">
                                            <span class="capitalize" x-text="currentItem.tipo_arquivo"></span>
                                            • <span x-text="formatFileSize(currentItem.tamanho_arquivo || 0)"></span>
                                        </p>
                                        <a :href="'/' + currentItem.caminho_arquivo" download
                                            class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300">
                                            <i class="fas fa-download mr-2"></i>
                                            Baixar Arquivo
                                        </a>
                                    </div>
                                </template>
                            </div>

                            <!-- Progress Indicator -->
                            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
                                <div class="flex space-x-1">
                                    <template x-for="(item, index) in items" :key="index">
                                        <button @click="currentIndex = index"
                                            class="w-2 h-2 rounded-full transition-all duration-300"
                                            :class="currentIndex === index ? 'bg-yellow-400 w-6' : 'bg-white/30 hover:bg-white/50'"></button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function enhancedMediaGallery(items) {
                        return {
                            items,
                            isOpen: false,
                            currentIndex: 0,
                            get currentItem() {
                                return this.items[this.currentIndex];
                            },
                            openPreview(index) {
                                this.currentIndex = index;
                                this.isOpen = true;
                                document.body.style.overflow = 'hidden';
                                setTimeout(() => {
                                    const videoPlayer = this.$refs.videoPlayer;
                                    const audioPlayer = this.$refs.audioPlayer;
                                    if (videoPlayer) videoPlayer.play();
                                    if (audioPlayer) audioPlayer.play();
                                }, 300);
                            },
                            closePreview() {
                                this.isOpen = false;
                                document.body.style.overflow = 'auto';
                                const videoPlayer = this.$refs.videoPlayer;
                                const audioPlayer = this.$refs.audioPlayer;
                                if (videoPlayer) videoPlayer.pause();
                                if (audioPlayer) audioPlayer.pause();
                            },
                            nextItem() {
                                this.currentIndex = (this.currentIndex + 1) % this.items.length;
                                this.scrollToCurrent();
                            },
                            prevItem() {
                                this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
                                this.scrollToCurrent();
                            },
                            scrollToCurrent() {
                                const element = document.querySelector(`.media-item[data-index="${this.currentIndex}"]`);
                                if (element) {
                                    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }
                            },
                            formatFileSize(bytes) {
                                if (bytes === 0) return '0 Bytes';
                                const k = 1024;
                                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                                const i = Math.floor(Math.log(bytes) / Math.log(k));
                                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                            },
                            init() {
                                // Keyboard navigation
                                document.addEventListener('keydown', (e) => {
                                    if (!this.isOpen) return;
                                    switch (e.key) {
                                        case 'Escape': this.closePreview(); break;
                                        case 'ArrowRight': this.nextItem(); break;
                                        case 'ArrowLeft': this.prevItem(); break;
                                    }
                                });

                                // Category filtering
                                const categoryFilters = document.querySelectorAll('.category-filter');
                                const mediaItems = document.querySelectorAll('.media-item');
                                categoryFilters.forEach(btn => {
                                    btn.addEventListener('click', function () {
                                        categoryFilters.forEach(b => b.classList.remove('active', 'bg-gradient-to-r', 'from-yellow-500', 'to-yellow-600', 'text-white'));
                                        categoryFilters.forEach(b => b.classList.add('bg-white', 'border-2', 'border-yellow-200', 'text-yellow-700'));
                                        this.classList.add('active', 'bg-gradient-to-r', 'from-yellow-500', 'to-yellow-600', 'text-white');
                                        this.classList.remove('bg-white', 'border-2', 'border-yellow-200', 'text-yellow-700');
                                        const category = this.dataset.category;
                                        mediaItems.forEach(item => {
                                            if (category === 'all' || item.classList.contains(`category-${category}`)) {
                                                item.style.display = 'block';
                                                item.style.animation = 'fadeInUp 0.5s ease-out';
                                            } else {
                                                item.style.animation = 'fadeOut 0.3s ease-out';
                                                setTimeout(() => item.style.display = 'none', 300);
                                            }
                                        });
                                    });
                                });
                            }
                        };
                    }

                    document.addEventListener('DOMContentLoaded', function () {
                        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                            anchor.addEventListener('click', function (e) {
                                e.preventDefault();
                                const target = document.querySelector(this.getAttribute('href'));
                                if (target) {
                                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                                }
                            });
                        });
                    });
                </script>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
    [x-cloak] {
        display: none !important;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(20px);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    .sermon-card {
        animation: fadeInUp 0.6s ease-out backwards;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #fef3c7;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #f59e0b, #d97706);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #d97706, #b45309);
    }

    button:focus,
    a:focus,
    input:focus {
        outline: 2px solid #f59e0b;
        outline-offset: 2px;
    }

    .category-filter {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .category-filter.active {
        box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.3);
    }

    .media-item {
        animation: fadeInUp 0.6s ease-out backwards;
    }

    @media (max-width: 768px) {
        .text-6xl {
            font-size: 3rem;
        }

        .text-4xl {
            font-size: 2.5rem;
        }

        .sticky {
            position: static;
        }
    }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout_public.php";
?>