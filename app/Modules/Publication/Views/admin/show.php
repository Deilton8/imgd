<?php
ob_start();
?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-purple-50/30 py-8 px-4 sm:px-6 lg:px-8"
    x-data="publicationView()" x-cloak>
    <div class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-6">
                <div class="flex items-start gap-4">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-purple-600 to-pink-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-3xl font-bold text-gray-900">Detalhes da Publicação</h1>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                                ID: <?= $publicacao['id'] ?>
                            </span>
                        </div>
                        <p class="text-gray-600">Visualize todas as informações da publicação</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/admin/publicacoes"
                        class="group inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl hover:border-gray-400 hover:shadow-lg transition-all duration-300 font-medium text-gray-700">
                        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Voltar à Lista
                    </a>
                </div>
            </div>

            <!-- Status Banner -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div :class="getStatusClasses('<?= $publicacao['status'] ?>')"
                            class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full"
                                :class="getStatusDotClass('<?= $publicacao['status'] ?>')"></span>
                            <span x-text="getStatusText('<?= $publicacao['status'] ?>')"></span>
                        </div>

                        <div class="text-sm text-gray-600">
                            <span class="font-medium"><?= htmlspecialchars($publicacao['titulo']) ?></span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-sm text-gray-500">
                            Criado em: <?= date('d/m/Y H:i', strtotime($publicacao['criado_em'])) ?>
                        </div>
                        <?php if (!empty($publicacao['atualizado_em'])): ?>
                            <div class="text-sm text-gray-500">
                                Atualizado: <?= date('d/m/Y H:i', strtotime($publicacao['atualizado_em'])) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Coluna 1: Informações da Publicação -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Card de Detalhes -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Informações da Publicação</h2>
                    </div>

                    <div class="p-6">
                        <!-- Título -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Título
                            </h3>
                            <p class="text-gray-700 text-lg"><?= htmlspecialchars($publicacao['titulo']) ?></p>
                        </div>

                        <!-- Conteúdo -->
                        <?php if (!empty($publicacao['conteudo'])): ?>
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    Conteúdo
                                </h3>
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <p class="text-gray-700 whitespace-pre-line leading-relaxed">
                                        <?= nl2br(htmlspecialchars($publicacao['conteudo'])) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Metadados -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Categoria -->
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5a2 2 0 00-2 2v7a2 2 0 002 2h14a2 2 0 002-2v-7a2 2 0 00-2-2zM16 5l-4-4-4 4M12 2v12" />
                                    </svg>
                                    Categoria
                                </h3>
                                <span :class="getCategoryClasses('<?= $publicacao['categoria'] ?>')"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm font-semibold">
                                    <span x-text="getCategoryText('<?= $publicacao['categoria'] ?>')"></span>
                                </span>
                            </div>

                            <!-- Datas -->
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Datas
                                </h3>
                                <div class="space-y-2">
                                    <?php if ($publicacao['publicado_em']): ?>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm text-gray-600">Publicado em:</span>
                                            <span class="font-medium text-gray-800">
                                                <?= date('d/m/Y H:i', strtotime($publicacao['publicado_em'])) ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Criado em:</span>
                                        <span class="font-medium text-gray-800">
                                            <?= date('d/m/Y H:i', strtotime($publicacao['criado_em'] ?? 'now')) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mídias -->
                <?php if (!empty($publicacao['midias'])): ?>
                    <div x-data="mediaGallery(<?= htmlspecialchars(json_encode($publicacao['midias'])) ?>)"
                        class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-cyan-700 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-bold text-white">Mídias da Publicação</h2>
                                <span class="text-sm text-white/80" x-text="`${midias.length} arquivo(s)`"></span>
                            </div>
                        </div>

                        <div class="p-6">
                            <!-- Grid de mídias -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                                <template x-for="(media, index) in midias" :key="media.id">
                                    <button @click="openGallery(index)"
                                        class="group relative bg-white rounded-xl border border-gray-200 p-3 hover:border-blue-400 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                        :title="media.nome_arquivo">

                                        <!-- Ícone de tipo -->
                                        <div
                                            class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm rounded-lg p-1.5 shadow-sm z-10">
                                            <span class="text-xs">
                                                <template x-if="media.tipo_arquivo === 'imagem'">🖼️</template>
                                                <template x-if="media.tipo_arquivo === 'video'">🎬</template>
                                                <template x-if="media.tipo_arquivo === 'audio'">🎵</template>
                                                <template
                                                    x-if="!['imagem','video','audio'].includes(media.tipo_arquivo)">📄</template>
                                            </span>
                                        </div>

                                        <!-- Preview -->
                                        <div
                                            class="aspect-square rounded-lg overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 mb-2 relative">
                                            <template x-if="media.tipo_arquivo === 'imagem'">
                                                <img :src="'/' + media.caminho_arquivo" :alt="media.nome_arquivo"
                                                    class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                            </template>
                                            <template x-if="media.tipo_arquivo === 'video'">
                                                <video :src="'/' + media.caminho_arquivo" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300" autoplay muted></video>
                                            </template>
                                            <template x-if="media.tipo_arquivo === 'audio'">
                                                <div
                                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-50 to-yellow-50">
                                                    <span class="text-3xl opacity-70">🎵</span>
                                                </div>
                                            </template>
                                            <template x-if="!['imagem','video','audio'].includes(media.tipo_arquivo)">
                                                <div
                                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-200">
                                                    <span class="text-3xl opacity-70">📄</span>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Nome do arquivo -->
                                        <p class="text-xs font-medium text-gray-800 truncate text-center group-hover:text-blue-600 transition-colors"
                                            x-text="media.nome_arquivo"></p>
                                    </button>
                                </template>
                            </div>

                            <!-- Contador de tipos -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                        <span x-text="midias.filter(m => m.tipo_arquivo === 'imagem').length"></span>
                                        imagens
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                                        <span x-text="midias.filter(m => m.tipo_arquivo === 'video').length"></span> vídeos
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 bg-amber-500 rounded-full"></span>
                                        <span x-text="midias.filter(m => m.tipo_arquivo === 'audio').length"></span> áudios
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 bg-gray-500 rounded-full"></span>
                                        <span
                                            x-text="midias.filter(m => !['imagem','video','audio'].includes(m.tipo_arquivo)).length"></span>
                                        outros
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de Visualização de Mídias -->
                        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 z-50 bg-black bg-opacity-90 flex items-center justify-center p-4"
                            style="display: none;" @click.self="closeGallery()" @keydown.escape="closeGallery()">

                            <div class="relative max-w-6xl w-full max-h-[90vh]">
                                <button @click="closeGallery()"
                                    class="absolute -top-12 right-0 bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-gray-100 transition-colors z-50 focus:outline-none focus:ring-2 focus:ring-white"
                                    aria-label="Fechar visualizador">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <!-- Navegação -->
                                <button x-show="midias.length > 1" @click="previous()"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-sm transition-colors z-50 focus:outline-none focus:ring-2 focus:ring-white"
                                    aria-label="Mídia anterior">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>

                                <button x-show="midias.length > 1" @click="next()"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full w-12 h-12 flex items-center justify-center backdrop-blur-sm transition-colors z-50 focus:outline-none focus:ring-2 focus:ring-white"
                                    aria-label="Próxima mídia">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>

                                <!-- Conteúdo da mídia atual -->
                                <div class="flex flex-col items-center justify-center h-full">
                                    <div class="text-center mb-6">
                                        <h3 class="text-xl font-bold text-white" x-text="currentMedia.nome_arquivo"></h3>
                                        <p class="text-gray-300" x-text="currentMedia.tipo_arquivo"></p>
                                    </div>

                                    <div class="relative w-full max-w-4xl">
                                        <template x-if="currentMedia.tipo_arquivo === 'imagem'">
                                            <img :src="'/' + currentMedia.caminho_arquivo" :alt="currentMedia.nome_arquivo"
                                                class="max-w-full max-h-[60vh] object-contain rounded-lg shadow-2xl mx-auto">
                                        </template>

                                        <template x-if="currentMedia.tipo_arquivo === 'video'">
                                            <video controls autoplay
                                                class="max-w-full max-h-[60vh] rounded-lg shadow-2xl mx-auto">
                                                <source :src="'/' + currentMedia.caminho_arquivo"
                                                    :type="currentMedia.tipo_mime">
                                                Seu navegador não suporta vídeos.
                                            </video>
                                        </template>

                                        <template x-if="currentMedia.tipo_arquivo === 'audio'">
                                            <div class="bg-gray-900 p-8 rounded-2xl shadow-2xl max-w-md mx-auto">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-20 h-20 text-white mb-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                    </svg>
                                                    <p class="text-white font-semibold mb-4"
                                                        x-text="currentMedia.nome_arquivo"></p>
                                                    <audio controls class="w-full">
                                                        <source :src="'/' + currentMedia.caminho_arquivo"
                                                            :type="currentMedia.tipo_mime">
                                                        Seu navegador não suporta áudio.
                                                    </audio>
                                                </div>
                                            </div>
                                        </template>

                                        <template x-if="!['imagem','video','audio'].includes(currentMedia.tipo_arquivo)">
                                            <div class="bg-gray-900 p-12 rounded-2xl shadow-2xl max-w-md mx-auto">
                                                <div class="flex flex-col items-center text-center">
                                                    <svg class="w-24 h-24 text-gray-400 mb-6" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <h4 class="text-xl font-bold text-white mb-2"
                                                        x-text="currentMedia.nome_arquivo"></h4>
                                                    <p class="text-gray-300 mb-6" x-text="currentMedia.tipo_arquivo"></p>
                                                    <a :href="'/' + currentMedia.caminho_arquivo" target="_blank"
                                                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                                        Baixar Arquivo
                                                    </a>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Contador -->
                                    <div class="mt-8 text-white text-center">
                                        <span x-text="currentIndex + 1"></span> de <span x-text="midias.length"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Coluna 2: Sidebar -->
            <div class="space-y-8">
                <!-- Card de Status -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Status da Publicação</h2>
                    </div>

                    <div class="p-6">
                        <div class="text-center">
                            <div :class="getStatusClasses('<?= $publicacao['status'] ?>')"
                                class="inline-flex items-center gap-3 px-6 py-4 rounded-xl mb-4">
                                <span class="w-4 h-4 rounded-full"
                                    :class="getStatusDotClass('<?= $publicacao['status'] ?>')"></span>
                                <span class="text-lg font-bold"
                                    x-text="getStatusText('<?= $publicacao['status'] ?>')"></span>
                            </div>

                            <p class="text-sm text-gray-600 mb-4"
                                x-text="getStatusDescription('<?= $publicacao['status'] ?>')"></p>

                            <div class="text-xs text-gray-500">
                                <?php if (!empty($publicacao['atualizado_em'])): ?>
                                    Última atualização: <?= date('d/m/Y H:i', strtotime($publicacao['atualizado_em'])) ?>
                                <?php else: ?>
                                    Nenhuma atualização desde a criação
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card de Ações Rápidas -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white">Ações</h2>
                    </div>

                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="/admin/publicacao/<?= $publicacao['id'] ?>/editar"
                                class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition-all duration-300">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Editar Publicação</p>
                                        <p class="text-xs text-gray-600">Modificar informações</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="/admin/midia"
                                class="group flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-pink-100 hover:from-purple-100 hover:to-pink-200 rounded-xl transition-all duration-300">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Gerenciar Mídias</p>
                                        <p class="text-xs text-gray-600">Adicionar/remover arquivos</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <button @click="showDeleteModal = true"
                                class="group flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-rose-100 hover:from-red-100 hover:to-rose-200 rounded-xl transition-all duration-300 w-full text-left">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-red-500 to-rose-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-red-900">Excluir Publicação</p>
                                        <p class="text-xs text-red-600">Remover permanentemente</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-red-400 group-hover:text-red-600 transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação de Exclusão -->
        <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="display: none;">
            <div class="absolute inset-0 bg-black bg-opacity-50" @click="showDeleteModal = false"></div>

            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                <div class="text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2">Excluir Publicação</h2>
                    <p class="text-gray-600 mb-1">
                        <strong class="font-semibold"><?= htmlspecialchars($publicacao['titulo']) ?></strong>
                    </p>
                    <p class="text-gray-500 text-sm mb-6">
                        Tem certeza que deseja excluir esta publicação? Esta ação não pode ser desfeita.
                    </p>

                    <div class="flex justify-center gap-3">
                        <button @click="showDeleteModal = false"
                            class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium">
                            Cancelar
                        </button>
                        <a href="/admin/publicacao/<?= $publicacao['id'] ?>/deletar"
                            class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 font-medium">
                            Sim, Excluir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function publicationView() {
        return {
            showDeleteModal: false,

            getStatusClasses(status) {
                const classes = {
                    'publicado': 'bg-green-100 text-green-800 border border-green-200',
                    'rascunho': 'bg-gray-100 text-gray-800 border border-gray-200'
                };
                return classes[status] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getStatusDotClass(status) {
                const classes = {
                    'publicado': 'bg-green-500',
                    'rascunho': 'bg-gray-500'
                };
                return classes[status] || 'bg-gray-500';
            },

            getStatusText(status) {
                const texts = {
                    'publicado': 'Publicado',
                    'rascunho': 'Rascunho'
                };
                return texts[status] || status;
            },

            getStatusDescription(status) {
                const descriptions = {
                    'publicado': 'Publicação visível para todos os usuários',
                    'rascunho': 'Publicação em modo rascunho, não visível publicamente'
                };
                return descriptions[status] || '';
            },

            getCategoryClasses(category) {
                const classes = {
                    'blog': 'bg-green-100 text-green-800 border border-green-200',
                    'testemunho': 'bg-purple-100 text-purple-800 border border-purple-200',
                    'aviso': 'bg-yellow-100 text-yellow-800 border border-yellow-200'
                };
                return classes[category] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getCategoryText(category) {
                const texts = {
                    'blog': 'Blog',
                    'testemunho': 'Testemunho',
                    'aviso': 'Aviso'
                };
                return texts[category] || category;
            }
        }
    }

    function mediaGallery(midias) {
        return {
            midias,
            currentIndex: 0,
            isOpen: false,

            get currentMedia() {
                return this.midias[this.currentIndex];
            },

            openGallery(index) {
                this.currentIndex = index;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },

            closeGallery() {
                this.isOpen = false;
                document.body.style.overflow = '';
            },

            next() {
                if (this.midias.length > 1) {
                    this.currentIndex = (this.currentIndex + 1) % this.midias.length;
                }
            },

            previous() {
                if (this.midias.length > 1) {
                    this.currentIndex = (this.currentIndex - 1 + this.midias.length) % this.midias.length;
                }
            },

            init() {
                // Navegação por teclado
                window.addEventListener('keydown', (e) => {
                    if (!this.isOpen) return;

                    switch (e.key) {
                        case 'Escape':
                            this.closeGallery();
                            break;
                        case 'ArrowRight':
                            this.next();
                            break;
                        case 'ArrowLeft':
                            this.previous();
                            break;
                    }
                });
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>