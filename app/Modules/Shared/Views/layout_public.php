<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? "IMGD - Igreja Ministério da Graça de Deus"; ?></title>

    <!-- Favicon e Apple Touch Icon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/logo.png">

    <!-- Meta Tags para SEO e Social Media -->
    <meta name="description"
        content="Igreja Ministério da Graça de Deus - Uma comunidade de fé, esperança e amor em Cristo Jesus">
    <meta name="keywords" content="igreja, cristã, ministério, graça de deus, imgd, culto, sermões, eventos">
    <meta name="author" content="IMGD - Igreja Ministério da Graça de Deus">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo $title ?? 'IMGD - Igreja Ministério da Graça de Deus'; ?>">
    <meta property="og:description"
        content="Igreja Ministério da Graça de Deus - Uma comunidade de fé, esperança e amor em Cristo Jesus">
    <meta property="og:image" content="/assets/img/logo.png">
    <meta property="og:url" content="<?php echo $_SERVER['REQUEST_URI'] ?? '/'; ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="IMGD - Igreja Ministério da Graça de Deus">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $title ?? 'IMGD - Igreja Ministério da Graça de Deus'; ?>">
    <meta name="twitter:description"
        content="Igreja Ministério da Graça de Deus - Uma comunidade de fé, esperança e amor em Cristo Jesus">
    <meta name="twitter:image" content="/assets/img/logo.png">

    <!-- Theme Color -->
    <meta name="theme-color" content="#f59e0b">
    <meta name="msapplication-TileColor" content="#f59e0b">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <!-- JavaScript Libraries -->
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Preload Critical Resources -->
    <link rel="preload" href="/assets/img/logo.png" as="image">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include __DIR__ . '/partials/header.php'; ?>

    <!-- Conteúdo da página -->
    <main class="">
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.querySelectorAll('.swiper-container').forEach(function (swiperEl) {
            new Swiper(swiperEl, {
                loop: true,              // Loop infinito
                autoplay: {
                    delay: 5000,         // 5 segundos por slide
                    disableOnInteraction: false, // Continua mesmo se o usuário passar o mouse
                },
                pagination: {
                    el: swiperEl.querySelector('.swiper-pagination'),
                    clickable: true,      // Indicadores clicáveis
                },
                // Sem botões de navegação
            });
        });
    </script>

</body>

</html>