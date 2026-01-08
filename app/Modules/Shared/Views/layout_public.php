<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?php echo htmlspecialchars($title ?? "IMGD - Igreja Ministério da Graça de Deus"); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/icon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icon.png">
    <link rel="mask-icon" href="/assets/img/icon.png" color="#f59e0b">

    <!-- CSS Resources with integrity -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" crossorigin="anonymous">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">

    <!-- Critical CSS Inline -->
    <style>
        /* Critical CSS */
        html {
            font-family: system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        main {
            flex: 1 0 auto;
        }
    </style>

    <!-- Preload critical resources -->
    <link rel="preload" href="/assets/img/logo.png" as="image" type="image/png">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.woff2"
        as="font" type="font/woff2" crossorigin>
    <link rel="preload"
        href="https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZ9hjp-Ek-_EeA.woff2"
        as="font" type="font/woff2" crossorigin>
</head>

<body class="bg-gradient-to-b from-gray-50 to-white text-gray-900 antialiased min-h-screen flex flex-col">

    <!-- Header -->
    <?php include __DIR__ . '/partials/header.php'; ?>

    <!-- Main Content -->
    <main id="main-content" class="flex-grow" role="main">
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- JavaScript Libraries -->
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js" defer integrity="sha384-..."></script>

    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script>
        // Back to top button
        const backToTop = document.createElement('button');
        backToTop.innerHTML = '<i class="fas fa-chevron-up"></i>';
        backToTop.className = 'fixed bottom-6 right-6 w-12 h-12 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center z-50 hidden';
        backToTop.setAttribute('aria-label', 'Voltar ao topo');
        backToTop.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
        document.body.appendChild(backToTop);

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.remove('hidden');
                backToTop.classList.add('flex');
            } else {
                backToTop.classList.add('hidden');
                backToTop.classList.remove('flex');
            }
        });
    </script>

</body>

</html>