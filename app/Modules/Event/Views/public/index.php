<?php
ob_start();
?>

<!-- Page Header -->
<section class="relative bg-gradient-to-br from-yellow-900 via-yellow-800 to-yellow-700 py-20 text-white">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">Eventos</h1>
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
                <span class="text-gray-900 font-medium">Eventos</span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 mx-auto mb-6 rounded-full"></div>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Confira os eventos recentes e futuros da nossa igreja. Junte-se a nós para momentos de fé,
                comunhão e transformação.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            <?php if (!empty($eventos)): ?>
                <?php foreach ($eventos as $evento): ?>
                    <?php
                    $dataInicio = new DateTime($evento['data_inicio']);
                    $dataFim = !empty($evento['data_fim']) ? new DateTime($evento['data_fim']) : null;
                    $isToday = $dataInicio->format('Y-m-d') === date('Y-m-d');
                    $isUpcoming = $dataInicio > new DateTime();

                    // Gerar slug se não existir
                    if (!isset($evento['slug']) || empty($evento['slug'])) {
                        $evento['slug'] = generateSlug($evento['titulo']);
                    }
                    ?>

                    <div
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2">
                        <!-- Image Slider -->
                        <div class="relative h-64 overflow-hidden">
                            <?php if (!empty($evento['midias'])): ?>
                                <a href="/evento/<?php echo $evento['slug']; ?>">
                                    <div class="swiper event-swiper h-full">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($evento['midias'] as $midia): ?>
                                                <?php if ($midia['tipo_arquivo'] === 'imagem'): ?>
                                                    <div class="swiper-slide">
                                                        <img src="/<?php echo $midia['caminho_arquivo']; ?>"
                                                            alt="<?php echo htmlspecialchars($evento['titulo']); ?>"
                                                            class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105">
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- Pagination -->
                                        <div class="swiper-pagination"></div>

                                        <!-- Badge de data -->
                                        <div class="absolute top-4 left-4 z-10">
                                            <div
                                                class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg text-center p-3 border border-white/20">
                                                <div class="text-yellow-600 font-bold text-xl leading-none">
                                                    <?php echo $dataInicio->format("d"); ?>
                                                </div>
                                                <div class="text-gray-700 font-semibold text-sm uppercase tracking-wide">
                                                    <?php echo $dataInicio->format("M"); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status badge -->
                                        <div class="absolute top-4 right-4 z-10">
                                            <?php if ($isToday): ?>
                                                <span
                                                    class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                                    Hoje
                                                </span>
                                            <?php elseif ($isUpcoming): ?>
                                                <span
                                                    class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                                    Em Breve
                                                </span>
                                            <?php else: ?>
                                                <span
                                                    class="bg-gray-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                                    Realizado
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Placeholder quando não há imagens -->
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
                                        <i class="fas fa-calendar text-white text-4xl"></i>
                                    </div>
                                    <div class="absolute top-4 left-4 z-10">
                                        <div
                                            class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg text-center p-3 border border-white/20">
                                            <div class="text-yellow-600 font-bold text-xl leading-none">
                                                <?php echo $dataInicio->format("d"); ?>
                                            </div>
                                            <div class="text-gray-700 font-semibold text-sm uppercase tracking-wide">
                                                <?php echo $dataInicio->format("M"); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Overlay gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </a>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <a href="/evento/<?php echo $evento['slug']; ?>" class="block group/title mb-4">
                                <h3
                                    class="text-xl font-bold text-gray-900 group-hover/title:text-yellow-600 transition-colors duration-300 line-clamp-2">
                                    <?php echo htmlspecialchars($evento['titulo']); ?>
                                </h3>
                            </a>

                            <!-- Event details -->
                            <div class="space-y-3 mb-4">
                                <div class="flex items-center text-gray-600 group/detail">
                                    <div
                                        class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 group-hover/detail:scale-110 transition-transform">
                                        <i class="fas fa-calendar text-yellow-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">
                                            <?php echo $dataInicio->format("d \\d\\e F \\d\\e Y"); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center text-gray-600 group/detail">
                                    <div
                                        class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 group-hover/detail:scale-110 transition-transform">
                                        <i class="fas fa-map-marker-alt text-yellow-600 text-sm"></i>
                                    </div>
                                    <span
                                        class="font-medium text-gray-900"><?php echo htmlspecialchars($evento['local']); ?></span>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6 line-clamp-3">
                                <?php
                                $descricao = strip_tags($evento['descricao']);
                                echo strlen($descricao) > 120 ? substr($descricao, 0, 120) . '...' : $descricao;
                                ?>
                            </p>

                            <!-- Action buttons -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <a href="/evento/<?php echo $evento['slug']; ?>"
                                    class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-semibold transition-colors duration-300 group/btn">
                                    <span>Ver evento completo</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 text-sm group-hover/btn:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty state -->
                <div class="col-span-full text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-calendar-times text-yellow-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Nenhum Evento Disponível</h3>
                        <p class="text-gray-600 mb-6">
                            Não há eventos programados no momento. Fique atento para futuras atualizações!
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
    // Initialize Swiper for event image sliders
    document.addEventListener('DOMContentLoaded', function () {
        const eventSwipers = document.querySelectorAll('.event-swiper');

        eventSwipers.forEach(swiperEl => {
            new Swiper(swiperEl, {
                loop: true,
                autoplay: {
                    delay: 4000,
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
    /* Custom styles for events page */
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
    .event-swiper .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
        width: 8px;
        height: 8px;
    }

    .event-swiper .swiper-pagination-bullet-active {
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
// Função auxiliar para gerar slugs (fora do contexto de objeto)
function generateSlug($string)
{
    $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $string), '-'));
    return $slug;
}

$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout_public.php";
?>