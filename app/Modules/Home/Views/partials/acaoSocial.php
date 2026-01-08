<!-- Carrossel de Transformação -->
<section class="relative h-screen overflow-hidden" aria-label="Carrossel de transformação através da doação">
    <!-- Carrossel de Imagens -->
    <div class="relative h-full">
        <div class="swiper carrossel-transformacao h-full">
            <div class="swiper-wrapper">
                <!-- Slide 0 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/acao-social.jpg" alt="Voluntários ajudando na comunidade"
                            class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                </div>
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-1.jpg" alt="Comunidade unida em oração"
                            class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-2.jpg" alt="Famílias sendo abençoadas"
                            class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-3.jpg" alt="Crianças recebendo apoio"
                            class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-4.jpg" alt="Projetos sociais da igreja"
                            class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                </div>
                <!-- Slide 5 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-5.jpg" alt="Projetos sociais da igreja"
                            class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                </div>
                <!-- Slide 6 -->
                <div class="swiper-slide">
                    <div class="w-full h-full">
                        <img src="/assets/img/doacao-6.jpg" alt="Voluntários ajudando na comunidade"
                            class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conteúdo Central Sobreposto -->
        <div class="absolute inset-0 z-20 flex items-center justify-center">
            <div class="text-center text-white px-4 max-w-4xl mx-auto">
                <!-- Mensagem Principal -->
                <h2 class="text-5xl md:text-5xl lg:text-5xl font-bold mb-6 leading-tight">
                    <span class="block">Dar transforma o nosso destino</span>
                </h2>

                <!-- Botão de Ação -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="/acao-social"
                        class="border-2 border-white hover:bg-yellow-300 hover:text-white text-yellow-300 font-bold py-4 px-8 rounded-full text-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-3 group">
                        Saiba mais sobre Ação Social
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Efeito de Gradiente Inferior -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
</section>

<!-- Inicialização do Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.carrossel-transformacao', {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 3000,
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
    /* Animações para o conteúdo */
    .text-center h2 span {
        animation: fadeInUp 1s ease-out;
    }

    .text-center h2 span:last-child {
        animation-delay: 0.3s;
        animation-fill-mode: both;
    }

    .text-center p {
        animation: fadeInUp 1s ease-out 0.6s both;
    }

    .text-center .flex {
        animation: fadeInUp 1s ease-out 0.9s both;
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
    .text-center h2 {
        text-shadow: 0 8px 8px rgba(0, 0, 0, 0.5);
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .text-center h2 {
            font-size: 2.5rem !important;
        }

        .text-center p {
            font-size: 1.125rem !important;
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