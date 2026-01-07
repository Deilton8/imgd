<?php
ob_start();
?>

<!-- Page Header com Carrossel Otimizado -->
<header class="relative h-screen overflow-hidden" role="banner" aria-label="Carrossel do Apóstolo Jeque">
    <!-- Carrossel de Imagens Otimizado -->
    <div class="relative h-full" role="region" aria-label="Galeria de imagens">
        <div class="swiper carrossel-apostolo h-full">
            <div class="swiper-wrapper">
                <!-- Slides otimizados com descrições mais específicas -->
                <?php
                $slides = [
                    [
                        'src' => '/assets/img/bioAp.jpg',
                        'alt' => 'Retrato oficial do Apóstolo Agostinho Justino Jeque',
                        'desc' => 'Retrato oficial'
                    ],
                    [
                        'src' => '/assets/img/ap-1.jpg',
                        'alt' => 'Apóstolo Jeque pregando durante culto na IMGD',
                        'desc' => 'Ministrando a palavra'
                    ],
                    [
                        'src' => '/assets/img/ap-2.jpg',
                        'alt' => 'Apóstolo Jeque em momento de oração e ensino bíblico',
                        'desc' => 'Momento de oração'
                    ],
                    [
                        'src' => '/assets/img/ap-3.jpg',
                        'alt' => 'Apóstolo Jeque distribuindo alimentos em ação comunitária',
                        'desc' => 'Ação social'
                    ],
                    [
                        'src' => '/assets/img/ap-4.jpg',
                        'alt' => 'Apóstolo Jeque com liderança da igreja IMGD',
                        'desc' => 'Com liderança'
                    ],
                    [
                        'src' => '/assets/img/ap-5.jpg',
                        'alt' => 'Apóstolo Jeque abençoando membros da congregação',
                        'desc' => 'Abençoando membros'
                    ]
                ];

                foreach ($slides as $index => $slide):
                    ?>
                    <div class="swiper-slide" role="group" aria-label="Slide <?= $index + 1 ?> de <?= count($slides) ?>">
                        <div class="w-full h-full relative">
                            <!-- Imagem otimizada com lazy loading -->
                            <img loading="lazy" src="<?= htmlspecialchars($slide['src']) ?>"
                                alt="<?= htmlspecialchars($slide['alt']) ?>" class="w-full h-full object-cover" width="1920"
                                height="1080" data-swiper-parallax="20%">
                            <!-- Overlay gradiente otimizado -->
                            <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/40 to-transparent"></div>
                            <!-- Indicador de slide para screen readers -->
                            <span class="sr-only"><?= $slide['desc'] ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Paginação melhorada -->
            <div class="swiper-pagination" role="navigation" aria-label="Navegação do carrossel"></div>
        </div>
    </div>

    <!-- Conteúdo Central Otimizado -->
    <div class="absolute inset-0 z-20 flex items-center justify-center pointer-events-none">
        <div class="text-center text-white px-4 max-w-4xl mx-auto">
            <!-- Título Principal com animação -->
            <div class="overflow-hidden">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight animate-fade-in-up">
                    Apóstolo Jeque
                </h1>
            </div>

            <!-- Subtítulo -->
            <div class="overflow-hidden">
                <p class="text-xl md:text-2xl text-yellow-100 font-light mb-8 animate-fade-in-up delay-100">
                    Líder espiritual e fundador do Ministério da Graça de Deus
                </p>
            </div>

            <!-- Botão de chamada para ação -->
            <div class="overflow-hidden animate-fade-in-up delay-200">
                <a href="#biografia"
                    class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl pointer-events-auto"
                    aria-label="Conheça a biografia completa do Apóstolo Jeque">
                    Conheça a história
                    <i class="fas fa-arrow-down" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Main Content Otimizado -->
<main class="py-12 md:py-16 bg-white" id="main-content">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">

            <!-- Introdução Melhorada -->
            <section class="mb-16 text-center" aria-labelledby="introducao-heading">
                <div
                    class="w-24 h-1 bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-400 mx-auto mb-8 rounded-full animate-expand">
                </div>
                <h2 id="introducao-heading" class="sr-only">Introdução</h2>
                <div class="max-w-4xl mx-auto">
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed animate-fade-in">
                        Conheça a inspiradora trajetória de <strong class="text-yellow-600 font-bold">Agostinho Justino
                            Jeque</strong>,
                        um homem cuja vida foi transformada pelo poder de Deus e que hoje dedica-se integralmente
                        ao ministério e serviço da comunidade, impactando milhares de vidas em Moçambique.
                    </p>
                </div>
            </section>

            <!-- Biografia Unificada Otimizada -->
            <section class="mb-20 scroll-mt-8" id="biografia" aria-labelledby="biografia-heading" tabindex="-1">
                <div
                    class="relative rounded-2xl lg:rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-shadow duration-500">
                    <!-- Imagem de Fundo Otimizada -->
                    <div class="absolute inset-0">
                        <picture>
                            <source media="(min-width: 1024px)" srcset="/assets/img/bioAp.jpg">
                            <source media="(min-width: 768px)" srcset="/assets/img/bioAp.jpg">
                            <img loading="lazy" src="/assets/img/bioAp.jpg"
                                alt="Apóstolo Agostinho Justino Jeque em seu gabinete"
                                class="w-full h-full object-cover" width="1200" height="800">
                        </picture>
                        <!-- Overlay gradiente melhorado -->
                        <div class="absolute inset-0 bg-gradient-to-br from-black/90 via-black/70 to-black/50"></div>
                    </div>

                    <!-- Conteúdo sobreposto -->
                    <div class="relative z-10 p-6 lg:p-12 xl:p-16">
                        <div class="max-w-6xl mx-auto">
                            <div class="text-center mb-10">
                                <div class="inline-block mb-6">
                                    <h2 id="biografia-heading"
                                        class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                                        Biografia
                                    </h2>
                                    <div
                                        class="w-48 h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent mx-auto rounded-full">
                                    </div>
                                </div>
                                <p class="text-yellow-100 text-lg max-w-2xl mx-auto">
                                    Vida, ministério e legado de um líder comprometido com a transformação espiritual e
                                    social
                                </p>
                            </div>

                            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-start">
                                <!-- Coluna da Esquerda - Card de Perfil -->
                                <div class="text-center lg:text-left animate-fade-in-left">
                                    <div
                                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:border-white/40 transition-all duration-300">
                                        <!-- Avatar -->
                                        <div class="relative w-48 h-48 mx-auto lg:mx-0 mb-6 group">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full blur-lg opacity-30 group-hover:opacity-50 transition-opacity">
                                            </div>
                                            <img loading="lazy" src="/assets/img/bioAp.jpg"
                                                alt="Apóstolo Agostinho Justino Jeque"
                                                class="relative w-48 h-48 object-cover rounded-full border-4 border-white/30 group-hover:border-yellow-500 transition-colors duration-300">
                                        </div>

                                        <h3 class="text-2xl lg:text-3xl font-bold text-white mb-4">Agostinho Justino
                                            Jeque</h3>
                                        <p class="text-yellow-100 text-sm mb-6">Fundador e Líder do Ministério da Graça
                                            de Deus</p>

                                        <!-- Informações Pessoais -->
                                        <div class="space-y-4 text-white/90">
                                            <div
                                                class="flex items-center justify-center lg:justify-start gap-3 p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                                                <i class="fas fa-calendar text-yellow-300 w-5 text-center"
                                                    aria-hidden="true"></i>
                                                <div>
                                                    <span class="text-white font-medium block">Nascimento</span>
                                                    <span>31 de Outubro de 1963</span>
                                                </div>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start gap-3 p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                                                <i class="fas fa-map-marker-alt text-yellow-300 w-5 text-center"
                                                    aria-hidden="true"></i>
                                                <div>
                                                    <span class="text-white font-medium block">Local de
                                                        Nascimento</span>
                                                    <span>Maputo, Moçambique</span>
                                                </div>
                                            </div>
                                            <div
                                                class="flex items-center justify-center lg:justify-start gap-3 p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                                                <i class="fas fa-church text-yellow-300 w-5 text-center"
                                                    aria-hidden="true"></i>
                                                <div>
                                                    <span class="text-white font-medium block">Ministério</span>
                                                    <span>Desde 2007 (17 anos)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Coluna da Direita - Linha do Tempo Biográfica -->
                                <div class="animate-fade-in-right">
                                    <div class="relative">
                                        <!-- Linha vertical -->
                                        <div
                                            class="absolute left-6 top-0 bottom-0 w-0.5 bg-gradient-to-b from-yellow-500/50 via-yellow-500 to-yellow-500/50">
                                        </div>

                                        <div class="space-y-8 ml-12">
                                            <!-- Item 1 -->
                                            <div class="group">
                                                <div class="flex items-start gap-4">
                                                    <div
                                                        class="absolute left-4 w-4 h-4 bg-yellow-500 rounded-full border-4 border-white shadow-lg -translate-x-1/2 group-hover:scale-125 transition-transform duration-300">
                                                    </div>
                                                    <div
                                                        class="bg-white/10 rounded-xl p-5 border border-white/20 hover:border-yellow-500/50 hover:bg-white/15 transition-all duration-300 flex-1">
                                                        <div class="flex items-center gap-3 mb-3">
                                                            <div
                                                                class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                                                <i class="fas fa-baby text-yellow-300"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                            <h3 class="font-semibold text-white text-lg">Nascimento e
                                                                Infância</h3>
                                                        </div>
                                                        <p class="text-white/90 leading-relaxed">
                                                            Nasceu na província de Lourenço Marques, atual <strong
                                                                class="text-white">Maputo</strong>,
                                                            numa família humilde onde desde cedo demonstrou <strong
                                                                class="text-white">obediência e determinação</strong>.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Item 2 -->
                                            <div class="group">
                                                <div class="flex items-start gap-4">
                                                    <div
                                                        class="absolute left-4 w-4 h-4 bg-yellow-500 rounded-full border-4 border-white shadow-lg -translate-x-1/2 group-hover:scale-125 transition-transform duration-300">
                                                    </div>
                                                    <div
                                                        class="bg-white/10 rounded-xl p-5 border border-white/20 hover:border-yellow-500/50 hover:bg-white/15 transition-all duration-300 flex-1">
                                                        <div class="flex items-center gap-3 mb-3">
                                                            <div
                                                                class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                                                <i class="fas fa-graduation-cap text-yellow-300"
                                                                    aria-hidden="true"></i>
                                                            </div>
                                                            <h3 class="font-semibold text-white text-lg">Formação e
                                                                Vocação</h3>
                                                        </div>
                                                        <p class="text-white/90 leading-relaxed">
                                                            Sonhava em formar-se como <strong
                                                                class="text-white">enfermeiro</strong>, demonstrando
                                                            desde cedo
                                                            sua vocação para o <strong class="text-white">cuidado com o
                                                                próximo</strong>.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Citação Inspiradora -->
                                            <div
                                                class="bg-gradient-to-r from-yellow-500/20 to-yellow-600/20 rounded-xl p-5 border border-yellow-300/30 relative overflow-hidden">
                                                <div
                                                    class="absolute -top-10 -right-10 w-20 h-20 bg-yellow-500/10 rounded-full">
                                                </div>
                                                <div class="relative z-10">
                                                    <i class="fas fa-quote-left text-yellow-300 text-xl mb-3"
                                                        aria-hidden="true"></i>
                                                    <blockquote class="text-white italic text-lg leading-relaxed mb-3">
                                                        "Para a solução da vida espiritual dos moçambicanos, forja-se
                                                        como discípulo de Deus
                                                        e demonstra tamanha fé e força espiritual jamais vista até
                                                        hoje."
                                                    </blockquote>
                                                    <div class="w-12 h-0.5 bg-yellow-400 rounded-full"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Trajetória Profissional Otimizada -->
            <section class="mb-20" aria-labelledby="trajetoria-heading">
                <div class="max-w-6xl mx-auto">
                    <!-- Cabeçalho -->
                    <div class="text-center mb-16">
                        <div class="inline-block relative">
                            <h2 id="trajetoria-heading"
                                class="text-4xl md:text-5xl font-bold text-yellow-900 mb-4 relative z-10">
                                Trajetória Profissional
                            </h2>
                            <div class="absolute -bottom-2 left-0 right-0 h-2 bg-yellow-100 rounded-full -z-10"></div>
                        </div>
                        <p class="text-gray-600 text-lg max-w-2xl mx-auto mt-4">
                            Da vida secular ao chamado ministerial: uma jornada de transformação
                        </p>
                        <div
                            class="mx-auto mt-6 w-32 h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent rounded-full">
                        </div>
                    </div>

                    <!-- Timeline Interativa -->
                    <div class="relative">
                        <!-- Linha central responsiva -->
                        <div
                            class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-yellow-400 via-yellow-500 to-yellow-400/30">
                        </div>

                        <div class="space-y-16 lg:space-y-0">
                            <!-- 1990 -->
                            <div class="relative lg:grid lg:grid-cols-2 lg:gap-16 items-center group">
                                <div class="lg:col-start-1 lg:text-right mb-8 lg:mb-0">
                                    <div class="relative">
                                        <!-- Ano decorativo -->
                                        <div
                                            class="absolute -top-6 lg:-top-8 left-0 lg:left-auto lg:right-0 text-7xl font-black text-yellow-50 opacity-20 -z-10">
                                            1990</div>

                                        <div
                                            class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 relative overflow-hidden">
                                            <!-- Efeito de brilho -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-yellow-500/0 via-yellow-500/5 to-yellow-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                            </div>

                                            <!-- Ícone animado -->
                                            <div class="relative z-10 flex flex-col items-center lg:items-end">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                                                    <i class="fas fa-briefcase text-yellow-600 text-2xl"
                                                        aria-hidden="true"></i>
                                                </div>

                                                <div class="text-center lg:text-right">
                                                    <div class="inline-flex items-center gap-2 mb-2">
                                                        <span class="text-yellow-500 font-bold">1990</span>
                                                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                                    </div>
                                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Empreendedor
                                                        Independente</h3>
                                                    <p class="text-gray-600 leading-relaxed">
                                                        Trabalhou como <strong
                                                            class="text-yellow-700 font-semibold">sucateiro, fornecedor
                                                            de tecnologia e vendedor de produtos</strong>,
                                                        desenvolvendo habilidades empreendedoras que seriam fundamentais
                                                        para seu futuro ministério.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Marcador timeline desktop -->
                                <div
                                    class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full border-4 border-white shadow-lg group-hover:scale-125 transition-transform duration-300">
                                    </div>
                                </div>

                                <!-- Marcador timeline mobile -->
                                <div class="lg:hidden absolute left-8 top-0 bottom-0 w-1 bg-yellow-500/30"></div>
                                <div
                                    class="lg:hidden absolute left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 bg-yellow-500 rounded-full border-4 border-white">
                                </div>
                            </div>

                            <!-- 1995 -->
                            <div class="relative lg:grid lg:grid-cols-2 lg:gap-16 items-center group mt-16 lg:mt-0">
                                <div class="lg:col-start-2 mb-8 lg:mb-0">
                                    <div class="relative">
                                        <!-- Ano decorativo -->
                                        <div
                                            class="absolute -top-6 lg:-top-8 right-0 lg:right-auto lg:left-0 text-7xl font-black text-yellow-50 opacity-20 -z-10">
                                            1995</div>

                                        <div
                                            class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 relative overflow-hidden">
                                            <!-- Efeito de brilho -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-yellow-500/0 via-yellow-500/5 to-yellow-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                            </div>

                                            <!-- Ícone animado -->
                                            <div class="relative z-10 flex flex-col items-center lg:items-start">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:-rotate-3 transition-all duration-500">
                                                    <i class="fas fa-truck text-yellow-600 text-2xl"
                                                        aria-hidden="true"></i>
                                                </div>

                                                <div class="text-center lg:text-left">
                                                    <div class="inline-flex items-center gap-2 mb-2">
                                                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                                        <span class="text-yellow-500 font-bold">1995</span>
                                                    </div>
                                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Camionista
                                                        Profissional</h3>
                                                    <p class="text-gray-600 leading-relaxed">
                                                        Contratado como <strong
                                                            class="text-yellow-700 font-semibold">camionista na empresa
                                                            KFC</strong>,
                                                        adquiriu experiência profissional e recursos financeiros que
                                                        possibilitariam a fundação de seu ministério.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Marcador timeline desktop -->
                                <div
                                    class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full border-4 border-white shadow-lg group-hover:scale-125 transition-transform duration-300">
                                    </div>
                                </div>

                                <!-- Marcador timeline mobile -->
                                <div class="lg:hidden absolute left-8 top-0 bottom-0 w-1 bg-yellow-500/30"></div>
                                <div
                                    class="lg:hidden absolute left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 bg-yellow-500 rounded-full border-4 border-white">
                                </div>
                            </div>

                            <!-- 1998 -->
                            <div class="relative lg:grid lg:grid-cols-2 lg:gap-16 items-center group mt-16 lg:mt-0">
                                <div class="lg:col-start-1 lg:text-right mb-8 lg:mb-0">
                                    <div class="relative">
                                        <!-- Ano decorativo -->
                                        <div
                                            class="absolute -top-6 lg:-top-8 left-0 lg:left-auto lg:right-0 text-7xl font-black text-yellow-50 opacity-20 -z-10">
                                            1998</div>

                                        <div
                                            class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 relative overflow-hidden">
                                            <!-- Efeito de brilho -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-yellow-500/0 via-yellow-500/5 to-yellow-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                            </div>

                                            <!-- Ícone animado -->
                                            <div class="relative z-10 flex flex-col items-center lg:items-end">
                                                <div
                                                    class="w-20 h-20 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                                                    <i class="fas fa-bible text-yellow-600 text-2xl"
                                                        aria-hidden="true"></i>
                                                </div>

                                                <div class="text-center lg:text-right">
                                                    <div class="inline-flex items-center gap-2 mb-2">
                                                        <span class="text-yellow-500 font-bold">1998</span>
                                                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                                    </div>
                                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Início da Jornada
                                                        Espiritual</h3>
                                                    <p class="text-gray-600 leading-relaxed">
                                                        Começou o <strong class="text-yellow-700 font-semibold">estudo
                                                            diário da Bíblia Sagrada</strong>,
                                                        buscando sabedoria e entendimento das escrituras, preparando-se
                                                        para o chamado ministerial.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Marcador timeline desktop -->
                                <div
                                    class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full border-4 border-white shadow-lg group-hover:scale-125 transition-transform duration-300">
                                    </div>
                                </div>

                                <!-- Marcador timeline mobile -->
                                <div class="lg:hidden absolute left-8 top-0 bottom-0 w-1 bg-yellow-500/30"></div>
                                <div
                                    class="lg:hidden absolute left-6 top-1/2 transform -translate-y-1/2 w-4 h-4 bg-yellow-500 rounded-full border-4 border-white">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Encontro com Deus Otimizado -->
            <section class="mb-20" aria-labelledby="encontro-heading">
                <div
                    class="relative rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-shadow duration-500">
                    <!-- Background Image Optimized -->
                    <div class="absolute inset-0">
                        <picture>
                            <source media="(min-width: 1024px)" srcset="/assets/img/ap.jpg">
                            <source media="(min-width: 768px)" srcset="/assets/img/ap.jpg">
                            <img loading="lazy" src="/assets/img/ap.jpg"
                                alt="Encontro espiritual transformador do Apóstolo Jeque"
                                class="w-full h-full object-cover scale-105 group-hover:scale-110 transition-transform duration-10000"
                                width="1200" height="600">
                        </picture>
                        <!-- Overlay gradiente -->
                        <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/60 to-black/40"></div>
                    </div>

                    <!-- Conteúdo -->
                    <div class="relative z-10 p-8 lg:p-16">
                        <div class="max-w-6xl mx-auto">
                            <!-- Header Section -->
                            <div class="text-center mb-16">
                                <div class="inline-block mb-6">
                                    <span
                                        class="text-yellow-300 font-semibold text-sm uppercase tracking-wider mb-2 block">Momento
                                        Decisivo</span>
                                    <h2 id="encontro-heading"
                                        class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                                        Encontro Transformador
                                    </h2>
                                </div>
                                <p class="text-yellow-100 text-lg max-w-3xl mx-auto">
                                    O ponto de virada que definiu seu chamado e estabeleceu as bases para o Ministério
                                    da Graça de Deus
                                </p>
                                <div
                                    class="mx-auto mt-6 w-32 h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent rounded-full">
                                </div>
                            </div>

                            <!-- Content Grid -->
                            <div class="grid lg:grid-cols-3 gap-8">
                                <!-- Busca Espiritual -->
                                <div class="group">
                                    <div
                                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:border-yellow-500/50 hover:bg-white/15 transition-all duration-500 h-full">
                                        <div class="relative mb-6">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-yellow-500/20 to-yellow-600/20 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500">
                                                <i class="fas fa-praying-hands text-yellow-300 text-2xl"
                                                    aria-hidden="true"></i>
                                            </div>
                                            <div
                                                class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                                <span class="text-white text-xs font-bold">1</span>
                                            </div>
                                        </div>
                                        <h3 class="text-2xl font-bold text-white mb-4">Busca Espiritual</h3>
                                        <p class="text-yellow-100 leading-relaxed">
                                            Frequentou diversas igrejas em Moçambique e realizou
                                            <strong class="text-white">viagens a Israel</strong> em busca de
                                            profundidade espiritual
                                            e entendimento do seu chamado.
                                        </p>
                                    </div>
                                </div>

                                <!-- Encontro Decisivo -->
                                <div class="group">
                                    <div
                                        class="bg-gradient-to-br from-yellow-500/10 to-yellow-600/10 backdrop-blur-sm rounded-2xl p-8 border border-yellow-300/30 hover:border-yellow-500/50 hover:from-yellow-500/20 hover:to-yellow-600/20 transition-all duration-500 h-full">
                                        <div class="relative mb-6">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-yellow-500/30 to-yellow-600/30 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500">
                                                <i class="fas fa-star text-yellow-300 text-2xl" aria-hidden="true"></i>
                                            </div>
                                            <div
                                                class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                                <span class="text-white text-xs font-bold">2</span>
                                            </div>
                                        </div>
                                        <h3 class="text-2xl font-bold text-white mb-4">Encontro Profético</h3>
                                        <p class="text-yellow-100 leading-relaxed">
                                            Em <strong class="text-white">2007</strong>, recebeu sua salvação espiritual
                                            através do
                                            <strong class="text-white">Profeta T.B. Joshua</strong> na
                                            <strong class="text-white">Sinagoga Igreja de Todas as Nações
                                                (SCOAN)</strong>,
                                            em Lagos, Nigéria.
                                        </p>
                                    </div>
                                </div>

                                <!-- Fundação -->
                                <div class="group">
                                    <div
                                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 hover:border-yellow-500/50 hover:bg-white/15 transition-all duration-500 h-full">
                                        <div class="relative mb-6">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-yellow-500/20 to-yellow-600/20 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500">
                                                <i class="fas fa-church text-yellow-300 text-2xl"
                                                    aria-hidden="true"></i>
                                            </div>
                                            <div
                                                class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                                <span class="text-white text-xs font-bold">3</span>
                                            </div>
                                        </div>
                                        <h3 class="text-2xl font-bold text-white mb-4">Fundação do Ministério</h3>
                                        <p class="text-yellow-100 leading-relaxed">
                                            Com recursos próprios adquiridos como camionista, fundou o
                                            <strong class="text-white">Ministério da Graça de Deus</strong>,
                                            estabelecendo as bases para transformar milhares de vidas.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Citação Central -->
                            <div class="mt-16 text-center">
                                <div class="max-w-3xl mx-auto">
                                    <div class="relative">
                                        <i class="fas fa-quote-right text-yellow-500/20 text-6xl absolute -top-4 -left-4"
                                            aria-hidden="true"></i>
                                        <blockquote class="text-2xl text-white italic leading-relaxed relative z-10">
                                            "O verdadeiro ministério nasce do encontro genuíno com Deus e se expressa no
                                            serviço ao próximo."
                                        </blockquote>
                                        <div class="mt-8 flex items-center justify-center gap-4">
                                            <div class="w-12 h-0.5 bg-yellow-500 rounded-full"></div>
                                            <span class="text-yellow-300 font-semibold">Apóstolo Jeque</span>
                                            <div class="w-12 h-0.5 bg-yellow-500 rounded-full"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Ministério e Impacto Otimizado -->
            <section class="mb-20" aria-labelledby="ministerio-heading">
                <div class="max-w-6xl mx-auto">
                    <!-- Header -->
                    <div class="text-center mb-16">
                        <div class="inline-block relative">
                            <span
                                class="text-yellow-500 font-semibold text-sm uppercase tracking-wider mb-2 block">Atuação
                                Ministerial</span>
                            <h2 id="ministerio-heading"
                                class="text-4xl md:text-5xl font-bold text-yellow-900 mb-4 relative z-10">
                                Ministério e Impacto
                            </h2>
                            <div class="absolute -bottom-2 left-0 right-0 h-2 bg-yellow-100 rounded-full -z-10"></div>
                        </div>
                        <p class="text-gray-600 text-lg max-w-3xl mx-auto mt-4">
                            Transformação espiritual e compromisso social: os pilares do Ministério da Graça de Deus
                        </p>
                        <div
                            class="mx-auto mt-6 w-32 h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent rounded-full">
                        </div>
                    </div>

                    <!-- Cards de Impacto -->
                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Milagres e Curas -->
                        <div class="group">
                            <div
                                class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 h-full relative overflow-hidden">
                                <!-- Elemento decorativo -->
                                <div
                                    class="absolute -right-8 -top-8 w-32 h-32 bg-gradient-to-br from-red-500/5 to-red-600/5 rounded-full blur-2xl">
                                </div>

                                <div class="relative z-10">
                                    <!-- Cabeçalho do Card -->
                                    <div class="flex items-start gap-6 mb-8">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-20 h-20 bg-gradient-to-br from-red-50 to-red-100 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                                                <i class="fas fa-heartbeat text-red-600 text-2xl"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Milagres e
                                                Curas</h3>
                                            <p class="text-gray-500 text-sm">Transformação espiritual através da fé</p>
                                        </div>
                                    </div>

                                    <!-- Conteúdo -->
                                    <div class="space-y-6">
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                                <i class="fas fa-hand-holding-medical text-red-500 text-sm"
                                                    aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 mb-1">Cura Divina</h4>
                                                <p class="text-gray-600">
                                                    Testemunhos diários de cura física e emocional através da
                                                    ministração da palavra.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-4">
                                            <div
                                                class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                                <i class="fas fa-shield-alt text-red-500 text-sm"
                                                    aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 mb-1">Libertação Espiritual</h4>
                                                <p class="text-gray-600">
                                                    Libertação de opressões espirituais e restauração de vidas através
                                                    do poder de Deus.
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Estatística -->
                                        <div class="mt-8 pt-6 border-t border-gray-100">
                                            <div class="flex items-center justify-between">
                                                <span class="text-gray-500 text-sm">Milhares de testemunhos</span>
                                                <span class="text-red-600 font-bold text-lg">+15 anos</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Visão Social -->
                        <div class="group">
                            <div
                                class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-green-200 h-full relative overflow-hidden">
                                <!-- Elemento decorativo -->
                                <div
                                    class="absolute -right-8 -top-8 w-32 h-32 bg-gradient-to-br from-green-500/5 to-green-600/5 rounded-full blur-2xl">
                                </div>

                                <div class="relative z-10">
                                    <!-- Cabeçalho do Card -->
                                    <div class="flex items-start gap-6 mb-8">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-20 h-20 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:-rotate-12 transition-all duration-500">
                                                <i class="fas fa-hands-helping text-green-600 text-2xl"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Visão Social
                                            </h3>
                                            <p class="text-gray-500 text-sm">Compromisso com a transformação comunitária
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Conteúdo -->
                                    <div class="space-y-6">
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                                <i class="fas fa-home text-green-500 text-sm" aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 mb-1">Apoio Familiar</h4>
                                                <p class="text-gray-600">
                                                    Suporte integral a famílias carenciadas, idosos, viúvas e crianças
                                                    órfãs.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-4">
                                            <div
                                                class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                                <i class="fas fa-user-plus text-green-500 text-sm"
                                                    aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 mb-1">Reabilitação Social</h4>
                                                <p class="text-gray-600">
                                                    Programa de recuperação e reinserção social para jovens em situação
                                                    de risco.
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Estatística -->
                                        <div class="mt-8 pt-6 border-t border-gray-100">
                                            <div class="flex items-center justify-between">
                                                <span class="text-gray-500 text-sm">Famílias impactadas</span>
                                                <span class="text-green-600 font-bold text-lg">+500</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Ações de Impacto Social - Otimizada -->
            <section class="mb-20" aria-labelledby="acoes-heading">
                <div class="max-w-6xl mx-auto">
                    <!-- Header -->
                    <div class="text-center mb-12">
                        <h2 id="acoes-heading" class="text-4xl md:text-5xl font-bold text-yellow-900 mb-4">
                            Ações de Impacto Social
                        </h2>
                        <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                            Projetos e iniciativas que transformam vidas e fortalecem comunidades
                        </p>
                        <div
                            class="mx-auto mt-6 w-32 h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent rounded-full">
                        </div>
                    </div>

                    <!-- Grid de Ações -->
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Educação -->
                        <div class="group">
                            <div
                                class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 h-full text-center">
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                        <i class="fas fa-graduation-cap text-yellow-600 text-2xl"
                                            aria-hidden="true"></i>
                                    </div>
                                    <div
                                        class="absolute -top-2 -right-2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <span class="text-white text-sm font-bold">+200</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Educação</h3>
                                <p class="text-gray-600 mb-4">
                                    Pagamento de propinas e material escolar para estudantes carenciados
                                </p>
                                <div
                                    class="w-12 h-1 bg-yellow-500 rounded-full mx-auto group-hover:w-24 transition-all duration-500">
                                </div>
                            </div>
                        </div>

                        <!-- Moradia -->
                        <div class="group">
                            <div
                                class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 h-full text-center">
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:-rotate-6 transition-all duration-500">
                                        <i class="fas fa-home text-yellow-600 text-2xl" aria-hidden="true"></i>
                                    </div>
                                    <div
                                        class="absolute -top-2 -right-2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <span class="text-white text-sm font-bold">+50</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Moradia</h3>
                                <p class="text-gray-600 mb-4">
                                    Construção e reforma de casas para famílias em situação de vulnerabilidade
                                </p>
                                <div
                                    class="w-12 h-1 bg-yellow-500 rounded-full mx-auto group-hover:w-24 transition-all duration-500">
                                </div>
                            </div>
                        </div>

                        <!-- Alimentação -->
                        <div class="group">
                            <div
                                class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 h-full text-center">
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                        <i class="fas fa-utensils text-yellow-600 text-2xl" aria-hidden="true"></i>
                                    </div>
                                    <div
                                        class="absolute -top-2 -right-2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <span class="text-white text-sm font-bold">Mensal</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Alimentação</h3>
                                <p class="text-gray-600 mb-4">
                                    Distribuição mensal de cestas básicas e alimentos para famílias necessitadas
                                </p>
                                <div
                                    class="w-12 h-1 bg-yellow-500 rounded-full mx-auto group-hover:w-24 transition-all duration-500">
                                </div>
                            </div>
                        </div>

                        <!-- Reabilitação -->
                        <div class="group">
                            <div
                                class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 h-full text-center">
                                <div class="relative mb-6">
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:-rotate-6 transition-all duration-500">
                                        <i class="fas fa-heart text-yellow-600 text-2xl" aria-hidden="true"></i>
                                    </div>
                                    <div
                                        class="absolute -top-2 -right-2 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        <span class="text-white text-sm font-bold">+100</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Reabilitação</h3>
                                <p class="text-gray-600 mb-4">
                                    Programa de recuperação e reinserção social para jovens em situação de risco
                                </p>
                                <div
                                    class="w-12 h-1 bg-yellow-500 rounded-full mx-auto group-hover:w-24 transition-all duration-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Video Section Otimizada -->
            <section class="mb-16" aria-labelledby="video-heading">
                <div class="max-w-5xl mx-auto">
                    <div class="text-center mb-8">
                        <h2 id="video-heading" class="text-3xl md:text-4xl font-bold text-yellow-900 mb-4">
                            Mensagem e Ministração
                        </h2>
                        <p class="text-gray-600">Assista ao testemunho e mensagem do Apóstolo Jeque</p>
                        <div
                            class="mx-auto mt-4 w-24 h-1 bg-gradient-to-r from-transparent via-yellow-500 to-transparent rounded-full">
                        </div>
                    </div>

                    <div class="relative rounded-2xl lg:rounded-3xl overflow-hidden shadow-2xl group">
                        <!-- Thumbnail placeholder -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-900 relative">
                            <!-- Botão de play overlay -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center cursor-pointer transform group-hover:scale-110 transition-transform duration-300 shadow-2xl">
                                    <i class="fas fa-play text-white text-2xl ml-1" aria-hidden="true"></i>
                                </div>
                            </div>

                            <!-- Video -->
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/0X5oHZD7YS8"
                                title="Apóstolo Agostinho Justino Jeque - Ministério da Graça de Deus" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen loading="lazy" aria-label="Vídeo do ministério do Apóstolo Jeque">
                            </iframe>
                        </div>

                        <!-- Video info -->
                        <div class="bg-white p-6 border-t border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Ministério da Graça de Deus - Testemunho
                                Completo</h3>
                            <p class="text-gray-600 text-sm">
                                Assista à mensagem inspiradora e ao testemunho do Apóstolo Jeque sobre a fundação e
                                missão do ministério.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Scripts Otimizados -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicialização do Swiper com configurações melhoradas
        const apostoloSwiper = new Swiper('.carrossel-apostolo', {
            // Configurações básicas
            loop: true,
            speed: 800,
            grabCursor: true,
            centeredSlides: true,

            // Autoplay
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            // Efeito de transição
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },

            // Paginação
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
                renderBullet: function (index, className) {
                    return `<span class="${className}" role="button" aria-label="Ir para slide ${index + 1}"></span>`;
                }
            },

            // A11y
            a11y: {
                prevSlideMessage: 'Slide anterior',
                nextSlideMessage: 'Próximo slide',
                firstSlideMessage: 'Este é o primeiro slide',
                lastSlideMessage: 'Este é o último slide',
                paginationBulletMessage: 'Ir para slide {{index}}',
            },

            // Eventos
            on: {
                init: function () {
                    // Inicializar progress bar
                    updateProgressBar(this);
                },
                slideChange: function () {
                    // Atualizar progress bar
                    updateProgressBar(this);
                }
            }
        });

        // Função para atualizar progress bar
        function updateProgressBar(swiper) {
            const progressBar = document.querySelector('.swiper-progress-bar');
            if (progressBar) {
                const progress = ((swiper.activeIndex + 1) / swiper.slides.length) * 100;
                progressBar.style.width = `${progress}%`;
            }
        }

        // Controle de progress bar no autoplay
        let progressInterval;
        function startProgressBar(swiper) {
            clearInterval(progressInterval);
            const progressBar = document.querySelector('.swiper-progress-bar');
            if (!progressBar) return;

            progressBar.style.transition = 'width 5.9s linear';
            progressBar.style.width = '100%';

            progressInterval = setTimeout(() => {
                progressBar.style.transition = 'none';
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.transition = 'width 5.9s linear';
                }, 50);
            }, 5900);
        }

        // Iniciar progress bar
        startProgressBar(apostoloSwiper);

        // Reiniciar progress bar em cada transição
        apostoloSwiper.on('slideChangeTransitionEnd', function () {
            startProgressBar(this);
        });

        // Pausar progress bar ao interagir
        apostoloSwiper.on('touchStart', function () {
            document.querySelector('.swiper-progress-bar').style.transition = 'none';
        });

        apostoloSwiper.on('touchEnd', function () {
            startProgressBar(this);
        });

        // Smooth scroll para âncoras
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Adicionar foco para acessibilidade
                    targetElement.setAttribute('tabindex', '-1');
                    targetElement.focus();

                    // Remover tabindex após o foco
                    setTimeout(() => {
                        targetElement.removeAttribute('tabindex');
                    }, 1000);
                }
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
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observar elementos para animações
        document.querySelectorAll('.animate-fade-in, .animate-fade-in-left, .animate-fade-in-right').forEach(el => {
            observer.observe(el);
        });

        // Lazy loading para iframes
        const videoIframe = document.querySelector('iframe[src*="youtube"]');
        if (videoIframe) {
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    videoIframe.src = videoIframe.dataset.src;
                    observer.unobserve(videoIframe);
                }
            });

            videoIframe.dataset.src = videoIframe.src;
            videoIframe.src = '';
            observer.observe(videoIframe);
        }
    });
</script>

<style>
    /* Variáveis CSS para consistência */
    :root {
        --color-yellow-500: #f59e0b;
        --color-yellow-600: #d97706;
        --transition-default: 300ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Animações CSS personalizadas */
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

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes expand {
        from {
            transform: scaleX(0);
        }

        to {
            transform: scaleX(1);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    /* Classes de animação */
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out both;
    }

    .animate-fade-in-left {
        animation: fadeInLeft 0.8s ease-out both;
    }

    .animate-fade-in-right {
        animation: fadeInRight 0.8s ease-out both;
    }

    .animate-expand {
        animation: expand 0.8s ease-out both;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-in {
        animation-play-state: running;
    }

    /* Delays para animações em sequência */
    .delay-100 {
        animation-delay: 100ms;
    }

    .delay-200 {
        animation-delay: 200ms;
    }

    .delay-300 {
        animation-delay: 300ms;
    }

    /* Estilos do Swiper otimizados */
    .carrossel-apostolo {
        --swiper-pagination-bullet-size: 12px;
        --swiper-pagination-bullet-inactive-color: rgba(255, 255, 255, 0.4);
        --swiper-pagination-bullet-inactive-opacity: 0.6;
        --swiper-pagination-color: #f59e0b;
        --swiper-pagination-bullet-horizontal-gap: 6px;
    }

    .carrossel-apostolo .swiper-pagination-bullet {
        width: var(--swiper-pagination-bullet-size);
        height: var(--swiper-pagination-bullet-size);
        background: var(--swiper-pagination-bullet-inactive-color);
        opacity: var(--swiper-pagination-bullet-inactive-opacity);
        transition: all var(--transition-default);
        margin: 0 var(--swiper-pagination-bullet-horizontal-gap) !important;
    }

    .carrossel-apostolo .swiper-pagination-bullet-active {
        background: var(--swiper-pagination-color);
        opacity: 1;
        transform: scale(1.3);
        box-shadow: 0 0 12px rgba(245, 158, 11, 0.5);
    }

    /* Navegação do carrossel */
    .swiper-carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        color: white;
        z-index: 10;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all var(--transition-default);
        opacity: 0.8;
    }

    .swiper-carousel-nav:hover {
        background: rgba(245, 158, 11, 0.9);
        transform: translateY(-50%) scale(1.1);
        opacity: 1;
        box-shadow: 0 8px 24px rgba(245, 158, 11, 0.3);
    }

    .swiper-carousel-nav:focus {
        outline: 2px solid var(--color-yellow-500);
        outline-offset: 2px;
    }

    .swiper-button-prev {
        left: 24px;
    }

    .swiper-button-next {
        right: 24px;
    }

    /* Progress bar customizada */
    .swiper-progress-bar {
        transition: width 5.9s linear;
        background: linear-gradient(to right, var(--color-yellow-500), var(--color-yellow-600));
    }

    /* Estilos para foco acessível */
    :focus-visible {
        outline: 2px solid var(--color-yellow-500);
        outline-offset: 2px;
        border-radius: 4px;
    }

    /* Melhorias de tipografia */
    h1,
    h2,
    h3,
    h4 {
        line-height: 1.2;
        font-weight: 800;
    }

    /* Responsividade aprimorada */
    @media (max-width: 768px) {

        .carrossel-apostolo .swiper-button-next,
        .carrossel-apostolo .swiper-button-prev {
            width: 44px;
            height: 44px;
            display: none;
            /* Esconder em mobile para melhor UX */
        }

        .swiper-carousel-nav i {
            font-size: 18px;
        }

        /* Ajustes de padding em mobile */
        .p-8 {
            padding: 1.5rem;
        }

        /* Textos em mobile */
        h1 {
            font-size: 2.5rem !important;
        }

        h2 {
            font-size: 2rem !important;
        }
    }

    /* Efeito de parallax suave */
    .swiper-slide img {
        transition: transform 15s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .swiper-slide-active img {
        transform: scale(1.08);
    }

    /* Estilos para prefers-reduced-motion */
    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Melhorias de contraste para acessibilidade */
    .text-yellow-900 {
        color: #78350f;
    }

    .bg-yellow-500 {
        background-color: var(--color-yellow-500);
    }

    /* Hover states consistentes */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .group:hover .group-hover\:rotate-3 {
        transform: rotate(3deg);
    }

    .group:hover .group-hover\:-rotate-3 {
        transform: rotate(-3deg);
    }

    /* Transições suaves */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }

    /* Aspect ratio para vídeo */
    .aspect-w-16 {
        position: relative;
        padding-bottom: 56.25%;
        /* 16:9 Aspect Ratio */
    }

    .aspect-w-16>* {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }

    /* Loading states */
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    /* Scroll behavior suave */
    html {
        scroll-behavior: smooth;
    }

    /* Print styles */
    @media print {

        .carrossel-apostolo,
        .swiper-carousel-nav,
        iframe {
            display: none !important;
        }
    }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout_public.php";
?>