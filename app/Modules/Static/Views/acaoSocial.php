<?php
ob_start();
?>

<!-- Page Header com Carrossel -->
<header class="relative h-screen overflow-hidden">
    <!-- Carrossel de Imagens -->
    <div class="relative h-full">
        <div class="swiper carrossel-header h-full">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/acao-social.jpg" alt="Ação social da IMGD - Distribuição de alimentos"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-1.jpg" alt="Construção de moradias para famílias carentes"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-2.jpg" alt="Crianças beneficiadas pelos programas sociais"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-3.jpg" alt="Voluntários da IMGD em ação comunitária"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 5 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-4.jpg" alt="Voluntários da IMGD em ação comunitária"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 6 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-5.jpg" alt="Voluntários da IMGD em ação comunitária"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 7 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-6.jpg" alt="Voluntários da IMGD em ação comunitária"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
            </div>

            <!-- Conteúdo Central Sobreposto -->
            <div class="absolute inset-0 z-20 flex items-center justify-center">
                <div class="text-center text-white px-4 max-w-4xl mx-auto">
                    <!-- Mensagem Principal -->
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                        Ação Social
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Breadcrumb -->
<nav class="bg-gray-50 py-4 border-b border-gray-200" aria-label="Navegação estrutural">
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
                <span class="text-gray-900 font-medium" aria-current="page">Ação Social</span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<main class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">

            <!-- Introdução -->
            <section class="mb-16 text-center" aria-labelledby="introducao-heading">
                <div class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 mx-auto mb-8 rounded-full"></div>
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed max-w-4xl mx-auto">
                    Na <strong class="text-yellow-600">Igreja Ministério da Graça de Deus</strong>, acreditamos que a fé
                    deve ser demonstrada através de ações concretas de amor e serviço à comunidade.
                    Nossos programas sociais refletem o coração de Cristo pelos necessitados.
                </p>
            </section>

            <!-- Nossos Programas -->
            <section class="mb-20" aria-labelledby="programas-heading">
                <h2 id="programas-heading" class="text-3xl md:text-4xl font-bold text-yellow-900 mb-12 text-center">
                    Nossos
                    Programas Sociais</h2>

                <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-8">
                    <!-- Programa 1 -->
                    <div
                        class="bg-white rounded-2xl p-6 border border-yellow-200 hover:shadow-xl transition-all duration-300 group">
                        <div
                            class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-child text-yellow-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Apoio a Órfãos</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Fornecemos suporte integral a crianças órfãs, incluindo educação, alimentação,
                            cuidados de saúde e apoio psicológico.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Bolsas de estudo
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Acompanhamento nutricional
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Apoio psicológico
                            </li>
                        </ul>
                    </div>

                    <!-- Programa 2 -->
                    <div
                        class="bg-white rounded-2xl p-6 border border-yellow-200 hover:shadow-xl transition-all duration-300 group">
                        <div
                            class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-female text-yellow-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Apoio a Viúvas</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Programas de capacitação e apoio emocional para viúvas, ajudando-as a reconstruir
                            suas vidas com dignidade e esperança.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Cursos profissionalizantes
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Apoio emocional
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Microcrédito
                            </li>
                        </ul>
                    </div>

                    <!-- Programa 3 -->
                    <div
                        class="bg-white rounded-2xl p-6 border border-yellow-200 hover:shadow-xl transition-all duration-300 group">
                        <div
                            class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-home text-yellow-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Construção de Moradias</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Projetos de construção e reforma de habitações para famílias em situação de
                            vulnerabilidade social.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Construção de casas
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Reformas estruturais
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Melhorias habitacionais
                            </li>
                        </ul>
                    </div>

                    <!-- Programa 4 -->
                    <div
                        class="bg-white rounded-2xl p-6 border border-yellow-200 hover:shadow-xl transition-all duration-300 group">
                        <div
                            class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-utensils text-yellow-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Distribuição de Alimentos</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Campanhas regulares de distribuição de cestas básicas e refeições para
                            famílias carentes da comunidade.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Cestas básicas mensais
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Refeições comunitárias
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-yellow-500 mr-2 text-xs"></i>
                                Sopão solidário
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Vídeos -->
            <section class="mb-20" aria-labelledby="videos-heading">
                <h2 id="videos-heading" class="text-3xl md:text-4xl font-bold text-yellow-900 mb-12 text-center">Nossas
                    Ações em Vídeo</h2>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Vídeo 1 -->
                    <div
                        class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="relative bg-gray-900">
                            <iframe class="inset-0 w-full h-full" src="https://www.youtube.com/embed/TbaYRuHpqUY" title="APÓSTOLO JEQUE PARTICIPANDO NAS OBRAS DE CARIDADE
                                SCOAN – NIGÉRIA - IMGD" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2">APÓSTOLO JEQUE PARTICIPANDO NAS OBRAS DE CARIDADE
                                SCOAN – NIGÉRIA</h3>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                <span>15 Dez 2024</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vídeo 2 -->
                    <div
                        class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="relative bg-gray-900">
                            <iframe class="inset-0 w-full h-full" src="https://www.youtube.com/embed/_F6vlxreJhg"
                                title="OBRA DE CARIDADE - Executada Pela IMGD - IMGD" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2">OBRA DE CARIDADE - Executada Pela IMGD</h3>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                <span>10 Nov 2024</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vídeo 3 -->
                    <div
                        class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="relative bg-gray-900">
                            <iframe class="inset-0 w-full h-full" src="https://www.youtube.com/embed/LZMTZfBh28k"
                                title="QUE TUDO SEJA FEITO COM AMOR - IMGD Caridade - IMGD" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2">QUE TUDO SEJA FEITO COM AMOR - IMGD Caridade</h3>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                <span>05 Out 2024</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vídeo 4 -->
                    <div
                        class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="relative bg-gray-900">
                            <iframe class="inset-0 w-full h-full" src="https://www.youtube.com/embed/WohPC_G6n1Y" title="O AMOR - Cinco crianças órfãs recebem nova casa da
                                IMGD, habitação no distrito de Boane (TVM) - IMGD" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2">O AMOR - Cinco crianças órfãs recebem nova casa da
                                IMGD, habitação no distrito de Boane (TVM)</h3>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                <span>20 Set 2024</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vídeo 5 -->
                    <div
                        class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="relative bg-gray-900">
                            <iframe class="inset-0 w-full h-full" src="https://www.youtube.com/embed/NVu2iuckVtI" title="CASAS CONSTRUÍDAS A FAVOR DOS NECESSITADOS - Na
                                Liderança do Apóstolo Jeque - IMGD" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2">CASAS CONSTRUÍDAS A FAVOR DOS NECESSITADOS - Na
                                Liderança do Apóstolo Jeque</h3>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                <span>15 Ago 2024</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vídeo 6 -->
                    <div
                        class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="relative bg-gray-900">
                            <iframe class="inset-0 w-full h-full" src="https://www.youtube.com/embed/SULOlzzRUAY"
                                title="OBRAS DE CARIDADE LEVADA ACABO PELA IMGD E APÓSTOLO JEQUE - IMGD" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2">OBRAS DE CARIDADE LEVADA ACABO PELA IMGD E APÓSTOLO
                                JEQUE</h3>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                <span>10 Jul 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botão Ver Mais -->
                <div class="text-center mt-8">
                    <a href="https://www.youtube.com/@imgdvideos" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center justify-center bg-yellow-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-yellow-700 transition-colors duration-200">
                        <i class="fab fa-youtube mr-2"></i>
                        Ver Canal no YouTube
                    </a>
                </div>
            </section>

            <!-- Como Ajudar -->
            <section class="mb-20" aria-labelledby="ajudar-heading">
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-2xl p-8 border border-yellow-200">
                    <h2 id="ajudar-heading" class="text-3xl md:text-4xl font-bold text-yellow-900 mb-8 text-center">Como
                        Você Pode Ajudar</h2>

                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="text-center p-6">
                            <div
                                class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-hand-holding-usd text-yellow-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-3">Doações Financeiras</h3>
                            <p class="text-gray-600 text-sm">
                                Sua contribuição financeira ajuda a manter nossos programas sociais e alcançar mais
                                pessoas.
                            </p>
                        </div>

                        <div class="text-center p-6">
                            <div
                                class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-box text-yellow-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-3">Doações de Materiais</h3>
                            <p class="text-gray-600 text-sm">
                                Alimentos, roupas, materiais de construção e outros itens são sempre bem-vindos.
                            </p>
                        </div>

                        <div class="text-center p-6">
                            <div
                                class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-yellow-600"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-3">Voluntariado</h3>
                            <p class="text-gray-600 text-sm">
                                Doe seu tempo e talento participando das nossas ações sociais como voluntário.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Call to Action -->
            <section
                class="bg-gradient-to-br from-yellow-600 via-yellow-500 to-yellow-700 rounded-3xl p-10 text-center text-white shadow-2xl"
                aria-labelledby="cta-heading">
                <div class="max-w-2xl mx-auto">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-6">
                        <i class="fas fa-hands-helping text-2xl text-yellow-700"></i>
                    </div>
                    <h3 id="cta-heading" class="text-3xl md:text-4xl font-bold mb-4">Junte-se a Esta Causa</h3>
                    <p class="text-xl mb-8 text-yellow-100 leading-relaxed">
                        Sua ajuda pode transformar vidas e fazer a diferença na nossa comunidade.
                        Seja parte desta missão de amor e compaixão.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="/contacto"
                            class="inline-flex items-center justify-center bg-white text-yellow-700 px-8 py-4 rounded-xl font-semibold hover:bg-gray-50 hover:shadow-lg transition-all duration-300 group">
                            <i class="fas fa-hand-holding-heart mr-3 group-hover:scale-110 transition-transform"></i>
                            Quero Ajudar
                        </a>
                        <a href="/sobre-imgd"
                            class="inline-flex items-center justify-center bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-yellow-900 hover:shadow-lg transition-all duration-300 group">
                            <i class="fas fa-info-circle mr-3 group-hover:scale-110 transition-transform"></i>
                            Conheça a IMGD
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>


<!-- Inicialização do Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.carrossel-header', {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
        });
    });
</script>

<style>
    /* Estilos personalizados para o carrossel do header */
    .carrossel-header .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
        width: 12px;
        height: 12px;
        margin: 0 8px !important;
    }

    .carrossel-header .swiper-pagination-bullet-active {
        background: #f59e0b;
        opacity: 1;
        transform: scale(1.2);
    }

    .carrossel-header .swiper-button-next,
    .carrossel-header .swiper-button-prev {
        color: white;
        background: rgba(255, 255, 255, 0.1);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .carrossel-header .swiper-button-next:hover,
    .carrossel-header .swiper-button-prev:hover {
        background: rgba(245, 158, 11, 0.8);
        transform: scale(1.1);
    }

    .carrossel-header .swiper-button-next:after,
    .carrossel-header .swiper-button-prev:after {
        font-size: 24px;
        font-weight: bold;
    }

    /* Animações para o conteúdo */
    .text-center h1 {
        animation: fadeInUp 1s ease-out;
    }

    .text-center p {
        animation: fadeInUp 1s ease-out 0.3s both;
    }

    .text-center .flex {
        animation: fadeInUp 1s ease-out 0.6s both;
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

    /* Efeito de brilho no texto */
    .text-center h1 {
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .text-center h1 {
            font-size: 3rem !important;
        }

        .text-center p {
            font-size: 1.25rem !important;
        }

        .carrossel-header .swiper-button-next,
        .carrossel-header .swiper-button-prev {
            width: 40px;
            height: 40px;
        }

        .carrossel-header .swiper-button-next:after,
        .carrossel-header .swiper-button-prev:after {
            font-size: 18px;
        }
    }

    /* Efeito de parallax suave */
    .swiper-slide img {
        transition: transform 10s ease;
    }

    .swiper-slide-active img {
        transform: scale(1.1);
    }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout_public.php";
?>