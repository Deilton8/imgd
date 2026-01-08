<?php
ob_start();
?>

<!-- Page Header com gradiente melhorado -->
<section class="relative bg-gradient-to-br from-yellow-900 via-yellow-800 to-yellow-700 py-20 text-white" role="banner">
    <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-transparent"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center space-y-4">
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                <i class="fas fa-bible text-yellow-300"></i>
                <span class="text-sm font-semibold">Coleção de Sermões</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-4 leading-tight tracking-tight">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-yellow-100">
                    Mensagens
                </span>
            </h1>
            <p class="text-xl md:text-2xl text-yellow-100 font-light max-w-3xl mx-auto">
                Sermões que inspiram, ensinam e fortalecem sua jornada espiritual
            </p>
        </div>
    </div>
    <!-- Elemento decorativo -->
    <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Breadcrumb melhorado -->
<nav class="bg-white/95 backdrop-blur-sm py-4 border-b border-yellow-100 shadow-sm" aria-label="Navegação">
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
            <li class="flex items-center">
                <span class="text-gray-900 font-semibold flex items-center">
                    <i class="fas fa-bible text-yellow-500 mr-2"></i>
                    Mensagens
                </span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<main class="py-16 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <!-- Header section -->
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <div class="inline-flex items-center justify-center space-x-3 mb-6">
                <div class="w-12 h-1 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-full"></div>
                <i class="fas fa-star text-yellow-400 text-xl"></i>
                <div class="w-12 h-1 bg-gradient-to-r from-yellow-500 to-yellow-400 rounded-full"></div>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Explore Nossas <span class="text-yellow-600">Mensagens</span>
            </h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                Encontre sermões inspiradores, estudos bíblicos profundos e mensagens que transformam vidas.
            </p>

            <!-- Filtros interativos -->
            <div class="flex flex-wrap justify-center gap-3 mt-8">
                <button
                    class="filter-btn active px-5 py-2.5 rounded-xl bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 flex items-center">
                    <i class="fas fa-layer-group mr-2"></i>
                    Todas as Mensagens
                </button>
                <button
                    class="filter-btn px-5 py-2.5 rounded-xl bg-white border-2 border-yellow-200 text-yellow-700 font-semibold transition-all duration-300 hover:border-yellow-300 hover:bg-yellow-50 flex items-center">
                    <i class="fas fa-microphone mr-2"></i>
                    Áudio
                </button>
                <button
                    class="filter-btn px-5 py-2.5 rounded-xl bg-white border-2 border-yellow-200 text-yellow-700 font-semibold transition-all duration-300 hover:border-yellow-300 hover:bg-yellow-50 flex items-center">
                    <i class="fas fa-video mr-2"></i>
                    Vídeo
                </button>
                <button
                    class="filter-btn px-5 py-2.5 rounded-xl bg-white border-2 border-yellow-200 text-yellow-700 font-semibold transition-all duration-300 hover:border-yellow-300 hover:bg-yellow-50 flex items-center">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Transcrições
                </button>
            </div>
        </div>

        <!-- Grid de Sermões -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8" id="sermons-grid">
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
                            class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 h-full flex flex-col border-2 border-transparent group-hover:border-yellow-200">

                            <!-- Image/Media Section -->
                            <div class="relative h-64 overflow-hidden flex-shrink-0">
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
                                            <div class="absolute top-4 left-4 z-10 flex flex-wrap gap-2">
                                                <?php if ($hasAudio): ?>
                                                    <span
                                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg backdrop-blur-sm">
                                                        <i class="fas fa-headphones mr-1.5 text-xs"></i>
                                                        ÁUDIO
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ($hasVideo): ?>
                                                    <span
                                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-red-500 to-red-600 shadow-lg backdrop-blur-sm">
                                                        <i class="fas fa-video mr-1.5 text-xs"></i>
                                                        VÍDEO
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ($hasTranscript): ?>
                                                    <span
                                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-500 to-purple-600 shadow-lg backdrop-blur-sm">
                                                        <i class="fas fa-file-alt mr-1.5 text-xs"></i>
                                                        PDF
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Date Badge -->
                                            <?php if (!empty($sermao['data'])): ?>
                                                <div class="absolute bottom-4 right-4 z-10">
                                                    <div
                                                        class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg text-center p-3 border border-white/20 min-w-16">
                                                        <div class="text-yellow-600 font-black text-2xl leading-none">
                                                            <?php echo date("d", strtotime($sermao['data'])); ?>
                                                        </div>
                                                        <div class="text-gray-700 font-bold text-xs uppercase tracking-wider">
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
                                            <div class="relative z-10 text-center p-6">
                                                <i class="fas fa-bible text-white text-5xl mb-4"></i>
                                                <h3 class="text-white font-bold text-lg line-clamp-2">
                                                    <?php echo htmlspecialchars($sermao['titulo']); ?>
                                                </h3>
                                            </div>
                                        </div>

                                        <!-- Media Type Badges on placeholder -->
                                        <div class="absolute top-4 left-4 z-10 flex flex-wrap gap-2">
                                            <?php if ($hasAudio): ?>
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg backdrop-blur-sm">
                                                    <i class="fas fa-headphones mr-1.5 text-xs"></i>
                                                    ÁUDIO
                                                </span>
                                            <?php endif; ?>
                                            <?php if ($hasVideo): ?>
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-red-500 to-red-600 shadow-lg backdrop-blur-sm">
                                                    <i class="fas fa-video mr-1.5 text-xs"></i>
                                                    VÍDEO
                                                </span>
                                            <?php endif; ?>
                                            <?php if ($hasTranscript): ?>
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold text-white bg-gradient-to-r from-purple-500 to-purple-600 shadow-lg backdrop-blur-sm">
                                                    <i class="fas fa-file-alt mr-1.5 text-xs"></i>
                                                    PDF
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Date Badge on placeholder -->
                                        <?php if (!empty($sermao['data'])): ?>
                                            <div class="absolute bottom-4 right-4 z-10">
                                                <div
                                                    class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg text-center p-3 border border-white/20 min-w-16">
                                                    <div class="text-yellow-600 font-black text-2xl leading-none">
                                                        <?php echo date("d", strtotime($sermao['data'])); ?>
                                                    </div>
                                                    <div class="text-gray-700 font-bold text-xs uppercase tracking-wider">
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
                            <div class="p-6 flex-1 flex flex-col">
                                <!-- Title -->
                                <a href="/sermao/<?php echo $sermao['slug']; ?>" class="block group/title mb-4 flex-1">
                                    <h3
                                        class="text-xl font-bold text-gray-900 group-hover/title:text-yellow-600 transition-colors duration-300 line-clamp-2 mb-3">
                                        <?php echo htmlspecialchars($sermao['titulo']); ?>
                                    </h3>

                                    <!-- Description Preview -->
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                                        <?php
                                        $conteudo = strip_tags($sermao['conteudo']);
                                        echo strlen($conteudo) > 100 ? substr($conteudo, 0, 100) . '...' : $conteudo;
                                        ?>
                                    </p>
                                </a>

                                <!-- Sermon Details -->
                                <div class="space-y-3 mb-5">
                                    <!-- Date -->
                                    <?php if (!empty($sermao['data'])): ?>
                                        <div class="flex items-center text-gray-600 group/detail">
                                            <div
                                                class="w-9 h-9 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 group-hover/detail:scale-110 transition-transform duration-300">
                                                <i class="far fa-calendar text-yellow-600 text-sm"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-semibold text-gray-900 truncate">
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
                                                class="w-9 h-9 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 group-hover/detail:scale-110 transition-transform duration-300">
                                                <i class="fas fa-user text-yellow-600 text-sm"></i>
                                            </div>
                                            <span class="font-medium text-gray-900 truncate">
                                                <?php echo htmlspecialchars($sermao['pregador']); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Bible Reference -->
                                    <?php if (!empty($sermao['referencia_biblica'])): ?>
                                        <div class="flex items-center text-gray-600 group/detail">
                                            <div
                                                class="w-9 h-9 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 group-hover/detail:scale-110 transition-transform duration-300">
                                                <i class="fas fa-book text-yellow-600 text-sm"></i>
                                            </div>
                                            <span class="font-medium text-gray-900 truncate">
                                                <?php echo htmlspecialchars($sermao['referencia_biblica']); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    <a href="/sermao/<?php echo $sermao['slug']; ?>"
                                        class="inline-flex items-center justify-between w-full px-4 py-3 bg-gradient-to-r from-yellow-50 to-yellow-100 hover:from-yellow-100 hover:to-yellow-200 text-yellow-700 rounded-xl font-semibold transition-all duration-300 transform hover:scale-[1.02] group/btn shadow-sm hover:shadow"
                                        aria-label="Ver mensagem completa: <?php echo htmlspecialchars($sermao['titulo']); ?>">
                                        <span>Ver Mensagem</span>
                                        <div
                                            class="w-8 h-8 bg-white rounded-lg flex items-center justify-center group-hover/btn:bg-yellow-50 transition-colors">
                                            <i
                                                class="fas fa-arrow-right text-yellow-600 text-sm group-hover/btn:translate-x-1 transition-transform"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State Melhorado -->
                <div class="col-span-full text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="relative inline-block mb-8">
                            <div
                                class="w-32 h-32 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full flex items-center justify-center mx-auto animate-pulse">
                                <i class="fas fa-bible text-yellow-500 text-4xl"></i>
                            </div>
                            <div
                                class="absolute -top-2 -right-2 w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center animate-bounce">
                                <i class="fas fa-plus text-white text-lg"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Nenhuma Mensagem Encontrada</h3>
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                            Não há mensagens disponíveis no momento. Estamos preparando sermões inspiradores para você!
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/contato"
                                class="inline-flex items-center justify-center bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-8 py-3.5 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl group">
                                <i class="fas fa-envelope mr-3 text-lg group-hover:scale-110 transition-transform"></i>
                                Contactar Igreja
                            </a>
                            <a href="/"
                                class="inline-flex items-center justify-center bg-white border-2 border-yellow-200 hover:border-yellow-300 text-yellow-700 px-8 py-3.5 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow group">
                                <i class="fas fa-home mr-3 text-lg group-hover:scale-110 transition-transform"></i>
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
                    b.classList.add('bg-white', 'border-2', 'border-yellow-200', 'text-yellow-700');
                });

                // Add active class to clicked button
                this.classList.add('active');
                this.classList.add('bg-gradient-to-r', 'from-yellow-500', 'to-yellow-600', 'text-white');
                this.classList.remove('bg-white', 'border-2', 'border-yellow-200', 'text-yellow-700');

                const filter = this.textContent.trim();
                let filterType = 'all';

                if (filter.includes('Áudio')) filterType = 'audio';
                else if (filter.includes('Vídeo')) filterType = 'video';
                else if (filter.includes('Transcrições')) filterType = 'pdf';

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

        // Play audio/video on card hover
        const videoElements = document.querySelectorAll('video[autoplay]');
        sermonCards.forEach(card => {
            card.addEventListener('mouseenter', function () {
                const videos = this.querySelectorAll('video[autoplay]');
                videos.forEach(video => video.play());
            });

            card.addEventListener('mouseleave', function () {
                const videos = this.querySelectorAll('video[autoplay]');
                videos.forEach(video => video.pause());
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

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Swiper customization */
    .sermon-swiper {
        border-radius: 16px 16px 0 0;
    }

    .sermon-swiper .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
        width: 8px;
        height: 8px;
        transition: all 0.3s ease;
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
        width: 40px;
        height: 40px;
        border-radius: 50%;
        backdrop-filter: blur(4px);
        transition: all 0.3s ease;
    }

    .sermon-swiper .swiper-button-next:after,
    .sermon-swiper .swiper-button-prev:after {
        font-size: 16px;
        font-weight: bold;
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

    /* Media type badges hover effects */
    .sermon-card:hover .inline-flex {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #fef3c7;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #f59e0b, #d97706);
        border-radius: 5px;
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
        ring: 2px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .text-7xl {
            font-size: 3rem;
        }

        .text-5xl {
            font-size: 2.5rem;
        }

        .sermon-swiper .swiper-button-next,
        .sermon-swiper .swiper-button-prev {
            display: none;
        }

        .flex-col.sm\:flex-row {
            flex-direction: column;
        }

        .sm\:flex-row>* {
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        .grid {
            grid-template-columns: 1fr;
        }

        .text-4xl {
            font-size: 2rem;
        }

        .text-3xl {
            font-size: 1.75rem;
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