<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="title-font text-3xl md:text-4xl font-bold text-yellow-900 mb-8">Publicações Recentes</h2>
            <div class="w-20 h-1 bg-yellow-600 mx-auto mt-8 rounded-full"></div>
        </div>

        <!-- Publications Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($publicacoes)): ?>
                <?php foreach ($publicacoes as $pub):
                    $pubSlug = $pub['slug'];
                    $pubTitulo = htmlspecialchars($pub['titulo']);
                    $pubConteudo = strip_tags($pub['conteudo']);
                    $pubResumo = strlen($pubConteudo) > 220 ? substr($pubConteudo, 0, 220) . '...' : $pubConteudo;
                    $pubData = !empty($pub['publicado_em']) ? date("d.m.y", strtotime($pub['publicado_em'])) : null;
                    $pubCategoria = !empty($pub['categoria']) ? htmlspecialchars($pub['categoria']) : null;
                    $hasMidias = !empty($pub['midias']);
                    $imagens = $hasMidias ? array_filter($pub['midias'], fn($midia) => $midia['tipo_arquivo'] === 'imagem') : [];
                    ?>
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                        <!-- Image Section -->
                        <div class="relative">
                            <?php if (!empty($imagens)): ?>
                                <div class="swiper-container group">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($imagens as $index => $midia): ?>
                                            <div class="swiper-slide">
                                                <a href="/blog/<?= $pubSlug ?>" class="block relative overflow-hidden">
                                                    <img src="/<?= $midia['caminho_arquivo'] ?>"
                                                        alt="<?= $pubTitulo ?> - Imagem <?= $index + 1 ?>"
                                                        class="w-full h-64 object-contain transition-transform duration-500 group-hover:scale-105"
                                                        loading="lazy">
                                                    <div
                                                        class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300">
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Pagination -->
                                    <?php if (count($imagens) > 1): ?>
                                        <div class="swiper-pagination absolute bottom-3"></div>
                                        <!-- Navigation -->
                                        <div
                                            class="swiper-button-next opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        </div>
                                        <div
                                            class="swiper-button-prev opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <!-- Placeholder Image -->
                                <a href="/blog/<?= $pubSlug ?>" class="block relative overflow-hidden">
                                    <div
                                        class="w-full h-64 bg-gradient-to-br from-yellow-50 to-yellow-100 flex items-center justify-center">
                                        <div class="text-center text-yellow-600">
                                            <i class="far fa-newspaper text-5xl mb-3"></i>
                                            <p class="text-sm font-medium">Sem imagem</p>
                                        </div>
                                    </div>
                                    <div class="absolute inset-0 bg-black/0 hover:bg-black/5 transition-colors duration-300"></div>
                                </a>
                            <?php endif; ?>

                            <!-- Category Badge -->
                            <?php if ($pubCategoria): ?>
                                <div class="absolute top-4 left-4 z-10">
                                    <span class="bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                                        <?= $pubCategoria ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <!-- Title -->
                            <a href="/blog/<?= $pubSlug ?>"
                                class="text-xl font-bold text-gray-900 hover:text-yellow-600 transition-colors duration-200 line-clamp-2 mb-4 block">
                                <?= $pubTitulo ?>
                            </a>

                            <!-- Metadata -->
                            <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                                <?php if ($pubData): ?>
                                    <div class="flex items-center">
                                        <i class="far fa-calendar text-yellow-500 mr-2 text-sm"></i>
                                        <span class="font-medium"><?= $pubData ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($pubCategoria): ?>
                                    <div class="flex items-center">
                                        <i class="fas fa-tag text-yellow-500 mr-2 text-sm"></i>
                                        <span class="font-medium"><?= $pubCategoria ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Excerpt -->
                            <p class="text-gray-600 leading-relaxed mb-6 line-clamp-3">
                                <?= $pubResumo ?>
                            </p>

                            <!-- Read More Button -->
                            <div class="flex items-center justify-between">
                                <a href="/blog/<?= $pubSlug ?>"
                                    class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-semibold text-sm transition-colors duration-200 group">
                                    Ver mais detalhes
                                    <i
                                        class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
                                </a>

                                <!-- Reading Time Estimate -->
                                <span class="text-xs text-gray-500 font-medium">
                                    <?= max(1, round(str_word_count($pubConteudo) / 200)) ?> min leitura
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div class="col-span-3 text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="far fa-newspaper text-6xl text-gray-300 mb-6"></i>
                        <h3 class="text-2xl font-semibold text-gray-600 mb-3">Nenhuma publicação disponível</h3>
                        <p class="text-gray-500 text-lg mb-6">Estamos preparando novos conteúdos inspiradores para você.</p>
                        <a href="/blog"
                            class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors duration-200">
                            <i class="fas fa-book-open mr-2"></i>
                            Ver arquivo de publicações
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- View All Button -->
        <?php if (!empty($publicacoes)): ?>
            <div class="text-center mt-12">
                <a href="/blog"
                    class="inline-flex items-center px-8 py-4 bg-yellow-600 text-white font-semibold rounded-xl hover:bg-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    Ver todas as publicações
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
</style>