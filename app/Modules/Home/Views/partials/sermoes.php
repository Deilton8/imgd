<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-yellow-900 mb-8">Mensagens Recentes</h2>
            <div class="w-20 h-1 bg-yellow-600 mx-auto mt-8 rounded-full"></div>
        </div>

        <!-- Sermons Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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

                    $sermaoSlug = $sermao['slug'];
                    $sermaoTitulo = htmlspecialchars($sermao['titulo']);
                    $sermaoConteudo = strip_tags($sermao['conteudo']);
                    ?>

                    <div class="sermon-card group relative" style="animation-delay: <?php echo ($index * 0.1); ?>s;">

                        <!-- Card Container -->
                        <div
                            class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 h-full flex flex-col border-2 border-transparent group-hover:border-yellow-200">

                            <!-- Image/Media Section -->
                            <div class="relative h-64 overflow-hidden flex-shrink-0">
                                <?php if ($hasImages): ?>
                                    <a href="/sermao/<?= $sermaoSlug ?>" class="block h-full"
                                        aria-label="Ver mensagem completa: <?= $sermaoTitulo ?>">
                                        <div class="swiper sermon-swiper h-full">
                                            <div class="swiper-wrapper">
                                                <?php foreach ($sermao['midias'] as $midia): ?>
                                                    <?php if ($midia['tipo_arquivo'] === 'imagem'): ?>
                                                        <div class="swiper-slide">
                                                            <img src="/<?= $midia['caminho_arquivo'] ?>" alt="<?= $sermaoTitulo ?>"
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
                                                            <?= date("d", strtotime($sermao['data'])) ?>
                                                        </div>
                                                        <div class="text-gray-700 font-bold text-xs uppercase tracking-wider">
                                                            <?= date("M", strtotime($sermao['data'])) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <!-- Placeholder com gradiente animado -->
                                    <a href="/sermao/<?= $sermaoSlug ?>" class="block h-full">
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 flex items-center justify-center relative overflow-hidden">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent animate-shimmer">
                                            </div>
                                            <div class="relative z-10 text-center p-6">
                                                <i class="fas fa-bible text-white text-5xl mb-4"></i>
                                                <h3 class="text-white font-bold text-lg line-clamp-2">
                                                    <?= $sermaoTitulo ?>
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
                                                        <?= date("d", strtotime($sermao['data'])) ?>
                                                    </div>
                                                    <div class="text-gray-700 font-bold text-xs uppercase tracking-wider">
                                                        <?= date("M", strtotime($sermao['data'])) ?>
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
                                <a href="/sermao/<?= $sermaoSlug ?>" class="block group/title mb-4 flex-1">
                                    <h3
                                        class="text-xl font-bold text-gray-900 group-hover/title:text-yellow-600 transition-colors duration-300 line-clamp-2 mb-3">
                                        <?= $sermaoTitulo ?>
                                    </h3>

                                    <!-- Description Preview -->
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">
                                        <?php
                                        echo strlen($sermaoConteudo) > 100 ? substr($sermaoConteudo, 0, 100) . '...' : $sermaoConteudo;
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
                                                    <?= date("d/m/Y", strtotime($sermao['data'])) ?>
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    <?= date("l", strtotime($sermao['data'])) ?>
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
                                                <?= htmlspecialchars($sermao['pregador']) ?>
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
                                                <?= htmlspecialchars($sermao['referencia_biblica']) ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    <a href="/sermao/<?= $sermaoSlug ?>"
                                        class="inline-flex items-center justify-between w-full px-4 py-3 bg-gradient-to-r from-yellow-50 to-yellow-100 hover:from-yellow-100 hover:to-yellow-200 text-yellow-700 rounded-xl font-semibold transition-all duration-300 transform hover:scale-[1.02] group/btn shadow-sm hover:shadow"
                                        aria-label="Ver mensagem completa: <?= $sermaoTitulo ?>">
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
                <!-- Empty State -->
                <div class="col-span-3 text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-bible text-6xl text-gray-300 mb-6"></i>
                        <h3 class="text-2xl font-semibold text-gray-600 mb-3">Nenhuma mensagem disponível</h3>
                        <p class="text-gray-500 text-lg mb-6">Em breve teremos novas pregações para sua edificação.</p>
                        <a href="/sermoes"
                            class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                            Ver arquivo de mensagens
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- View All Button -->
        <?php if (!empty($sermoes)): ?>
            <div class="text-center mt-12">
                <a href="/sermoes"
                    class="inline-flex items-center px-8 py-4 bg-yellow-600 text-white font-semibold rounded-xl hover:bg-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    Ver todas as mensagens
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .swiper-container {
        position: relative;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: white;
        background: rgba(0, 0, 0, 0.5);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        backdrop-filter: blur(4px);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 16px;
    }

    .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
    }

    .swiper-pagination-bullet-active {
        background: #f59e0b;
        opacity: 1;
    }

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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Swiper
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
    });
</script>