<?php
ob_start();
?>

<!-- Page Header com Carrossel (estilo igual ao apostoloJeque.php) -->
<header class="relative h-screen overflow-hidden">
    <!-- Carrossel de Imagens -->
    <div class="relative h-full">
        <div class="swiper carrossel-imgd h-full">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img loading="lazy" src="/assets/img/imgd.jpeg" alt="Comunidade da IMGD em culto"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img loading="lazy" src="/assets/img/ap-1.jpg" alt="Comunidade da IMGD em adoração"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img loading="lazy" src="/assets/img/ap-3.jpg" alt="Comunidade da IMGD reunida"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img loading="lazy" src="/assets/img/ap-4.jpg" alt="Momentos de louvor na IMGD"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conteúdo Central Sobreposto -->
        <div class="absolute inset-0 z-20 flex items-center justify-center">
            <div class="text-center text-white px-4 max-w-4xl mx-auto">
                <!-- Mensagem Principal -->
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                    Igreja Ministério da Graça de Deus
                </h1>
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
                <span class="text-gray-900 font-medium" aria-current="page">Sobre a IMGD</span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<main class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">

            <!-- Introdução -->
            <section class="mb-20 text-center" aria-labelledby="introducao-heading">
                <div class="max-w-4xl mx-auto">
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 mx-auto mb-8 rounded-full">
                    </div>
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                        A <strong class="text-yellow-600">Igreja Ministério da Graça de Deus</strong>, localizada na
                        <strong>Av. Joaquim Chissano, nº 58, Bairro da Matola H, Matola, Moçambique</strong>,
                        é uma comunidade cristã vibrante dedicada à pregação do Evangelho e à transformação de vidas
                        através do amor de Jesus Cristo.
                    </p>
                </div>
            </section>

            <!-- História da Fundação -->
            <section id="historia" class="mb-20" aria-labelledby="historia-heading">
                <div class="max-w-7xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-stretch">

                        <!-- Card do Fundador -->
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl min-h-[500px]">
                            <!-- Imagem de Fundo -->
                            <div class="absolute inset-0">
                                <img loading="lazy" src="/assets/img/bioAp.jpg" alt="Apóstolo Agostinho Justino Jeque"
                                    class="w-full h-full object-cover">
                                <!-- Overlay gradiente para legibilidade -->
                                <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/60">
                                </div>
                            </div>

                            <!-- Conteúdo sobreposto -->
                            <div class="relative z-10 p-8 h-full flex flex-col justify-center items-center text-center">

                                <!-- Informações -->
                                <h3 class="text-2xl lg:text-3xl font-bold text-white mb-2">Fundador</h3>
                                <p class="text-xl lg:text-2xl text-yellow-300 font-semibold mb-3">Apóstolo Agostinho
                                    Justino Jeque</p>
                                <p class=" text-yellow-100 text-lg mb-8">Pregador fiel da Palavra de Deus</p>

                                <!-- Elementos decorativos -->
                                <div class="flex justify-center space-x-6 mb-8">
                                    <div
                                        class="text-center bg-white/10 rounded-xl p-4 border border-white/20 min-w-[100px]">
                                        <div class="text-white font-bold text-2xl">2007</div>
                                        <div class="text-yellow-200 text-sm mt-1">Fundação</div>
                                    </div>
                                    <div
                                        class="text-center bg-white/10 rounded-xl p-4 border border-white/20 min-w-[100px]">
                                        <div class="text-white font-bold text-2xl">SCOAN</div>
                                        <div class="text-yellow-200 text-sm mt-1">Libertação</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Texto da História -->
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl min-h-[500px]">
                            <!-- Imagem de Fundo -->
                            <div class="absolute inset-0">
                                <img loading="lazy" src="/assets/img/imgd.jpeg"
                                    alt="História da IMGD - Comunidade em culto" class="w-full h-full object-cover">
                                <!-- Overlay gradiente para legibilidade -->
                                <div class="absolute inset-0 bg-gradient-to-br from-black/30 via-black/10 to-black/30">
                                </div>
                            </div>

                            <!-- Conteúdo sobreposto -->
                            <div class="relative z-10 p-8 lg:p-12 h-full flex flex-col justify-center">
                                <h2 id="historia-heading"
                                    class="text-3xl md:text-4xl font-bold mb-6 text-center text-white">
                                    Nossa História
                                </h2>

                                <div
                                    class="mx-auto mb-8 w-32 h-1 bg-gradient-to-r from-transparent via-yellow-400 to-transparent rounded-full">
                                </div>

                                <div class="space-y-6 leading-relaxed text-lg text-white">
                                    <div
                                        class="flex items-start gap-4 p-4 bg-white/10 rounded-xl border border-white/20 hover:bg-white/15 transition-all duration-300 group">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center mt-1 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-cross text-yellow-300 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="">
                                                A igreja foi fundada pelo <strong class="text-yellow-300">Apóstolo
                                                    Agostinho Justino Jeque</strong>,
                                                após sua libertação e transformação de vida na <strong
                                                    class="text-yellow-300">Sinagoga Igreja de Todas as Nações
                                                    (SCOAN)</strong>,
                                                onde Deus usou poderosamente o <strong class="text-yellow-300">Profeta
                                                    T.B. Joshua</strong> para restaurar e direcionar o seu chamado
                                                ministerial.
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start gap-4 p-4 bg-white/10 rounded-xl border border-white/20 hover:bg-white/15 transition-all duration-300 group">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center mt-1 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-seedling text-yellow-300 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="">
                                                Esta experiência marcante de libertação e encontro com Deus tornou-se o
                                                alicerce sobre o qual
                                                o Apóstolo Jeque construiu um ministério dedicado à pregação fiel da
                                                Palavra de Deus e à
                                                transformação de vidas através do poder do Evangelho.
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start gap-4 p-4 bg-white/10 rounded-xl border border-white/20 hover:bg-white/15 transition-all duration-300 group">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center mt-1 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-church text-yellow-300 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="">
                                                Desde a sua fundação, o Apóstolo Jeque tem se dedicado incansavelmente
                                                ao ministério,
                                                sendo um pregador fiel da Palavra de Deus e comprometido com a
                                                edificação da fé cristã
                                                genuína em Moçambique.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Marcos importantes -->
                                <div class="grid grid-cols-2 gap-4 mt-8 pt-8 border-t border-yellow-600/50">
                                    <div
                                        class="text-center bg-white/10 rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                        <div class="text-yellow-300 font-bold text-2xl">+15</div>
                                        <div class="text-yellow-200 text-sm">Anos de Ministério</div>
                                    </div>
                                    <div
                                        class="text-center bg-white/10 rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300">
                                        <div class="text-yellow-300 font-bold text-2xl">+1000</div>
                                        <div class="text-yellow-200 text-sm">Vidas Transformadas</div>
                                    </div>
                                </div>

                                <!-- Elemento decorativo adicional -->
                                <div class="text-center mt-6">
                                    <div class="inline-flex items-center text-yellow-200 text-sm">
                                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                                        <span>Desde 2007 servindo a comunidade moçambicana</span>
                                        <i class="fas fa-star text-yellow-400 ml-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Missão e Visão -->
            <section class="mb-20" aria-labelledby="missao-visao-heading">
                <div class="text-center mb-16">
                    <h2 id="missao-visao-heading"
                        class="text-4xl md:text-5xl font-bold text-yellow-900 mb-4 text-center">
                        Missão e Visão
                    </h2>
                    <div class="mx-auto mt-6 w-32 h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent">
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Missão -->
                    <div class="group relative">
                        <div
                            class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full">
                            <div class="text-center mb-8">
                                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900">Nossa Missão</h3>
                            </div>

                            <div class="space-y-4 text-gray-700 leading-relaxed text-lg">
                                <p>
                                    <strong class="text-yellow-700">Proclamar o Evangelho de Jesus Cristo</strong>,
                                    fazer discípulos de todas as nações,
                                    batizando-os em nome do Pai, do Filho e do Espírito Santo, e ensinando-os a obedecer
                                    a tudo o que Cristo ordenou.
                                </p>
                                <p>
                                    Buscamos viver em <strong class="text-yellow-700">amor e comunhão</strong>, servindo
                                    à comunidade e ao próximo com
                                    dedicação e compaixão.
                                </p>
                            </div>

                            <!-- Ações Sociais -->
                            <div class="mt-8 p-6 bg-white border-t-2 border-yellow-200">
                                <h4 class="font-bold text-yellow-700 mb-4 flex items-center text-lg">
                                    <i class="fas fa-hands-helping mr-3"></i>
                                    Acções Sociais
                                </h4>
                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-heart text-yellow-500 mr-2"></i>
                                        Auxílio a órfãos e viúvas
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-home text-yellow-500 mr-2"></i>
                                        Construção de moradias
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-balance-scale text-yellow-500 mr-2"></i>
                                        Justiça social
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-shield-alt text-yellow-500 mr-2"></i>
                                        Defesa dos oprimidos
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visão -->
                    <div class="group relative">
                        <div
                            class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full">
                            <div class="text-center mb-8">
                                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900">Nossa Visão</h3>
                            </div>

                            <p class="text-gray-700 mb-8 text-center text-lg">
                                Ser uma comunidade cristã vibrante e acolhedora, comprometida com a
                                <strong class="text-amber-700">transformação integral de vidas</strong> através do amor
                                de Cristo.
                            </p>

                            <div class="space-y-4">
                                <div
                                    class="flex items-start gap-4 p-4 bg-white rounded-xl border-t-2 border-amber-200 transition-colors duration-300 group/item">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center group-hover/item:scale-110 transition-transform duration-300">
                                        <i class="fas fa-seedling text-amber-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 mb-2">Crescimento Espiritual</h4>
                                        <p class="text-gray-600">Promover um ambiente onde cada membro possa aprofundar
                                            seu relacionamento com Deus</p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-start gap-4 p-4 bg-white rounded-xl border-t-2 border-amber-200 transition-colors duration-300 group/item">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center group-hover/item:scale-110 transition-transform duration-300">
                                        <i class="fas fa-hands-helping text-amber-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 mb-2">Impacto Comunitário</h4>
                                        <p class="text-gray-600">Estar activamente envolvidos na comunidade local como
                                            agentes de mudança positiva</p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-start gap-4 p-4 bg-white rounded-xl border-t-2 border-amber-200 transition-colors duration-300 group/item">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center group-hover/item:scale-110 transition-transform duration-300">
                                        <i class="fas fa-users text-amber-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 mb-2">Formação de Líderes</h4>
                                        <p class="text-gray-600">Capacitar líderes que influenciem a sociedade com
                                            valores do Reino de Deus</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Localização -->
            <section aria-labelledby="localizacao-heading">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 id="localizacao-heading" class="text-4xl md:text-5xl font-bold text-yellow-900 mb-4">
                            Nossa Localização
                        </h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Venha nos visitar e fazer parte da nossa família espiritual. Estamos localizados na Avenida
                            Joaquim Chissano, facilmente acessível de qualquer ponto
                            da Matola
                        </p>
                        <div
                            class="mx-auto mt-6 w-32 h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent">
                        </div>
                    </div>
                    <div class="rounded-xl overflow-hidden h-96">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3569.706080704633!2d32.46518553243779!3d-25.924982648049895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ee68fa9b6a8f893%3A0x82df5cea77af3550!2sIgreja%20Minist%C3%A9rio%20Da%20Gra%C3%A7a%20de%20Deus%20(IMGD)!5e0!3m2!1spt-PT!2smz!4v1755854650257!5m2!1spt-PT!2smz"
                            class="w-full h-full border-0" allowfullscreen loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Localização da Igreja Ministério da Graça de Deus">
                        </iframe>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Inicialização do Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.carrossel-imgd', {
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
    /* Estilos personalizados para o carrossel da IMGD */
    .carrossel-imgd .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
        width: 12px;
        height: 12px;
        margin: 0 8px !important;
    }

    .carrossel-imgd .swiper-pagination-bullet-active {
        background: #f59e0b;
        opacity: 1;
        transform: scale(1.2);
    }

    .carrossel-imgd .swiper-button-next,
    .carrossel-imgd .swiper-button-prev {
        color: white;
        background: rgba(255, 255, 255, 0.1);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .carrossel-imgd .swiper-button-next:hover,
    .carrossel-imgd .swiper-button-prev:hover {
        background: rgba(245, 158, 11, 0.8);
        transform: scale(1.1);
    }

    .carrossel-imgd .swiper-button-next:after,
    .carrossel-imgd .swiper-button-prev:after {
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

        .carrossel-imgd .swiper-button-next,
        .carrossel-imgd .swiper-button-prev {
            width: 40px;
            height: 40px;
        }

        .carrossel-imgd .swiper-button-next:after,
        .carrossel-imgd .swiper-button-prev:after {
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