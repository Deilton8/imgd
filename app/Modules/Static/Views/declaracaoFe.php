<?php
ob_start();
?>

<!-- Page Header -->
<header class="relative h-screen">
    <div class="w-full h-full">
        <img loading="lazy" src="/assets/img/declaracao-de-fe.png" alt="Comunidade da IMGD em culto"
            class="w-full h-full object-cover">
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
                <span class="text-gray-900 font-medium" aria-current="page">Declaração de Fé</span>
            </li>
        </ol>
    </div>
</nav>

<!-- Content -->
<main class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div
                class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 mx-auto mb-8 rounded-full animate-pulse">
            </div>

            <!-- Crenças Fundamentais -->
            <section aria-labelledby="crencas-heading">
                <h2 id="crencas-heading"
                    class="text-3xl md:text-4xl font-bold text-gray-900 mb-12 text-center scroll-reveal">
                    Crenças Fundamentais
                </h2>

                <div class="space-y-8">
                    <!-- A Bíblia Sagrada -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="0">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-book"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    A Bíblia Sagrada
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Acreditamos que a Bíblia é a Palavra inspirada de Deus, servindo como
                                        guia infalível para a fé e a conduta cristã.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Toda a Escritura é inspirada por Deus e útil para o ensino, para a repreensão,
                                        para a correção e para a instrução na justiça."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — 2 Timóteo 3:16
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Deus Triúno -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="100">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-cross"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Deus Triúno
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Professamos a fé em um único Deus, eternamente existente em três pessoas:
                                        Pai, Filho e Espírito Santo.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Portanto, ide, fazei discípulos de todas as nações, batizando-os em nome do
                                        Pai,
                                        e do Filho, e do Espírito Santo."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — Mateus 28:19
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Jesus Cristo -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="200">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-dove"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Jesus Cristo
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Reconhecemos Jesus Cristo como o Filho de Deus, concebido pelo Espírito Santo,
                                        nascido da virgem Maria, verdadeiro Deus e verdadeiro homem.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "E o anjo, respondendo, disse-lhe: Descerá sobre ti o Espírito Santo, e a
                                        virtude
                                        do Altíssimo te cobrirá com a sua sombra; pelo que também o Santo, que de ti há
                                        de
                                        nascer, será chamado Filho de Deus."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — Lucas 1:35
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Salvação pela Graça -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="300">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-praying-hands"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Salvação pela Graça
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Cremos que a salvação é um dom gratuito de Deus, recebido pela fé em Jesus
                                        Cristo,
                                        não resultante de obras humanas.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Porque pela graça sois salvos, por meio da fé; e isso não vem de vós, é dom de
                                        Deus."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — Efésios 2:8
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Obra Redentora de Cristo -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="400">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-cross"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Obra Redentora de Cristo
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Afirmamos que Jesus morreu na cruz pelos pecados da humanidade, foi sepultado e
                                        ressuscitou ao terceiro dia, proporcionando justificação para todos os que
                                        creem.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Porque primeiramente vos entreguei o que também recebi: que Cristo morreu por
                                        nossos pecados, segundo as Escrituras."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — 1 Coríntios 15:3
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Batismo nas Águas -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="500">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-water"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Batismo nas Águas
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Praticamos o batismo por imersão em nome do Pai, do Filho e do Espírito Santo,
                                        como testemunho público da fé no Senhor Jesus Cristo.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Portanto, ide, fazei discípulos de todas as nações, batizando-os em nome do
                                        Pai,
                                        e do Filho, e do Espírito Santo."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — Mateus 28:19
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Batismo no Espírito Santo -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="600">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-fire"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Batismo no Espírito Santo
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Cremos que o batismo no Espírito Santo é uma experiência distinta da conversão,
                                        evidenciada pelo falar em línguas, conforme o Espírito concede.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "E todos foram cheios do Espírito Santo, e começaram a falar noutras línguas,
                                        conforme o Espírito Santo lhes concedia que falassem."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — Atos 2:4
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Dons Espirituais -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="700">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-gifts"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Dons Espirituais
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Acreditamos na atualidade dos dons do Espírito Santo, concedidos à Igreja para
                                        edificação, exortação e consolação dos crentes.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Ora, há diversidade de dons, mas o Espírito é o mesmo."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — 1 Coríntios 12:4
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Santificação -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="800">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-hands"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Santificação
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Enfatizamos a necessidade de uma vida santa, separada do pecado, como fruto da
                                        obra regeneradora do Espírito Santo no crente.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Mas, como é santo aquele que vos chamou, sede vós também santos em toda a vossa
                                        maneira de viver."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — 1 Pedro 1:15
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Cura Divina -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="900">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-hand-holding-medical"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Cura Divina
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Cremos que a cura física é provida na expiação de Cristo e é privilégio de todos
                                        os crentes.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Verdadeiramente, ele tomou sobre si as nossas enfermidades e as nossas dores
                                        levou sobre si."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — Isaías 53:4
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Segunda Vinda de Cristo -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="1000">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-cloud"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Segunda Vinda de Cristo
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Aguardamos a iminente volta de Jesus Cristo para buscar a Sua Igreja e
                                        estabelecer o Seu Reino eterno.
                                    </p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-6 rounded-lg shadow-sm transform transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-md">
                                    <blockquote class="text-gray-700 italic leading-relaxed">
                                        <i
                                            class="fas fa-quote-left text-yellow-500 mr-2 opacity-70 group-hover:opacity-100 transition-opacity duration-300"></i>
                                        "Porque o mesmo Senhor descerá do céu com alarido, e com voz de arcanjo, e com a
                                        trombeta de Deus;
                                        e os que morreram em Cristo ressuscitarão primeiro."
                                        <footer class="mt-2 text-sm text-gray-600 not-italic font-semibold">
                                            — 1 Tessalonicenses 4:16
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Juízo Final -->
                    <article
                        class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-200 transform hover:-translate-y-1 scroll-reveal-item opacity-0 translate-y-8 transition-all duration-700 ease-out"
                        data-delay="1100">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-balance-scale"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-yellow-700 transition-colors duration-300">
                                    Juízo Final
                                </h3>
                                <div class="text-gray-700 leading-relaxed mb-6 space-y-4">
                                    <p class="opacity-90 group-hover:opacity-100 transition-opacity duration-300">
                                        Cremos que haverá um juízo final, onde os ímpios serão ressuscitados para o
                                        julgamento.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</main>

<style>
    /* Animações CSS para o scroll reveal */
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

    .scroll-reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .scroll-reveal.revealed {
        opacity: 1;
        transform: translateY(0);
    }

    .scroll-reveal-item.revealed {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }

    /* Progress indicator */
    .scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #f59e0b, #d97706);
        z-index: 1000;
        transition: width 0.3s ease;
    }

    /* Ícones animados quando revelados */
    .scroll-reveal-item.revealed .fa-book,
    .scroll-reveal-item.revealed .fa-cross,
    .scroll-reveal-item.revealed .fa-dove,
    .scroll-reveal-item.revealed .fa-hands-praying,
    .scroll-reveal-item.revealed .fa-water,
    .scroll-reveal-item.revealed .fa-fire,
    .scroll-reveal-item.revealed .fa-gifts,
    .scroll-reveal-item.revealed .fa-hands,
    .scroll-reveal-item.revealed .fa-hand-holding-medical,
    .scroll-reveal-item.revealed .fa-cloud,
    .scroll-reveal-item.revealed .fa-balance-scale {
        animation: iconReveal 0.6s ease-out forwards;
    }

    @keyframes iconReveal {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Efeito de brilho nos ícones */
    .group:hover .fa-book,
    .group:hover .fa-cross,
    .group:hover .fa-dove,
    .group:hover .fa-hands-praying,
    .group:hover .fa-water,
    .group:hover .fa-fire,
    .group:hover .fa-gifts,
    .group:hover .fa-hands,
    .group:hover .fa-hand-holding-medical,
    .group:hover .fa-cloud,
    .group:hover .fa-balance-scale {
        animation: iconGlow 1.5s ease-in-out infinite alternate;
    }

    @keyframes iconGlow {
        from {
            filter: drop-shadow(0 0 2px rgba(245, 158, 11, 0.3));
        }

        to {
            filter: drop-shadow(0 0 6px rgba(245, 158, 11, 0.6));
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Criar indicador de progresso do scroll
        const progressBar = document.createElement('div');
        progressBar.className = 'scroll-progress';
        document.body.appendChild(progressBar);

        // Elementos para animar
        const revealElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-item');
        let animationTriggered = false;

        // Função para atualizar a barra de progresso
        function updateScrollProgress() {
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight - windowHeight;
            const scrolled = window.scrollY;
            const progress = (scrolled / documentHeight) * 100;
            progressBar.style.width = progress + '%';
        }

        // Função para verificar se elemento está visível
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight * 0.85) &&
                rect.bottom >= (window.innerHeight * 0.15)
            );
        }

        // Função para revelar elementos
        function revealElementsOnScroll() {
            revealElements.forEach(element => {
                if (isElementInViewport(element)) {
                    // Adicionar delay baseado no atributo data-delay
                    const delay = element.getAttribute('data-delay') || 0;

                    setTimeout(() => {
                        element.classList.add('revealed');

                        // Adicionar animação extra no ícone
                        const icon = element.querySelector('.fa-book, .fa-cross, .fa-dove, .fa-hands-praying, .fa-water, .fa-fire, .fa-gifts, .fa-hands, .fa-hand-holding-medical, .fa-cloud, .fa-balance-scale');
                        if (icon) {
                            icon.style.animationDelay = '0.3s';
                        }
                    }, parseInt(delay));
                }
            });
        }

        // Revelar elementos iniciais (no topo da página)
        function revealInitialElements() {
            const initialElements = document.querySelectorAll('.scroll-reveal');
            initialElements.forEach(element => {
                setTimeout(() => {
                    element.classList.add('revealed');
                }, 300);
            });
        }

        // Função para animação de entrada sequencial
        function sequentialReveal() {
            if (!animationTriggered) {
                animationTriggered = true;
                revealInitialElements();

                // Adicionar evento de scroll
                window.addEventListener('scroll', () => {
                    updateScrollProgress();
                    revealElementsOnScroll();
                });

                // Revelar elementos iniciais visíveis
                revealElementsOnScroll();
                updateScrollProgress();
            }
        }

        // Iniciar animação após um breve delay
        setTimeout(sequentialReveal, 500);

        // Adicionar efeito de clique nos artigos
        const articles = document.querySelectorAll('article');
        articles.forEach(article => {
            article.addEventListener('click', function () {
                this.classList.add('ring-2', 'ring-yellow-500');
                setTimeout(() => {
                    this.classList.remove('ring-2', 'ring-yellow-500');
                }, 500);
            });
        });

        // Revelar elementos quando a página carrega em posição específica
        if (window.scrollY > 0) {
            revealElementsOnScroll();
        }

        // Smooth scroll para elementos quando clicados
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });

    // Opcional: Adicionar debounce para performance
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Atualizar progresso com debounce para melhor performance
    window.addEventListener('scroll', debounce(updateScrollProgress, 10));
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout_public.php";
?>