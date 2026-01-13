<!DOCTYPE html>
<html lang="pt">

<!-- Substituir a seção <head> atual por: -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title><?php echo htmlspecialchars($title ?? "IMGD - Igreja Ministério da Graça de Deus | Matola, Moçambique"); ?>
    </title>
    <meta name="description"
        content="<?php echo htmlspecialchars($description ?? 'Igreja Ministério da Graça de Deus em Matola. Comunidade cristã, pregações, mensagens, eventos e ação social. Junte-se a nós!'); ?>">
    <meta name="keywords"
        content="igreja, Matola, Moçambique, cristão, pregação, Apóstolo Jeque, IMGD, Ministério da Graça de Deus">
    
    <meta name="google-site-verification" content="CgPpUhREoU4hbKrEnEmsO4coQxVutuBQzLYmmPIKvx4" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    <meta property="og:title"
        content="<?php echo htmlspecialchars($title ?? "IMGD - Igreja Ministério da Graça de Deus"); ?>">
    <meta property="og:description"
        content="<?php echo htmlspecialchars($description ?? 'Igreja Ministério da Graça de Deus em Matola'); ?>">
    <meta property="og:image" content="/assets/img/logo.png">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="<?php echo htmlspecialchars($title ?? "IMGD - Igreja Ministério da Graça de Deus"); ?>">
    <meta name="twitter:description"
        content="<?php echo htmlspecialchars($description ?? 'Igreja Ministério da Graça de Deus em Matola'); ?>">
    <meta name="twitter:image" content="/assets/img/logo.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">

    <!-- Schema.org markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "PlaceOfWorship",
        "name": "Igreja Ministério da Graça de Deus",
        "description": "Igreja cristã em Matola, Moçambique",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Av. Joaquim Chissano, nº 58",
            "addressLocality": "Matola",
            "addressRegion": "Maputo",
            "addressCountry": "MZ"
        },
        "telephone": "+258 XX XXX XXXX",
        "url": "https://www.imgd.org.mz",
        "sameAs": [
            "https://web.facebook.com/www.imgdjeque.org.mz",
            "https://youtube.com/@imgdvideos",
            "https://www.instagram.com/apostolojeque"
        ]
    }
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/logo.png">

    <!-- Preload critical resources -->
    <link rel="preload" href="/assets/img/logo.png" as="image">

    <!-- CSS Otimizado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" crossorigin="anonymous">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">
    <!-- Header -->
    <?php include __DIR__ . '/partials/header.php'; ?>

    <!-- Main Content -->
    <main class="flex-grow">
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js" defer></script>

    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.swiper-container').forEach(function (swiperEl) {
                new Swiper(swiperEl, {
                    loop: true,
                    speed: 600,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    pagination: {
                        el: swiperEl.querySelector('.swiper-pagination'),
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: swiperEl.querySelector('.swiper-button-next'),
                        prevEl: swiperEl.querySelector('.swiper-button-prev'),
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 20
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 30
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 40
                        }
                    },
                    a11y: {
                        prevSlideMessage: 'Slide anterior',
                        nextSlideMessage: 'Próximo slide',
                        firstSlideMessage: 'Este é o primeiro slide',
                        lastSlideMessage: 'Este é o último slide',
                        paginationBulletMessage: 'Ir para slide {{index}}',
                    }
                });
            });

            // Back to top button
            const backToTop = document.createElement('button');
            backToTop.innerHTML = '<i class="fas fa-chevron-up"></i>';
            backToTop.className = 'fixed bottom-6 right-6 w-12 h-12 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full shadow-lg flex items-center justify-center z-50 hidden';
            backToTop.setAttribute('aria-label', 'Voltar ao topo');
            backToTop.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
            document.body.appendChild(backToTop);

            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTop.classList.remove('hidden');
                } else {
                    backToTop.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>