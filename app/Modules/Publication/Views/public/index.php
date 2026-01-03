<?php
ob_start();
?>

<!-- Page Header -->
<section class="relative bg-gradient-to-br from-yellow-900 via-yellow-800 to-yellow-700 py-20 text-white">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">Publicações</h1>
        </div>
    </div>
</section>

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
                <span class="text-gray-900 font-medium">Publicações</span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 mx-auto mb-6 rounded-full"></div>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Descubra conteúdos inspiradores que irão fortalecer sua fé e conhecimento bíblico.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            <?php if (!empty($publicacoes)): ?>
                <?php foreach ($publicacoes as $pub): ?>
                    <div
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 border border-gray-100">

                        <!-- Image Slider -->
                        <div class="relative h-64 overflow-hidden">
                            <?php if (!empty($pub['midias'])): ?>
                                <a href="/blog/<?php echo $pub['slug']; ?>">
                                    <div class="swiper publication-swiper h-full">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($pub['midias'] as $midia): ?>
                                                <?php if ($midia['tipo_arquivo'] === 'imagem'): ?>
                                                    <div class="swiper-slide">
                                                        <img src="/<?php echo $midia['caminho_arquivo']; ?>"
                                                            alt="<?php echo htmlspecialchars($pub['titulo']); ?>"
                                                            class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105">
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Pagination -->
                                        <div class="swiper-pagination"></div>

                                        <!-- Category Badge -->
                                        <?php if (!empty($pub['categoria'])): ?>
                                            <div class="absolute top-4 right-4 z-10">
                                                <div class="bg-yellow-500 backdrop-blur-sm text-white px-3 py-2 rounded-xl shadow-lg">
                                                    <span
                                                        class="text-sm font-semibold"><?php echo htmlspecialchars($pub['categoria']); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            <?php else: ?>
                                <!-- Placeholder quando não há imagens -->
                                <a href="/blog/<?php echo $pub['slug']; ?>">
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center relative">
                                        <i class="fas fa-newspaper text-white text-4xl"></i>
                                        <?php if (!empty($pub['categoria'])): ?>
                                            <div class="absolute top-4 right-4 z-10">
                                                <div class="bg-yellow-500 backdrop-blur-sm text-white px-3 py-2 rounded-xl shadow-lg">
                                                    <span
                                                        class="text-sm font-semibold"><?php echo htmlspecialchars($pub['categoria']); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            <?php endif; ?>

                            <!-- Overlay gradient -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <a href="/blog/<?php echo $pub['slug']; ?>" class="block group/title mb-4">
                                <h3
                                    class="text-xl font-bold text-gray-900 group-hover/title:text-yellow-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                    <?php echo htmlspecialchars($pub['titulo']); ?>
                                </h3>
                            </a>

                            <!-- Publication details -->
                            <div class="space-y-3 mb-4">
                                <?php if (!empty($pub['publicado_em'])): ?>
                                    <div class="flex items-center text-gray-600 group/detail">
                                        <div
                                            class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 group-hover/detail:scale-110 transition-transform">
                                            <i class="far fa-calendar text-yellow-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">
                                                <?php echo date("d \\d\\e F \\d\\e Y", strtotime($pub['publicado_em'])); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?php echo date("H:i", strtotime($pub['publicado_em'])); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6 line-clamp-3 text-sm">
                                <?php
                                $conteudo = strip_tags($pub['conteudo']);
                                echo strlen($conteudo) > 120 ? substr($conteudo, 0, 120) . '...' : $conteudo;
                                ?>
                            </p>

                            <!-- Action buttons -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <a href="/blog/<?php echo $pub['slug']; ?>"
                                    class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-semibold transition-colors duration-300 group/btn">
                                    <span>Ver publicação completa</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 text-sm group-hover/btn:translate-x-1 transition-transform"></i>
                                </a>

                                <!-- Reading time estimate -->
                                <div class="flex items-center text-gray-500 text-sm">
                                    <i class="far fa-clock mr-1"></i>
                                    <?php
                                    $wordCount = str_word_count(strip_tags($pub['conteudo']));
                                    $readingTime = ceil($wordCount / 200);
                                    echo $readingTime . ' min de leitura';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty state -->
                <div class="col-span-full text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-newspaper text-yellow-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Nenhuma Publicação Disponível</h3>
                        <p class="text-gray-600 mb-6">
                            Estamos preparando novos conteúdos inspiradores para você. Volte em breve!
                        </p>
                        <a href="/contacto"
                            class="inline-flex items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg group">
                            <i class="fas fa-envelope mr-3 group-hover:scale-110 transition-transform"></i>
                            Contactar a Igreja
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Initialize Swiper for publication image sliders
    document.addEventListener('DOMContentLoaded', function () {
        const publicationSwipers = document.querySelectorAll('.publication-swiper');

        publicationSwipers.forEach(swiperEl => {
            new Swiper(swiperEl, {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
            });
        });
    });
</script>

<style>
    /* Custom styles for publications page */
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
    .publication-swiper .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
        width: 8px;
        height: 8px;
    }

    .publication-swiper .swiper-pagination-bullet-active {
        background: #f59e0b;
        opacity: 1;
        transform: scale(1.2);
    }

    /* Smooth animations */
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

    .grid>div {
        animation: fadeInUp 0.6s ease-out;
    }

    .grid>div:nth-child(1) {
        animation-delay: 0.1s;
    }

    .grid>div:nth-child(2) {
        animation-delay: 0.2s;
    }

    .grid>div:nth-child(3) {
        animation-delay: 0.3s;
    }

    .grid>div:nth-child(4) {
        animation-delay: 0.4s;
    }

    .grid>div:nth-child(5) {
        animation-delay: 0.5s;
    }

    .grid>div:nth-child(6) {
        animation-delay: 0.6s;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .text-4xl {
            font-size: 2rem;
        }

        .text-6xl {
            font-size: 3rem;
        }
    }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout_public.php";
?>