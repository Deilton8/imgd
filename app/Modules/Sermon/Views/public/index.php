<?php
ob_start();
?>

<!-- Page Header com gradiente melhorado -->
<section class="relative bg-gradient-to-br from-yellow-900 via-yellow-800 to-yellow-700 py-12 md:py-20 text-white"
    role="banner">
    <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-transparent"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center space-y-3 md:space-y-4">
            <div
                class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-3 py-1.5 md:px-4 md:py-2 rounded-full mb-3 md:mb-4">
                <i class="fas fa-bible text-yellow-300 text-sm md:text-base"></i>
                <span class="text-xs md:text-sm font-semibold">Coleção de Sermões</span>
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-7xl font-bold mb-3 md:mb-4 leading-tight tracking-tight">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-yellow-100">
                    Mensagens
                </span>
            </h1>
            <p class="text-base md:text-xl lg:text-2xl text-yellow-100 font-light max-w-3xl mx-auto px-2">
                Sermões que inspiram, ensinam e fortalecem sua jornada espiritual
            </p>
        </div>
    </div>
    <!-- Elemento decorativo -->
    <div class="absolute bottom-0 left-0 right-0 h-6 md:h-8 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Breadcrumb melhorado -->
<nav class="bg-white/95 backdrop-blur-sm py-3 md:py-4 border-b border-yellow-100 shadow-sm" aria-label="Navegação">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-2 md:space-x-3 text-xs md:text-sm">
            <li>
                <a href="/"
                    class="flex items-center text-gray-600 hover:text-yellow-600 transition-all duration-300 group"
                    aria-label="Ir para início">
                    <div
                        class="w-6 h-6 md:w-8 md:h-8 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-1 md:mr-2 group-hover:scale-110 transition-transform">
                        <i class="fas fa-home text-yellow-500 text-xs md:text-sm"></i>
                    </div>
                    <span class="font-medium hidden sm:inline">Início</span>
                </a>
            </li>
            <li class="flex items-center text-gray-400">
                <i class="fas fa-chevron-right text-xs mx-1 md:mx-2"></i>
            </li>
            <li class="flex items-center">
                <span class="text-gray-900 font-semibold flex items-center text-sm md:text-base">
                    <i class="fas fa-bible text-yellow-500 mr-1 md:mr-2 text-sm md:text-base"></i>
                    <span class="truncate">Mensagens</span>
                </span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<main class="py-8 md:py-16 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-3 md:px-4">
        <!-- Header section -->
        <div class="text-center mb-10 md:mb-16 max-w-3xl mx-auto px-2">
            <div class="inline-flex items-center justify-center space-x-2 md:space-x-3 mb-4 md:mb-6">
                <div class="w-8 md:w-12 h-1 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full"></div>
                <i class="fas fa-star text-yellow-400 text-lg md:text-xl"></i>
                <div class="w-8 md:w-12 h-1 bg-gradient-to-r from-yellow-500 to-yellow-400 rounded-full"></div>
            </div>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 md:mb-6">
                Explore Nossas <span class="text-yellow-600">Mensagens</span>
            </h2>
            <p class="text-sm md:text-lg text-gray-600 leading-relaxed px-2">
                Encontre sermões inspiradores, estudos bíblicos profundos e mensagens que transformam vidas.
            </p>

            <!-- Filtros interativos -->
            <div class="flex flex-wrap justify-center gap-2 md:gap-3 mt-6 md:mt-8 px-2">
                <button
                    class="filter-btn active px-3 py-2 md:px-5 md:py-2.5 rounded-lg md:rounded-xl bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 flex items-center text-sm md:text-base">
                    <i class="fas fa-layer-group mr-1 md:mr-2 text-xs md:text-sm"></i>
                    <span class="truncate">Todas</span>
                </button>
                <button
                    class="filter-btn px-3 py-2 md:px-5 md:py-2.5 rounded-lg md:rounded-xl bg-white border border-yellow-200 md:border-2 text-yellow-700 font-semibold transition-all duration-300 hover:border-yellow-300 hover:bg-yellow-50 flex items-center text-sm md:text-base">
                    <i class="fas fa-microphone mr-1 md:mr-2 text-xs md:text-sm"></i>
                    <span class="truncate">Áudio</span>
                </button>
                <button
                    class="filter-btn px-3 py-2 md:px-5 md:py-2.5 rounded-lg md:rounded-xl bg-white border border-yellow-200 md:border-2 text-yellow-700 font-semibold transition-all duration-300 hover:border-yellow-300 hover:bg-yellow-50 flex items-center text-sm md:text-base">
                    <i class="fas fa-video mr-1 md:mr-2 text-xs md:text-sm"></i>
                    <span class="truncate">Vídeo</span>
                </button>
                <button
                    class="filter-btn px-3 py-2 md:px-5 md:py-2.5 rounded-lg md:rounded-xl bg-white border border-yellow-200 md:border-2 text-yellow-700 font-semibold transition-all duration-300 hover:border-yellow-300 hover:bg-yellow-50 flex items-center text-sm md:text-base">
                    <i class="fas fa-file-pdf mr-1 md:mr-2 text-xs md:text-sm"></i>
                    <span class="truncate">PDF</span>
                </button>
            </div>
        </div>

        <!-- Grid de Sermões -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8" id="sermons-grid">
            <?php if (!empty($sermoes)): ?>
                <?php foreach ($sermoes as $index => $sermao): ?>
                    <?php
                    $hasAudio = false;
                    $hasVideo = false;
                    $hasTranscript = false;
                    $hasImages = false;

                    if (!empty($sermao['midias'])) {
                        foreach ($sermao['midias'] as $midia) {
                            if ($midia['tipo_arquivo'] === 'audio')
                                $hasAudio = true;
                            if ($midia['tipo_arquivo'] === 'video')
                                $hasVideo = true;
                            if ($midia['tipo_arquivo'] === 'pdf')
                                $hasTranscript = true;
                            if ($midia['tipo_arquivo'] === 'imagem')
                                $hasImages = true;
                        }
                    }

                    if (!isset($sermao['slug']) || empty($sermao['slug'])) {
                        $sermao['slug'] = generateSlug($sermao['titulo']);
                    }
                    ?>

                    <div class="sermon-card group relative"
                        data-media-types="<?php echo ($hasAudio ? 'audio ' : '') . ($hasVideo ? 'video ' : '') . ($hasTranscript ? 'pdf' : ''); ?>"
                        style="animation-delay: <?php echo ($index * 0.1); ?>s;">

                        <!-- Card Container -->
                        <div
                            class="bg-white rounded-xl md:rounded-2xl shadow-lg md:shadow-xl hover:shadow-xl md:hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-1 md:hover:-translate-y-2 h-full flex flex-col border border-yellow-100 md:border-2 md:border-transparent group-hover:border-yellow-200">

                            <!-- Image/Media Section -->
                            <div class="relative h-48 sm:h-56 md:h-64 overflow-hidden flex-shrink-0">
                                <?php if ($hasImages): ?>
                                    <a href="/sermao/<?php echo $sermao['slug']; ?>" class="block h-full"
                                        aria-label="Ver mensagem completa: <?php echo htmlspecialchars($sermao['titulo']); ?>">
                                        <div class="swiper sermon-swiper h-full">
                                            <div class="swiper-wrapper">
                                                <?php foreach ($sermao['midias'] as $midia): ?>
                                                    <?php if ($midia['tipo_arquivo'] === 'imagem'): ?>
                                                        <div class="swiper-slide">
                                                            <img src="/<?php echo $midia['caminho_arquivo']; ?>"
                                                                alt="<?php echo htmlspecialchars($sermao['titulo']); ?>"
                                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                                                loading="lazy">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>

                                            <!-- Navigation -->
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-pagination"></div>

                                            <!-- Media Type Badges -->
                                            <div
                                                class="absolute top-3 left-3 md:top-4 md:left-4 z-10 flex flex-wrap gap-1 md:gap-2">
                                                <?php if ($hasAudio): ?>
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow backdrop-blur-sm">
                                                        <i class="fas fa-headphones mr-1 md:mr-1.5 text-xs"></i>
                                                        <span class="hidden sm:inline">ÁUDIO</span>
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ($hasVideo): ?>
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-red-500 to-red-600 shadow backdrop-blur-sm">
                                                        <i class="fas fa-video mr-1 md:mr-1.5 text-xs"></i>
                                                        <span class="hidden sm:inline">VÍDEO</span>
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ($hasTranscript): ?>
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-500 to-purple-600 shadow backdrop-blur-sm">
                                                        <i class="fas fa-file-alt mr-1 md:mr-1.5 text-xs"></i>
                                                        <span class="hidden sm:inline">PDF</span>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Date Badge -->
                                            <?php if (!empty($sermao['data'])): ?>
                                                <div class="absolute bottom-3 right-3 md:bottom-4 md:right-4 z-10">
                                                    <div
                                                        class="bg-white/95 backdrop-blur-sm rounded-lg md:rounded-xl shadow text-center p-2 md:p-3 border border-white/20 min-w-12 md:min-w-16">
                                                        <div class="text-yellow-600 font-black text-lg md:text-2xl leading-none">
                                                            <?php echo date("d", strtotime($sermao['data'])); ?>
                                                        </div>
                                                        <div
                                                            class="text-gray-700 font-bold text-[10px] md:text-xs uppercase tracking-wider">
                                                            <?php echo date("M", strtotime($sermao['data'])); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <!-- Placeholder com gradiente animado -->
                                    <a href="/sermao/<?php echo $sermao['slug']; ?>" class="block h-full">
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 flex items-center justify-center relative overflow-hidden">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent animate-shimmer">
                                            </div>
                                            <div class="relative z-10 text-center p-4 md:p-6">
                                                <i class="fas fa-bible text-white text-3xl md:text-5xl mb-2 md:mb-4"></i>
                                                <h3 class="text-white font-bold text-sm md:text-lg line-clamp-2">
                                                    <?php echo htmlspecialchars($sermao['titulo']); ?>
                                                </h3>
                                            </div>
                                        </div>

                                        <!-- Media Type Badges on placeholder -->
                                        <div class="absolute top-3 left-3 md:top-4 md:left-4 z-10 flex flex-wrap gap-1 md:gap-2">
                                            <?php if ($hasAudio): ?>
                                                <span
                                                    class="inline-flex items-center px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow backdrop-blur-sm">
                                                    <i class="fas fa-headphones mr-1 md:mr-1.5 text-xs"></i>
                                                    <span class="hidden sm:inline">ÁUDIO</span>
                                                </span>
                                            <?php endif; ?>
                                            <?php if ($hasVideo): ?>
                                                <span
                                                    class="inline-flex items-center px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-red-500 to-red-600 shadow backdrop-blur-sm">
                                                    <i class="fas fa-video mr-1 md:mr-1.5 text-xs"></i>
                                                    <span class="hidden sm:inline">VÍDEO</span>
                                                </span>
                                            <?php endif; ?>
                                            <?php if ($hasTranscript): ?>
                                                <span
                                                    class="inline-flex items-center px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-500 to-purple-600 shadow backdrop-blur-sm">
                                                    <i class="fas fa-file-alt mr-1 md:mr-1.5 text-xs"></i>
                                                    <span class="hidden sm:inline">PDF</span>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Date Badge on placeholder -->
                                        <?php if (!empty($sermao['data'])): ?>
                                            <div class="absolute bottom-3 right-3 md:bottom-4 md:right-4 z-10">
                                                <div
                                                    class="bg-white/95 backdrop-blur-sm rounded-lg md:rounded-xl shadow text-center p-2 md:p-3 border border-white/20 min-w-12 md:min-w-16">
                                                    <div class="text-yellow-600 font-black text-lg md:text-2xl leading-none">
                                                        <?php echo date("d", strtotime($sermao['data'])); ?>
                                                    </div>
                                                    <div
                                                        class="text-gray-700 font-bold text-[10px] md:text-xs uppercase tracking-wider">
                                                        <?php echo date("M", strtotime($sermao['data'])); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                                <!-- Gradient Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4 md:p-6 flex-1 flex flex-col">
                                <!-- Title -->
                                <a href="/sermao/<?php echo $sermao['slug']; ?>" class="block group/title mb-3 md:mb-4 flex-1">
                                    <h3
                                        class="text-base md:text-xl font-bold text-gray-900 group-hover/title:text-yellow-600 transition-colors duration-300 line-clamp-2 mb-2 md:mb-3">
                                        <?php echo htmlspecialchars($sermao['titulo']); ?>
                                    </h3>

                                    <!-- Description Preview -->
                                    <p class="text-gray-600 text-xs md:text-sm leading-relaxed mb-3 md:mb-4 line-clamp-2">
                                        <?php
                                        $conteudo = strip_tags($sermao['conteudo']);
                                        echo strlen($conteudo) > 80 ? substr($conteudo, 0, 80) . '...' : $conteudo;
                                        ?>
                                    </p>
                                </a>

                                <!-- Sermon Details -->
                                <div class="space-y-2 md:space-y-3 mb-4 md:mb-5">
                                    <!-- Date -->
                                    <?php if (!empty($sermao['data'])): ?>
                                        <div class="flex items-center text-gray-600 group/detail">
                                            <div
                                                class="w-7 h-7 md:w-9 md:h-9 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-2 md:mr-3 flex-shrink-0 group-hover/detail:scale-110 transition-transform duration-300">
                                                <i class="far fa-calendar text-yellow-600 text-xs md:text-sm"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-semibold text-gray-900 truncate text-sm md:text-base">
                                                    <?php echo date("d/m/Y", strtotime($sermao['data'])); ?>
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    <?php echo date("l", strtotime($sermao['data'])); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Preacher -->
                                    <?php if (!empty($sermao['pregador'])): ?>
                                        <div class="flex items-center text-gray-600 group/detail">
                                            <div
                                                class="w-7 h-7 md:w-9 md:h-9 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-2 md:mr-3 flex-shrink-0 group-hover/detail:scale-110 transition-transform duration-300">
                                                <i class="fas fa-user text-yellow-600 text-xs md:text-sm"></i>
                                            </div>
                                            <span class="font-medium text-gray-900 truncate text-sm md:text-base">
                                                <?php echo htmlspecialchars($sermao['pregador']); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Bible Reference -->
                                    <?php if (!empty($sermao['referencia_biblica'])): ?>
                                        <div class="flex items-center text-gray-600 group/detail">
                                            <div
                                                class="w-7 h-7 md:w-9 md:h-9 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-2 md:mr-3 flex-shrink-0 group-hover/detail:scale-110 transition-transform duration-300">
                                                <i class="fas fa-book text-yellow-600 text-xs md:text-sm"></i>
                                            </div>
                                            <span class="font-medium text-gray-900 truncate text-sm md:text-base">
                                                <?php echo htmlspecialchars($sermao['referencia_biblica']); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-auto pt-3 md:pt-4 border-t border-gray-100">
                                    <a href="/sermao/<?php echo $sermao['slug']; ?>"
                                        class="inline-flex items-center justify-between w-full px-3 py-2.5 md:px-4 md:py-3 bg-gradient-to-r from-yellow-50 to-yellow-100 hover:from-yellow-100 hover:to-yellow-200 text-yellow-700 rounded-lg md:rounded-xl font-semibold transition-all duration-300 transform hover:scale-[1.02] group/btn shadow-sm hover:shadow text-sm md:text-base"
                                        aria-label="Ver mensagem completa: <?php echo htmlspecialchars($sermao['titulo']); ?>">
                                        <span class="truncate">Ver Mensagem</span>
                                        <div
                                            class="w-6 h-6 md:w-8 md:h-8 bg-white rounded-lg flex items-center justify-center group-hover/btn:bg-yellow-50 transition-colors flex-shrink-0">
                                            <i
                                                class="fas fa-arrow-right text-yellow-600 text-xs md:text-sm group-hover/btn:translate-x-1 transition-transform"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State Melhorado -->
                <div class="col-span-full text-center py-12 md:py-20 px-4">
                    <div class="max-w-md mx-auto">
                        <div class="relative inline-block mb-6 md:mb-8">
                            <div
                                class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full flex items-center justify-center mx-auto animate-pulse">
                                <i class="fas fa-bible text-yellow-500 text-3xl md:text-4xl"></i>
                            </div>
                            <div
                                class="absolute -top-2 -right-2 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center animate-bounce">
                                <i class="fas fa-plus text-white text-base md:text-lg"></i>
                            </div>
                        </div>
                        <h3 class="text-xl md:text-3xl font-bold text-gray-900 mb-3 md:mb-4">Nenhuma Mensagem Encontrada
                        </h3>
                        <p class="text-gray-600 text-sm md:text-lg mb-6 md:mb-8 leading-relaxed">
                            Não há mensagens disponíveis no momento. Estamos preparando sermões inspiradores para você!
                        </p>
                        <div class="flex flex-col gap-3 md:gap-4 justify-center">
                            <a href="/contato"
                                class="inline-flex items-center justify-center bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-6 py-3 md:px-8 md:py-3.5 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl group text-sm md:text-base">
                                <i
                                    class="fas fa-envelope mr-2 md:mr-3 text-base md:text-lg group-hover:scale-110 transition-transform"></i>
                                Contactar Igreja
                            </a>
                            <a href="/"
                                class="inline-flex items-center justify-center bg-white border border-yellow-200 md:border-2 hover:border-yellow-300 text-yellow-700 px-6 py-3 md:px-8 md:py-3.5 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow group text-sm md:text-base">
                                <i
                                    class="fas fa-home mr-2 md:mr-3 text-base md:text-lg group-hover:scale-110 transition-transform"></i>
                                Voltar ao Início
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Swiper with better settings
        const sermonSwipers = document.querySelectorAll('.sermon-swiper');

        sermonSwipers.forEach(swiperEl => {
            new Swiper(swiperEl, {
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                grabCursor: true,
                // Responsive breakpoints
                breakpoints: {
                    640: {
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        }
                    }
                }
            });
        });

        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const sermonCards = document.querySelectorAll('.sermon-card');

        filterButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                // Remove active class from all buttons
                filterButtons.forEach(b => {
                    b.classList.remove('active');
                    b.classList.remove('bg-gradient-to-r', 'from-yellow-500', 'to-yellow-600', 'text-white');
                    b.classList.add('bg-white', 'border', 'md:border-2', 'border-yellow-200', 'text-yellow-700');
                });

                // Add active class to clicked button
                this.classList.add('active');
                this.classList.add('bg-gradient-to-r', 'from-yellow-500', 'to-yellow-600', 'text-white');
                this.classList.remove('bg-white', 'border', 'md:border-2', 'border-yellow-200', 'text-yellow-700');

                const filter = this.textContent.trim();
                let filterType = 'all';

                if (filter.includes('Áudio') || filter.includes('audio')) filterType = 'audio';
                else if (filter.includes('Vídeo') || filter.includes('video')) filterType = 'video';
                else if (filter.includes('PDF') || filter.includes('pdf')) filterType = 'pdf';

                // Filter sermons with animation
                sermonCards.forEach(card => {
                    const mediaTypes = card.dataset.mediaTypes || '';
                    const shouldShow = filterType === 'all' || mediaTypes.includes(filterType);

                    if (shouldShow) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.5s ease-out';
                    } else {
                        card.style.animation = 'fadeOut 0.3s ease-out';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Add hover effect to cards
        sermonCards.forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.style.zIndex = '10';
            });

            card.addEventListener('mouseleave', function () {
                this.style.zIndex = '1';
            });
        });

        // Touch interactions for mobile
        sermonCards.forEach(card => {
            let touchStartX = 0;
            let touchStartY = 0;

            card.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].screenX;
                touchStartY = e.changedTouches[0].screenY;
                this.classList.add('active-touch');
            });

            card.addEventListener('touchend', function (e) {
                const touchEndX = e.changedTouches[0].screenX;
                const touchEndY = e.changedTouches[0].screenY;

                // Check if it's a tap (not a swipe)
                if (Math.abs(touchEndX - touchStartX) < 10 && Math.abs(touchEndY - touchStartY) < 10) {
                    this.classList.remove('active-touch');
                }
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>

<style>
    /* Custom styles */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Swiper customization */
    .sermon-swiper {
        border-radius: 12px 12px 0 0;
    }

    @media (min-width: 768px) {
        .sermon-swiper {
            border-radius: 16px 16px 0 0;
        }
    }

    .sermon-swiper .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
        width: 6px;
        height: 6px;
        transition: all 0.3s ease;
    }

    @media (min-width: 768px) {
        .sermon-swiper .swiper-pagination-bullet {
            width: 8px;
            height: 8px;
        }
    }

    .sermon-swiper .swiper-pagination-bullet-active {
        background: #f59e0b;
        opacity: 1;
        transform: scale(1.3);
        box-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
    }

    .sermon-swiper .swiper-button-next,
    .sermon-swiper .swiper-button-prev {
        color: white;
        background: rgba(0, 0, 0, 0.3);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        backdrop-filter: blur(4px);
        transition: all 0.3s ease;
        display: none;
    }

    @media (min-width: 768px) {

        .sermon-swiper .swiper-button-next,
        .sermon-swiper .swiper-button-prev {
            width: 40px;
            height: 40px;
            display: flex;
        }
    }

    .sermon-swiper .swiper-button-next:after,
    .sermon-swiper .swiper-button-prev:after {
        font-size: 14px;
        font-weight: bold;
    }

    @media (min-width: 768px) {

        .sermon-swiper .swiper-button-next:after,
        .sermon-swiper .swiper-button-prev:after {
            font-size: 16px;
        }
    }

    .sermon-swiper .swiper-button-next:hover,
    .sermon-swiper .swiper-button-prev:hover {
        background: rgba(0, 0, 0, 0.5);
        transform: scale(1.1);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
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

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .animate-shimmer {
        animation: shimmer 2s infinite;
    }

    .sermon-card {
        animation: fadeInUp 0.6s ease-out backwards;
    }

    /* Mobile touch feedback */
    .active-touch {
        transform: scale(0.98);
        transition: transform 0.2s ease;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    @media (min-width: 768px) {
        ::-webkit-scrollbar {
            width: 10px;
        }
    }

    ::-webkit-scrollbar-track {
        background: #fef3c7;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #f59e0b, #d97706);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #d97706, #b45309);
    }

    /* Focus styles for accessibility */
    a:focus,
    button:focus,
    input:focus {
        outline: 2px solid #f59e0b;
        outline-offset: 2px;
    }

    /* Mobile-specific adjustments */
    @media (max-width: 640px) {
        .filter-btn {
            padding: 8px 12px;
            font-size: 0.875rem;
        }

        .sermon-card .inline-flex span:not(.hidden) {
            font-size: 0.75rem;
            padding: 2px 4px;
        }

        .grid {
            gap: 16px;
        }

        /* Improve touch targets */
        button,
        a {
            min-height: 44px;
            min-width: 44px;
        }

        .filter-btn {
            min-height: 36px;
        }
    }

    @media (max-width: 480px) {
        .sermon-card {
            margin: 0 8px;
        }

        .filter-btn span {
            display: none;
        }

        .filter-btn i {
            margin-right: 0;
        }

        .sermon-card h3 {
            font-size: 1rem;
            line-height: 1.4;
        }
    }

    /* Tablet adjustments */
    @media (min-width: 641px) and (max-width: 1024px) {
        .sermon-card h3 {
            font-size: 1.125rem;
        }

        .grid {
            gap: 20px;
        }

        .sermon-swiper .swiper-pagination {
            bottom: 10px;
        }
    }
</style>

<?php
// Função auxiliar para gerar slugs
function generateSlug($string)
{
    $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $string), '-'));
    return $slug;
}

$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout_public.php";
?>