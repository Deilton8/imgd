<?php
ob_start();
?>

<!-- Page Header com Carrossel Aprimorado -->
<header class="relative h-screen overflow-hidden">
    <!-- Carrossel de Imagens -->
    <div class="relative h-full">
        <div class="swiper carrossel-header h-full">
            <div class="swiper-wrapper">
                <?php
                $slides = [
                    [
                        'src' => '/assets/img/acao-social.jpg',
                        'alt' => 'Ação social da IMGD - Distribuição de alimentos',
                        'gradient' => 'from-yellow-600/70 to-amber-700/70'
                    ],
                    [
                        'src' => '/assets/img/doacao-1.jpg',
                        'alt' => 'Construção de moradias para famílias carentes',
                        'gradient' => 'from-yellow-600/70 to-amber-700/70'
                    ],
                    [
                        'src' => '/assets/img/doacao-2.jpg',
                        'alt' => 'Crianças beneficiadas pelos programas sociais',
                        'gradient' => 'from-yellow-600/70 to-amber-700/70'
                    ],
                    [
                        'src' => '/assets/img/doacao-3.jpg',
                        'alt' => 'Voluntários da IMGD em ação comunitária',
                        'gradient' => 'from-yellow-600/70 to-amber-700/70'
                    ],
                    [
                        'src' => '/assets/img/doacao-4.jpg',
                        'alt' => 'Voluntários da IMGD em ação comunitária',
                        'gradient' => 'from-yellow-600/70 to-amber-700/70'
                    ],
                    [
                        'src' => '/assets/img/doacao-5.jpg',
                        'alt' => 'Voluntários da IMGD em ação comunitária',
                        'gradient' => 'from-yellow-600/70 to-amber-700/70'
                    ],
                    [
                        'src' => '/assets/img/doacao-6.jpg',
                        'alt' => 'Voluntários da IMGD em ação comunitária',
                        'gradient' => 'from-yellow-600/70 to-amber-700/70'
                    ]
                ];

                foreach ($slides as $slide):
                    ?>
                    <div class="swiper-slide">
                        <div class="w-full h-full relative">
                            <img src="<?= $slide['src'] ?>" alt="<?= $slide['alt'] ?>"
                                class="w-full h-full object-cover scale-110 animate-zoom">
                            <!-- Gradiente dinâmico -->
                            <div class="absolute inset-0 bg-gradient-to-br <?= $slide['gradient'] ?>"></div>
                            <!-- Overlay texturizado -->
                            <div class="absolute inset-0 bg-noise opacity-10"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Conteúdo Central Aprimorado -->
            <div class="absolute inset-0 z-20 flex items-center justify-center">
                <div class="text-center text-white px-4 max-w-5xl mx-auto">
                    <!-- Badge de Missão -->
                    <div
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6 animate-fade-in">
                        <i class="fas fa-hands-heart text-yellow-300"></i>
                        <span class="text-sm font-semibold">Transformando Vidas com Amor</span>
                    </div>

                    <!-- Título com gradiente -->
                    <h1
                        class="text-5xl md:text-7xl lg:text-8xl font-bold mb-4 leading-tight bg-gradient-to-r from-yellow-300 via-white to-yellow-100 bg-clip-text text-transparent animate-title-slide">
                        Ação Social
                    </h1>

                    <!-- Subtítulo -->
                    <p
                        class="text-xl md:text-2xl text-yellow-100 mb-8 max-w-2xl mx-auto font-light animate-subtitle-slide">
                        Transformando vidas através do amor e compaixão cristã
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<main id="conteudo" class="py-16 bg-gradient-to-b from-white to-yellow-50/30">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">

            <!-- Introdução Aprimorada -->
            <section class="mb-20 text-center" aria-labelledby="introducao-heading">
                <div class="relative mb-10">
                    <!-- Elemento decorativo -->
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <div
                            class="w-32 h-32 bg-gradient-to-br from-yellow-200/20 to-yellow-300/10 rounded-full blur-xl">
                        </div>
                    </div>

                    <div class="w-20 h-1 bg-gradient-to-r from-yellow-400 to-yellow-500 mx-auto mb-6 rounded-full">
                    </div>

                    <div class="relative bg-white rounded-2xl p-8 md:p-12 shadow-lg border border-yellow-100">
                        <!-- Ícone decorativo -->
                        <div class="absolute -top-5 left-1/2 transform -translate-x-1/2">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-heart text-white"></i>
                            </div>
                        </div>

                        <p class="text-lg md:text-xl text-gray-700 leading-relaxed max-w-4xl mx-auto">
                            Na <strong class="relative text-yellow-700">
                                <span class="relative z-10">Igreja Ministério da Graça de Deus</span>
                                <span
                                    class="absolute bottom-0 left-0 w-full h-2 bg-yellow-200/50 -rotate-1 -z-10"></span>
                            </strong>, acreditamos que a fé deve ser demonstrada através de ações concretas de amor e
                            serviço à comunidade. Nossos programas sociais são expressões tangíveis do coração de Cristo
                            pelos necessitados.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Nossos Programas - Design Card Aprimorado -->
            <section class="mb-24" aria-labelledby="programas-heading">
                <div class="text-center mb-14">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-yellow-400 to-transparent"></div>
                        <span class="text-yellow-600 font-semibold uppercase tracking-wider text-sm">Nossas
                            Iniciativas</span>
                        <div class="w-12 h-0.5 bg-gradient-to-r from-transparent via-yellow-400 to-transparent"></div>
                    </div>
                    <h2 id="programas-heading" class="text-4xl md:text-5xl font-bold text-yellow-900 mb-4">
                        Programas <span class="text-yellow-600">Sociais</span>
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Cada programa é cuidadosamente planejado para oferecer suporte integral e transformador
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <?php
                    $programas = [
                        [
                            'icon' => 'fas fa-child',
                            'title' => 'Apoio a Órfãos',
                            'desc' => 'Fornecemos suporte integral a crianças órfãs, incluindo educação, alimentação, cuidados de saúde e apoio psicológico.',
                            'items' => ['Bolsas de estudo', 'Acompanhamento nutricional', 'Apoio psicológico', 'Atividades recreativas'],
                            'color' => 'yellow'
                        ],
                        [
                            'icon' => 'fas fa-female',
                            'title' => 'Apoio a Viúvas',
                            'desc' => 'Programas de capacitação e apoio emocional para viúvas, ajudando-as a reconstruir suas vidas com dignidade e esperança.',
                            'items' => ['Cursos profissionalizantes', 'Apoio emocional', 'Microcrédito', 'Rede de apoio'],
                            'color' => 'amber'
                        ],
                        [
                            'icon' => 'fas fa-home',
                            'title' => 'Construção de Moradias',
                            'desc' => 'Projetos de construção e reforma de habitações para famílias em situação de vulnerabilidade social.',
                            'items' => ['Construção de casas', 'Reformas estruturais', 'Melhorias habitacionais', 'Mobília básica'],
                            'color' => 'orange'
                        ],
                        [
                            'icon' => 'fas fa-utensils',
                            'title' => 'Distribuição de Alimentos',
                            'desc' => 'Campanhas regulares de distribuição de cestas básicas e refeições para famílias carentes da comunidade.',
                            'items' => ['Cestas básicas mensais', 'Refeições comunitárias', 'Sopão solidário', 'Kits higiene'],
                            'color' => 'yellow'
                        ]
                    ];

                    foreach ($programas as $programa):
                        $colors = [
                            'yellow' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600', 'border' => 'border-yellow-200', 'hover' => 'hover:border-yellow-300'],
                            'amber' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-200', 'hover' => 'hover:border-amber-300'],
                            'orange' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600', 'border' => 'border-orange-200', 'hover' => 'hover:border-orange-300']
                        ];
                        $color = $colors[$programa['color']];
                        ?>
                        <div class="group relative">
                            <!-- Card -->
                            <div
                                class="h-full bg-white rounded-2xl p-7 border-2 <?= $color['border'] ?> <?= $color['hover'] ?> hover:shadow-2xl transition-all duration-500 overflow-hidden relative z-10">
                                <!-- Efeito de brilho hover -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-transparent via-white/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                </div>

                                <!-- Ícone com efeito -->
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 <?= $color['bg'] ?> rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 <?= $color['bg'] ?> rounded-2xl blur-md opacity-50">
                                        </div>
                                        <i
                                            class="<?= $programa['icon'] ?> <?= $color['text'] ?> text-2xl relative z-10"></i>
                                    </div>
                                    <!-- Número decorativo -->
                                    <div
                                        class="absolute -top-2 -right-2 w-8 h-8 bg-white border-2 <?= $color['border'] ?> rounded-full flex items-center justify-center">
                                        <span class="text-xs font-bold <?= $color['text'] ?>">+</span>
                                    </div>
                                </div>

                                <h3 class="text-2xl font-bold text-gray-900 mb-4"><?= $programa['title'] ?></h3>
                                <p class="text-gray-600 leading-relaxed mb-6">
                                    <?= $programa['desc'] ?>
                                </p>

                                <ul class="space-y-3">
                                    <?php foreach ($programa['items'] as $item): ?>
                                        <li class="flex items-center text-gray-700 group/item">
                                            <div
                                                class="w-6 h-6 flex items-center justify-center <?= $color['bg'] ?> rounded-full mr-3 group-hover/item:scale-110 transition-transform">
                                                <i class="fas fa-check <?= $color['text'] ?> text-xs"></i>
                                            </div>
                                            <span class="font-medium"><?= $item ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Sombra expandida no hover -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-yellow-100/50 to-transparent rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Vídeos - Grid Aprimorado -->
            <section class="mb-24" aria-labelledby="videos-heading">
                <div class="text-center mb-14">
                    <h2 id="videos-heading" class="text-4xl md:text-5xl font-bold text-yellow-900 mb-6">
                        Nossas Ações <span class="text-yellow-600">em Vídeo</span>
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Veja o impacto real das nossas iniciativas através dos registros em vídeo
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    <?php
                    $videos = [
                        [
                            'id' => 'TbaYRuHpqUY',
                            'title' => 'APÓSTOLO JEQUE PARTICIPANDO NAS OBRAS DE CARIDADE SCOAN – NIGÉRIA',
                            'date' => '15 Dez 2024'
                        ],
                        [
                            'id' => '_F6vlxreJhg',
                            'title' => 'OBRA DE CARIDADE - Executada Pela IMGD',
                            'date' => '10 Nov 2024'
                        ],
                        [
                            'id' => 'LZMTZfBh28k',
                            'title' => 'QUE TUDO SEJA FEITO COM AMOR - IMGD Caridade',
                            'date' => '05 Out 2024'
                        ],
                        [
                            'id' => 'WohPC_G6n1Y',
                            'title' => 'O AMOR - Cinco crianças órfãs recebem nova casa da IMGD',
                            'date' => '20 Set 2024'
                        ],
                        [
                            'id' => 'NVu2iuckVtI',
                            'title' => 'CASAS CONSTRUÍDAS A FAVOR DOS NECESSITADOS',
                            'date' => '15 Ago 2024'
                        ],
                        [
                            'id' => 'SULOlzzRUAY',
                            'title' => 'OBRAS DE CARIDADE LEVADA ACABO PELA IMGD E APÓSTOLO JEQUE',
                            'date' => '10 Jul 2024'
                        ]
                    ];

                    foreach ($videos as $video):
                        ?>
                        <div class="group">
                            <div
                                class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                                <!-- Iframe do YouTube normal -->
                                <div class="aspect-video bg-gray-900">
                                    <iframe 
                                        class="w-full h-full"
                                        src="https://www.youtube.com/embed/<?= $video['id'] ?>?rel=0&modestbranding=1"
                                        title="<?= htmlspecialchars($video['title']) ?>" 
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        loading="lazy">
                                    </iframe>
                                </div>

                                <div class="p-5">
                                    <h3 class="font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-yellow-700 transition-colors">
                                        <?= $video['title'] ?>
                                    </h3>
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day mr-2 text-yellow-500"></i>
                                            <span><?= $video['date'] ?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fab fa-youtube mr-1 text-red-500"></i>
                                            <span>YouTube</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Botão Ver Mais Aprimorado -->
                <div class="text-center">
                    <a href="https://www.youtube.com/@imgdvideos" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-red-600 to-red-500 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl hover:shadow-red-200 hover:gap-4 transition-all duration-300 group">
                        <div class="w-8 h-8 flex items-center justify-center bg-white/20 rounded-full">
                            <i class="fab fa-youtube text-lg"></i>
                        </div>
                        <span>Inscreva-se no Canal</span>
                        <i
                            class="fas fa-external-link-alt text-sm"></i>
                    </a>
                </div>
            </section>

            <!-- Como Ajudar - Cards Interativos -->
            <section class="mb-24" aria-labelledby="ajudar-heading">
                <div
                    class="bg-gradient-to-br from-white via-yellow-50 to-amber-50 rounded-3xl p-10 border border-yellow-200 shadow-xl">
                    <div class="text-center mb-12">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full mb-6 shadow-lg">
                            <i class="fas fa-hands-helping text-white text-2xl"></i>
                        </div>
                        <h2 id="ajudar-heading" class="text-4xl md:text-5xl font-bold text-yellow-900 mb-4">
                            Como <span class="text-yellow-600">Você Pode Ajudar</span>
                        </h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">
                            Existem várias maneiras de fazer parte desta missão de transformação social
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <?php
                        $formasAjudar = [
                            [
                                'icon' => 'fas fa-hand-holding-usd',
                                'title' => 'Doações Financeiras',
                                'desc' => 'Sua contribuição financeira ajuda a manter nossos programas sociais e alcançar mais pessoas necessitadas.',
                                'details' => ['Transferência bancária', 'Tranferências mobile', 'Doação recorrente', 'Campanhas especiais'],
                                'color' => 'from-green-500 to-emerald-600'
                            ],
                            [
                                'icon' => 'fas fa-box',
                                'title' => 'Doações de Materiais',
                                'desc' => 'Alimentos, roupas, materiais de construção e outros itens são essenciais para nossas ações.',
                                'details' => ['Cestas básicas', 'Roupas e calçados', 'Materiais construção', 'Produtos higiene'],
                                'color' => 'from-blue-500 to-cyan-600'
                            ],
                            [
                                'icon' => 'fas fa-users',
                                'title' => 'Voluntariado',
                                'desc' => 'Doe seu tempo e talento participando ativamente das nossas ações sociais como voluntário.',
                                'details' => ['Ações comunitárias', 'Capacitação', 'Eventos especiais', 'Suporte administrativo'],
                                'color' => 'from-purple-500 to-violet-600'
                            ]
                        ];

                        foreach ($formasAjudar as $ajuda):
                            ?>
                            <div class="group relative">
                                <div
                                    class="h-full bg-white rounded-2xl p-8 border-2 border-gray-100 hover:border-transparent hover:shadow-2xl transition-all duration-500 overflow-hidden">
                                    <!-- Fundo gradiente no hover -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br <?= $ajuda['color'] ?> opacity-0 group-hover:opacity-5 transition-opacity duration-500">
                                    </div>

                                    <!-- Ícone -->
                                    <div class="relative mb-6">
                                        <div
                                            class="w-14 h-14 bg-gradient-to-br <?= $ajuda['color'] ?> rounded-xl flex items-center justify-center text-white text-xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                                            <i class="<?= $ajuda['icon'] ?>"></i>
                                        </div>
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">
                                        <?= $ajuda['title'] ?>
                                    </h3>
                                    <p class="text-gray-600 mb-6 leading-relaxed">
                                        <?= $ajuda['desc'] ?>
                                    </p>

                                    <!-- Lista de detalhes -->
                                    <ul class="mb-8 space-y-2">
                                        <?php foreach ($ajuda['details'] as $detail): ?>
                                            <li class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-circle text-yellow-400 text-xs mr-3"></i>
                                                <?= $detail ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- Call to Action Aprimorado -->
            <section class="relative overflow-hidden rounded-3xl" aria-labelledby="cta-heading">
                <!-- Background com gradiente animado -->
                <div
                    class="absolute inset-0 bg-gradient-to-br from-yellow-500 via-yellow-600 to-amber-700 animate-gradient">
                </div>

                <!-- Pattern overlay -->
                <div class="absolute inset-0 bg-hero-pattern opacity-5"></div>

                <!-- Elementos decorativos -->
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl"></div>

                <!-- Conteúdo -->
                <div class="relative z-10 p-12 md:p-16 text-center text-white">
                    <!-- Ícone animado -->
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-8 animate-pulse-slow">
                        <i class="fas fa-hand-holding-heart text-3xl text-white"></i>
                    </div>

                    <h2 id="cta-heading" class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                        Faça Parte Desta <span class="text-yellow-200">Transformação</span>
                    </h2>

                    <p class="text-xl text-yellow-100 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Sua ajuda pode transformar vidas e fazer a diferença na nossa comunidade. Seja parte desta
                        missão de amor e compaixão que ultrapassa fronteiras.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="/contacto"
                            class="group inline-flex items-center justify-center gap-3 bg-white text-yellow-700 px-10 py-4 rounded-xl font-bold hover:shadow-2xl hover:scale-105 transition-all duration-300 shadow-lg">
                            <i
                                class="fas fa-hands-holding-child text-xl group-hover:scale-110 transition-transform"></i>
                            <span>Quero Ajudar Agora</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="/sobre-imgd"
                            class="group inline-flex items-center justify-center gap-3 bg-transparent border-2 border-white/50 text-white px-10 py-4 rounded-xl font-bold hover:bg-white/10 hover:border-white hover:backdrop-blur-sm transition-all duration-300">
                            <i class="fas fa-church text-xl"></i>
                            <span>Conheça a IMGD</span>
                        </a>
                    </div>

                    <!-- Informação adicional -->
                    <div class="mt-12 pt-8 border-t border-white/20">
                        <p class="text-yellow-200/80 text-sm">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Todas as doações são fiscalizadas e aplicadas integralmente em projetos sociais
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Scripts e Estilos Aprimorados -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicialização do Swiper com mais configurações
        const headerSwiper = new Swiper('.carrossel-header', {
            loop: true,
            speed: 1200,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },
            on: {
                init: function () {
                    // Adiciona classe active ao slide inicial
                    this.slides[this.activeIndex].classList.add('active');
                },
                slideChange: function () {
                    // Remove classe active de todos os slides
                    this.slides.forEach(slide => slide.classList.remove('active'));
                    // Adiciona classe active ao slide atual
                    this.slides[this.activeIndex].classList.add('active');
                }
            }
        });

        // Smooth scroll para o conteúdo
        document.querySelector('a[href="#conteudo"]')?.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector('#conteudo').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

        // Animações de entrada
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in-view');
                }
            });
        }, observerOptions);

        // Observar elementos para animação
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    });
</script>

<style>
    /* Animações CSS personalizadas */
    @keyframes gradient {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    @keyframes titleSlide {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
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

    @keyframes pulseSlow {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.8;
            transform: scale(1.05);
        }
    }

    @keyframes zoom {
        from {
            transform: scale(1);
        }

        to {
            transform: scale(1.1);
        }
    }

    /* Aplicação de animações */
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
    }

    .animate-title-slide {
        animation: titleSlide 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .animate-subtitle-slide {
        animation: fadeInUp 1s ease-out 0.3s both;
    }

    .animate-fade-in {
        animation: fadeInUp 0.8s ease-out 0.5s both;
    }

    .animate-pulse-slow {
        animation: pulseSlow 3s ease-in-out infinite;
    }

    .animate-zoom {
        animation: zoom 20s linear infinite alternate;
    }

    /* Classes utilitárias */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .bg-noise {
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='1' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100' height='100' filter='url(%23noiseFilter)' opacity='0.1'/%3E%3C/svg%3E");
    }

    .bg-hero-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Estilos do Swiper aprimorados */
    .carrossel-header .swiper-pagination {
        position: absolute;
        bottom: 60px !important;
    }

    .carrossel-header .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 1;
        margin: 0 6px !important;
        transition: all 0.3s ease;
    }

    .carrossel-header .swiper-pagination-bullet-active {
        background: #fbbf24;
        width: 30px;
        border-radius: 10px;
        transform: scale(1);
    }

    /* Efeitos de hover aprimorados */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Responsividade aprimorada */
    @media (max-width: 768px) {
        .text-center h1 {
            font-size: 3.5rem !important;
        }

        .text-center .text-xl {
            font-size: 1.125rem !important;
        }

        section {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .grid {
            gap: 1.5rem;
        }
    }

    @media (max-width: 640px) {
        .text-center h1 {
            font-size: 2.75rem !important;
        }

        .flex-col .gap-4 {
            gap: 0.75rem;
        }
    }

    /* Acessibilidade - Foco aprimorado */
    a:focus,
    button:focus {
        outline: 2px solid #f59e0b;
        outline-offset: 2px;
    }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout_public.php";
?>