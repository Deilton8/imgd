<!-- Biografia do Apóstolo Jeque -->
<section class="py-20 bg-white relative" aria-label="Biografia do Apóstolo Jeque">
    <div class="w-full relative z-10">
        <div class="flex flex-col lg:flex-row relative overflow-hidden">

            <!-- Gradiente de transição entre imagem e conteúdo -->
            <div class="absolute left-2/5 top-0 bottom-0 w-12 z-10 hidden lg:block">
                <div class="w-full h-full bg-gradient-to-r from-transparent via-white/80 to-white"></div>
            </div>

            <!-- Lado Esquerdo - Imagem -->
            <div class="lg:w-2/5 relative">
                <div class="h-64 lg:h-full relative">
                    <img src="/assets/img/bioAp.jpg"
                        alt="Apóstolo Jeque - Fundador da Igreja Ministério da Graça de Deus"
                        class="w-full h-full object-cover" loading="lazy">

                    <!-- Gradiente interno na imagem para transição suave -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-black/10 via-transparent to-transparent lg:bg-gradient-to-r lg:from-transparent lg:via-white/10 lg:to-white/30">
                    </div>

                    <!-- Conteúdo sobreposto na imagem -->
                    <div class="absolute bottom-6 left-6 right-6 text-white bg-black/20 p-4 rounded-lg">
                        <h4 class="font-semibold text-yellow-200 text-lg mb-1">Fundador e Líder Espiritual</h4>
                        <span class="text-white font-bold text-2xl block mb-2">Apóstolo Jeque</span>
                        <div class="text-yellow-100 text-sm">
                            <p>Agostinho Justino Jeque</p>
                            <p>Ministério da Graça de Deus</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lado Direito - Biografia -->
            <div class="lg:w-3/5 p-8 md:p-12 lg:px-16 relative">
                <!-- Gradiente lateral esquerdo para transição suave -->
                <div class="absolute left-0 top-0 bottom-0 w-6 bg-gradient-to-r from-white to-transparent"></div>

                <div class="relative z-10">
                    <!-- Título da Biografia -->
                    <h2 class="text-3xl md:text-4xl font-bold text-yellow-900 mb-6 text-center">
                        Trajetória de Fé e Serviço
                    </h2>

                    <!-- Texto da Biografia -->
                    <div class="text-gray-700 leading-relaxed space-y-4">
                        <p class="text-lg">
                            <strong class="text-yellow-600">Agostinho Justino Jeque</strong> nasceu em Maputo,
                            a 31 de outubro de 1963, crescendo numa família humilde onde desde cedo
                            demonstrou determinação e obediência.
                        </p>

                        <p class="text-lg">
                            Sua jornada espiritual teve início em 1998, quando começou a buscar
                            entendimento das escrituras sagradas. Em 2007, recebeu sua salvação
                            espiritual através do Profeta TB Joshua na Igreja de Todas as Nações
                            (SCOAN), em Lagos, Nigéria.
                        </p>

                        <p class="text-lg">
                            No mesmo ano, com recursos provenientes do seu trabalho como camionista,
                            construiu a <strong class="text-yellow-600">Igreja Ministério da Graça de Deus</strong>,
                            anexada à sua residência, iniciando assim um ministério marcado por
                            milagres, curas e libertações espirituais.
                        </p>

                        <div
                            class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-4 my-6 rounded-r-lg">
                            <p class="text-yellow-700 italic font-medium">
                                "Através dos ensinamentos da Bíblia e da natureza espiritual de Deus,
                                ocorrem diariamente milagres e curas que transformam vidas."
                            </p>
                        </div>
                    </div>

                    <!-- Marcos Importantes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8">
                        <div class="flex items-center gap-3 text-gray-700 bg-white rounded-lg p-3">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-day text-yellow-600 text-sm"></i>
                            </div>
                            <span><strong>2007</strong> - Fundação do Ministério</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700 bg-white rounded-lg p-3">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-church text-yellow-600 text-sm"></i>
                            </div>
                            <span><strong>SCOAN</strong> - Salvação espiritual</span>
                        </div>
                    </div>

                    <!-- Chamada para ação -->
                    <div
                        class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between pt-6 border-t border-yellow-300">
                        <a href="/apostolo-jeque"
                            class="inline-flex items-center gap-3 text-yellow-600 hover:text-yellow-700 font-semibold transition-all duration-200 group/cta mx-auto">
                            <div
                                class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center group-hover/cta:bg-yellow-200 transition-colors">
                                <i
                                    class="fas fa-book-open text-yellow-600 group-hover/cta:scale-110 transition-transform"></i>
                            </div>
                            <span>Conheça a história completa</span>
                            <i
                                class="fas fa-arrow-right text-sm group-hover/cta:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Animações suaves */
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

    .flex.flex-col.lg\:flex-row {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Efeito de brilho suave na imagem */
    .lg\:w-2\/5 img {
        transition: transform 0.5s ease;
    }

    .lg\:w-2\/5:hover img {
        transform: scale(1.02);
    }

    /* Efeitos de hover nos cards de marcos */
    .bg-gray-50 {
        transition: all 0.3s ease;
    }

    .bg-gray-50:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Responsividade */
    @media (max-width: 1024px) {
        .lg\:w-2\/5 {
            height: 300px;
        }

        /* Remove gradientes em mobile */
        .absolute.left-2\/5,
        .absolute.left-0 {
            display: none;
        }
    }

    /* Melhorar a legibilidade do texto sobreposto na imagem */
    @media (max-width: 640px) {
        .absolute.bottom-6 {
            bottom: 1rem;
            left: 1rem;
            right: 1rem;
        }
    }

    /* Efeito de profundidade na sombra */
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Garantir que o conteúdo não fique muito largo em telas muito grandes */
    @media (min-width: 1920px) {
        .lg\:w-2\/5 {
            width: 35%;
        }

        .lg\:w-3\/5 {
            width: 65%;
        }
    }
</style>