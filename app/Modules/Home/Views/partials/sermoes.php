<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-yellow-900 mb-4">Mensagens Recentes</h2>
            <div class="w-20 h-1 bg-yellow-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Sermons Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($sermoes)): ?>
                <?php foreach ($sermoes as $sermao):
                    $sermaoId = $sermao['id'];
                    $sermaoTitulo = htmlspecialchars($sermao['titulo']);
                    $sermaoConteudo = strip_tags($sermao['conteudo']);
                    $sermaoResumo = strlen($sermaoConteudo) > 220 ? substr($sermaoConteudo, 0, 220) . '...' : $sermaoConteudo;
                    $sermaoData = !empty($sermao['data']) ? date("d.m.y", strtotime($sermao['data'])) : null;
                    $sermaoPregador = !empty($sermao['pregador']) ? htmlspecialchars($sermao['pregador']) : null;
                    $hasMidias = !empty($sermao['midias']);
                    $imagens = $hasMidias ? array_filter($sermao['midias'], fn($midia) => $midia['tipo_arquivo'] === 'imagem') : [];
                    $audioFiles = $hasMidias ? array_filter($sermao['midias'], fn($midia) => $midia['tipo_arquivo'] === 'audio') : [];
                    $hasAudio = !empty($audioFiles);
                    ?>
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100 group">
                        <!-- Image Section with Audio Badge -->
                        <div class="relative">
                            <?php if (!empty($imagens)): ?>
                                <div class="swiper-container group/image-group">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($imagens as $index => $midia): ?>
                                            <div class="swiper-slide">
                                                <a href="/sermao/<?= $sermaoId ?>" class="block relative overflow-hidden">
                                                    <img src="/<?= $midia['caminho_arquivo'] ?>"
                                                        alt="<?= $sermaoTitulo ?> - Imagem <?= $index + 1 ?>"
                                                        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105"
                                                        loading="lazy">
                                                    <div
                                                        class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300">
                                                    </div>

                                                    <!-- Audio Play Button Overlay -->
                                                    <?php if ($hasAudio): ?>
                                                        <div
                                                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                            <div
                                                                class="bg-yellow-500/90 text-white rounded-full p-4 shadow-2xl transform group-hover:scale-110 transition-transform duration-300">
                                                                <i class="fas fa-play text-2xl"></i>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Pagination -->
                                    <?php if (count($imagens) > 1): ?>
                                        <div class="swiper-pagination absolute bottom-3"></div>
                                        <!-- Navigation -->
                                        <div
                                            class="swiper-button-next opacity-0 group-hover/image-group:opacity-100 transition-opacity duration-300">
                                        </div>
                                        <div
                                            class="swiper-button-prev opacity-0 group-hover/image-group:opacity-100 transition-opacity duration-300">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <!-- Placeholder with Audio Icon -->
                                <a href="/sermao/<?= $sermaoId ?>" class="block relative overflow-hidden">
                                    <div
                                        class="w-full h-64 bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center relative">
                                        <div class="text-center text-indigo-600">
                                            <?php if ($hasAudio): ?>
                                                <i class="fas fa-podcast text-6xl mb-3"></i>
                                                <p class="text-sm font-medium">Áudio disponível</p>
                                            <?php else: ?>
                                                <i class="fas fa-bible text-6xl mb-3"></i>
                                                <p class="text-sm font-medium">Mensagem inspiradora</p>
                                            <?php endif; ?>
                                        </div>
                                        <!-- Audio Play Button for Placeholder -->
                                        <?php if ($hasAudio): ?>
                                            <div
                                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <div
                                                    class="bg-yellow-500/90 text-white rounded-full p-4 shadow-2xl transform group-hover:scale-110 transition-transform duration-300">
                                                    <i class="fas fa-play text-2xl"></i>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="absolute inset-0 bg-black/0 hover:bg-black/5 transition-colors duration-300"></div>
                                </a>
                            <?php endif; ?>

                            <!-- Audio Badge -->
                            <?php if ($hasAudio): ?>
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md flex items-center">
                                        <i class="fas fa-volume-up mr-1"></i>
                                        Áudio
                                    </span>
                                </div>
                            <?php endif; ?>

                            <!-- Date Badge -->
                            <?php if ($sermaoData): ?>
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-semibold px-3 py-1 rounded-lg shadow-md">
                                        <?= $sermaoData ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <!-- Title -->
                            <a href="/sermao/<?= $sermaoId ?>"
                                class="text-xl font-bold text-gray-900 hover:text-yellow-600 transition-colors duration-200 line-clamp-2 mb-4 block">
                                <?= $sermaoTitulo ?>
                            </a>

                            <!-- Metadata -->
                            <div class="space-y-2 mb-4">
                                <?php if ($sermaoPregador): ?>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-user text-yellow-500 mr-3 text-sm"></i>
                                        <span class="font-medium"><?= $sermaoPregador ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($sermaoData): ?>
                                    <div class="flex items-center text-gray-600">
                                        <i class="far fa-calendar text-yellow-500 mr-3 text-sm"></i>
                                        <span class="font-medium"><?= $sermaoData ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Excerpt -->
                            <p class="text-gray-600 leading-relaxed mb-6 line-clamp-3 text-sm">
                                <?= $sermaoResumo ?>
                            </p>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between">
                                <a href="/sermao/<?= $sermaoId ?>"
                                    class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-semibold text-sm transition-colors duration-200 group/read">
                                    Ver mensagem
                                    <i
                                        class="fas fa-arrow-right ml-2 text-xs group-hover/read:translate-x-1 transition-transform duration-200"></i>
                                </a>

                                <!-- Audio Duration -->
                                <?php if ($hasAudio && !empty($sermao['duracao'])): ?>
                                    <span class="text-xs text-gray-500 font-medium bg-gray-100 px-2 py-1 rounded">
                                        <i class="fas fa-clock mr-1"></i>
                                        <?= $sermao['duracao'] ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div class="col-span-3 text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-bible text-6xl text-gray-300 mb-6"></i>
                        <h3 class="text-2xl font-semibold text-gray-600 mb-3">Nenhuma mensagem disponível</h3>
                        <p class="text-gray-500 text-lg mb-6">Em breve teremos novas pregações para sua edificação.</p>
                        <a href="/sermoes"
                            class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                            Ver arquivo de mensagens
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- View All Button -->
        <?php if (!empty($sermoes)): ?>
            <div class="text-center mt-12">
                <a href="/sermoes"
                    class="inline-flex items-center px-8 py-4 bg-yellow-600 text-white font-semibold rounded-xl hover:bg-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    Ver todas as mensagens
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