<?php

use App\Modules\Publication\Models\Publication;

class RecentPostsLoader
{
    private const POSTS_LIMIT = 3;

    private static array $socialLinks = [
        'facebook' => 'https://web.facebook.com/www.imgdjeque.org.mz',
        'youtube' => 'https://youtube.com/@imgdvideos',
        'instagram' => 'https://www.instagram.com/apostolojeque'
    ];

    /**
     * Carrega os posts recentes de forma segura
     */
    public static function loadRecentPosts(array &$recentPosts): void
    {
        if (self::isValidPostsArray($recentPosts)) {
            return;
        }

        try {
            $recentPosts = self::fetchRecentPosts();
        } catch (Exception $e) {
            self::logError($e);
            $recentPosts = [];
        }
    }

    /**
     * Verifica se o array de posts é válido
     */
    private static function isValidPostsArray($posts): bool
    {
        return isset($posts) && is_array($posts) && !empty($posts);
    }

    /**
     * Busca os posts recentes do banco de dados
     */
    private static function fetchRecentPosts(): array
    {
        $publicationModel = new Publication();
        $allPosts = $publicationModel->getAll();

        return self::filterAndLimitPosts($allPosts, $publicationModel);
    }

    /**
     * Filtra e limita os posts conforme regras de negócio
     */
    private static function filterAndLimitPosts(array $allPosts, Publication $model): array
    {
        $recentPosts = [];

        foreach ($allPosts as $post) {
            if (count($recentPosts) >= self::POSTS_LIMIT) {
                break;
            }

            $postWithMedia = self::getPostWithMedia($post, $model);

            if ($postWithMedia !== null) {
                $recentPosts[] = $postWithMedia;
            }
        }

        return $recentPosts;
    }

    /**
     * Obtém um post com mídias se for válido
     */
    private static function getPostWithMedia(array $post, Publication $model): ?array
    {
        if (!isset($post['id'])) {
            return null;
        }

        $postWithMedia = $model->findWithMedia($post['id']);

        if (empty($postWithMedia['titulo'])) {
            return null;
        }

        return $postWithMedia;
    }

    /**
     * Registra erros de forma segura
     */
    private static function logError(Exception $e): void
    {
        error_log(sprintf(
            "Erro ao carregar posts recentes: %s [Arquivo: %s, Linha: %s]",
            $e->getMessage(),
            $e->getFile(),
            $e->getLine()
        ));
    }

    /**
     * Retorna os links de redes sociais
     */
    public static function getSocialLinks(): array
    {
        return self::$socialLinks;
    }
}

// Uso do código refatorado
$recentPosts = $recentPosts ?? []; // Inicialização segura
RecentPostsLoader::loadRecentPosts($recentPosts);

$socialLinks = RecentPostsLoader::getSocialLinks();

?>

<!-- ================> Social section start here <================== -->
<section class="bg-white py-8" aria-labelledby="social-heading">
    <div class="container mx-auto px-4">
        <h2 id="social-heading" class="sr-only">Siga-nos nas redes sociais</h2>
        <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
            <!-- Texto de chamada -->
            <div class="text-center lg:text-left">
                <h3 class="text-2xl font-bold text-black mb-2">Junte-se à Nossa Comunidade Online</h3>
                <p class="text-yellow-600 text-lg">Acompanhe nossas atividades e mensagens inspiradoras</p>
            </div>

            <!-- Redes Sociais -->
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo htmlspecialchars($socialLinks['facebook']); ?>" target="_blank"
                    rel="noopener noreferrer"
                    class="group relative bg-blue-600 backdrop-blur-sm rounded-xl px-6 py-3 transition-all duration-300 transform hover:scale-110 hover:shadow-lg border border-black/10"
                    aria-label="Siga-nos no Facebook">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-8 h-8 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fab fa-facebook-f text-white text-sm"></i>
                        </div>
                        <span class="font-semibold text-black">Facebook</span>
                    </div>
                </a>

                <a href="<?php echo htmlspecialchars($socialLinks['youtube']); ?>" target="_blank"
                    rel="noopener noreferrer"
                    class="group relative bg-red-600 backdrop-blur-sm rounded-xl px-6 py-3 transition-all duration-300 transform hover:scale-110 hover:shadow-lg border border-black/10"
                    aria-label="Inscreva-se no nosso canal do YouTube">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-8 h-8 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fab fa-youtube text-white text-sm"></i>
                        </div>
                        <span class="font-semibold text-black">YouTube</span>
                    </div>
                </a>

                <a href="<?php echo htmlspecialchars($socialLinks['instagram']); ?>" target="_blank"
                    rel="noopener noreferrer"
                    class="group relative bg-gradient-to-br from-purple-600 to-pink-600 backdrop-blur-sm rounded-xl px-6 py-3 transition-all duration-300 transform hover:scale-110 hover:shadow-lg border border-black/10"
                    aria-label="Siga-nos no Instagram">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-8 h-8 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fab fa-instagram text-white text-sm"></i>
                        </div>
                        <span class="font-semibold text-black">Instagram</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- ================> Social section end here <================== -->

<!-- ================> Footer section start here <================== -->
<footer class="footer bg-black text-white" role="contentinfo">
    <div class="py-16 lg:py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                <!-- Links Úteis -->
                <div class="text-center lg:text-left">
                    <h3 class="text-xl font-bold text-yellow-500 mb-6">Links Rápidos</h3>
                    <nav aria-label="Links úteis do site">
                        <ul class="space-y-3">
                            <li>
                                <a href="/sobre-imgd"
                                    class="group flex items-center text-gray-300 hover:text-yellow-400 transition-all duration-300 py-2">
                                    <i
                                        class="fas fa-chevron-right text-yellow-500 text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Sobre IMGD</span>
                                </a>
                            </li>
                            <li>
                                <a href="/apostolo-jeque"
                                    class="group flex items-center text-gray-300 hover:text-yellow-400 transition-all duration-300 py-2">
                                    <i
                                        class="fas fa-chevron-right text-yellow-500 text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Apóstolo Jeque</span>
                                </a>
                            </li>
                            <li>
                                <a href="/acao-social"
                                    class="group flex items-center text-gray-300 hover:text-yellow-400 transition-all duration-300 py-2">
                                    <i
                                        class="fas fa-chevron-right text-yellow-500 text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Acção Social</span>
                                </a>
                            </li>
                            <li>
                                <a href="/eventos"
                                    class="group flex items-center text-gray-300 hover:text-yellow-400 transition-all duration-300 py-2">
                                    <i
                                        class="fas fa-chevron-right text-yellow-500 text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Eventos</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Mais Links -->
                <div class="text-center lg:text-left">
                    <h3 class="text-xl font-bold text-yellow-500 mb-6">Mais Informações</h3>
                    <nav aria-label="Mais links do site">
                        <ul class="space-y-3">
                            <li>
                                <a href="/sermoes"
                                    class="group flex items-center text-gray-300 hover:text-yellow-400 transition-all duration-300 py-2">
                                    <i
                                        class="fas fa-chevron-right text-yellow-500 text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Mensagens</span>
                                </a>
                            </li>
                            <li>
                                <a href="/blog"
                                    class="group flex items-center text-gray-300 hover:text-yellow-400 transition-all duration-300 py-2">
                                    <i
                                        class="fas fa-chevron-right text-yellow-500 text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Publicações</span>
                                </a>
                            </li>
                            <li>
                                <a href="/declaracao-de-fe"
                                    class="group flex items-center text-gray-300 hover:text-yellow-400 transition-all duration-300 py-2">
                                    <i
                                        class="fas fa-chevron-right text-yellow-500 text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Declaração de Fé</span>
                                </a>
                            </li>
                            <li>
                                <a href="/contacto"
                                    class="group flex items-center text-gray-300 hover:text-yellow-400 transition-all duration-300 py-2">
                                    <i
                                        class="fas fa-chevron-right text-yellow-500 text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>
                                    <span>Contacto</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Recent Posts -->
                <div class="text-center lg:text-left">
                    <h3 class="text-xl font-bold text-yellow-500 mb-6">Publicações Recentes</h3>
                    <div class="space-y-4">
                        <?php if (!empty($recentPosts)): ?>
                            <?php foreach ($recentPosts as $post): ?>
                                <?php
                                // Thumbnail: primeira mídia imagem ou placeholder
                                $thumb = $placeholderImage;
                                $altText = "Thumbnail para " . htmlspecialchars($post['titulo']);

                                if (!empty($post['midias'][0]['caminho_arquivo'])) {
                                    $thumbPath = $post['midias'][0]['caminho_arquivo'];
                                    $thumb = '/' . ltrim($thumbPath, '/');
                                    $altText = htmlspecialchars($post['midias'][0]['descricao'] ?? $post['titulo']);
                                }

                                $published = !empty($post['publicado_em']) ?
                                    date("d M, Y", strtotime($post['publicado_em'])) : '';

                                $postUrl = "/publicacao/" . $post['id'];
                                $title = htmlspecialchars($post['titulo']);
                                ?>
                                <article
                                    class="group flex items-start max-w-md mx-auto lg:mx-0 rounded-xl p-3 transition-all duration-300">
                                    <div class="flex-shrink-0 w-14 h-14 mr-4">
                                        <a href="<?php echo $postUrl; ?>" class="block">
                                            <img src="<?php echo $thumb; ?>" alt="<?php echo $altText; ?>"
                                                class="w-full h-full object-cover rounded-lg group-hover:scale-110 transition-transform duration-300 shadow-md"
                                                loading="lazy">
                                        </a>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="<?php echo $postUrl; ?>"
                                            class="font-medium text-white hover:text-yellow-400 transition-colors duration-200 line-clamp-2"
                                            title="<?php echo $title; ?>">
                                            <?php echo $title; ?>
                                        </a>
                                        <?php if ($published): ?>
                                            <p class="text-gray-400 text-xs mt-1 flex items-center">
                                                <i class="far fa-calendar-alt mr-1 text-yellow-500"></i>
                                                <time datetime="<?php echo date('Y-m-d', strtotime($post['publicado_em'])); ?>">
                                                    <?php echo $published; ?>
                                                </time>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <div class="text-center py-6 bg-black/5 rounded-xl">
                                <i class="fas fa-newspaper text-gray-500 text-2xl mb-3"></i>
                                <p class="text-gray-400 text-sm mb-3">Nenhuma publicação disponível no momento.</p>
                                <a href="/blog"
                                    class="inline-flex items-center text-yellow-500 hover:text-yellow-400 text-sm transition-colors group/noposts">
                                    <span>Explorar publicações</span>
                                    <i
                                        class="fas fa-arrow-right ml-1 text-xs group-hover/noposts:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright e Admin -->
    <div class="bg-white py-6 border-t border-yellow-700/30">
        <div class="container mx-auto px-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <!-- Texto do Copyright -->
                <p class="text-black text-sm text-center sm:text-left">
                    &copy; <?php echo date('Y'); ?>
                    <a href="/"
                        class="text-yellow-600 hover:text-yellow-400 font-semibold transition-colors duration-200">
                        Igreja Ministério da Graça de Deus
                    </a>
                    - Todos os direitos reservados.
                </p>

                <!-- Botão Admin - Estilo Melhorado -->
                <a href="/admin"
                    class="group inline-flex items-center bg-gray-100 hover:bg-yellow-600 text-gray-600 hover:text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 transform hover:scale-110 hover:shadow-lg border border-gray-200 hover:border-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 opacity-10 hover:opacity-100"
                    aria-label="Acessar painel administrativo" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-user-shield text-sm group-hover:scale-110 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- ================> Footer section end here <================== -->

<style>
    /* Utilidades CSS para melhor apresentação */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Animações suaves */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .footer>div:first-child>div>div>div {
        animation: fadeInUp 0.6s ease-out;
    }

    .footer>div:first-child>div>div>div:nth-child(1) {
        animation-delay: 0.1s;
    }

    .footer>div:first-child>div>div>div:nth-child(2) {
        animation-delay: 0.2s;
    }

    .footer>div:first-child>div>div>div:nth-child(3) {
        animation-delay: 0.3s;
    }

    .footer>div:first-child>div>div>div:nth-child(4) {
        animation-delay: 0.4s;
    }

    /* Melhorias de responsividade */
    @media (max-width: 768px) {
        .footer>div:first-child {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .grid>div {
            margin-bottom: 2rem;
        }
    }
</style>