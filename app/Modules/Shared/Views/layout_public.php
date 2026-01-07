<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?php echo htmlspecialchars($title ?? "IMGD - Igreja Ministério da Graça de Deus"); ?></title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="<?php echo htmlspecialchars($description ?? 'Igreja Ministério da Graça de Deus - Uma comunidade de fé, esperança e amor em Cristo Jesus. Transformando vidas através da graça de Deus.'); ?>">
    <meta name="keywords"
        content="<?php echo htmlspecialchars($keywords ?? 'igreja, cristã, ministério, graça de deus, imgd, culto, sermões, eventos, moçambique, fé, esperança, amor'); ?>">
    <meta name="author" content="IMGD - Igreja Ministério da Graça de Deus">
    <meta name="robots" content="index, follow, max-image-preview:large">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?php
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $canonical = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo htmlspecialchars($canonical);
    ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical ?? ''); ?>">
    <meta property="og:title"
        content="<?php echo htmlspecialchars($title ?? 'IMGD - Igreja Ministério da Graça de Deus'); ?>">
    <meta property="og:description"
        content="<?php echo htmlspecialchars($description ?? 'Uma comunidade de fé, esperança e amor em Cristo Jesus'); ?>">
    <meta property="og:image"
        content="<?php echo htmlspecialchars($image ?? 'https://' . $_SERVER['HTTP_HOST'] . '/assets/img/og-image.jpg'); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="IMGD - Igreja Ministério da Graça de Deus">
    <meta property="og:site_name" content="IMGD - Igreja Ministério da Graça de Deus">
    <meta property="og:locale" content="pt_PT">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo htmlspecialchars($canonical ?? ''); ?>">
    <meta name="twitter:title"
        content="<?php echo htmlspecialchars($title ?? 'IMGD - Igreja Ministério da Graça de Deus'); ?>">
    <meta name="twitter:description"
        content="<?php echo htmlspecialchars($description ?? 'Uma comunidade de fé, esperança e amor em Cristo Jesus'); ?>">
    <meta name="twitter:image"
        content="<?php echo htmlspecialchars($image ?? 'https://' . $_SERVER['HTTP_HOST'] . '/assets/img/twitter-image.jpg'); ?>">
    <meta name="twitter:creator" content="@imgdjeque">
    <meta name="twitter:site" content="@imgdjeque">

    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json" crossorigin="use-credentials">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png">
    <link rel="mask-icon" href="/assets/img/safari-pinned-tab.svg" color="#f59e0b">

    <!-- Theme Color -->
    <meta name="theme-color" content="#f59e0b" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#0f172a" media="(prefers-color-scheme: dark)">
    <meta name="msapplication-TileColor" content="#f59e0b">
    <meta name="msapplication-config" content="/browserconfig.xml">

    <!-- CSS Resources with integrity -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" crossorigin="anonymous">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Montserrat', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                    },
                }
            },
            plugins: [
                function ({ addUtilities }) {
                    addUtilities({
                        '.text-balance': {
                            'text-wrap': 'balance',
                        },
                        '.scrollbar-hide': {
                            '-ms-overflow-style': 'none',
                            'scrollbar-width': 'none',
                            '&::-webkit-scrollbar': {
                                display: 'none',
                            },
                        },
                        '.scrollbar-default': {
                            '-ms-overflow-style': 'auto',
                            'scrollbar-width': 'auto',
                            '&::-webkit-scrollbar': {
                                display: 'block',
                            },
                        },
                    })
                }
            ]
        }
    </script>

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

        .loading-skeleton {
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

        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                font-size: 12pt;
                line-height: 1.5;
                color: #000;
                background: #fff;
            }

            a {
                color: #000;
                text-decoration: underline;
            }

            a[href^="http"]:after {
                content: " (" attr(href) ")";
                font-size: 90%;
            }

            main {
                margin-top: 0;
            }
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>

    <!-- Preload critical resources -->
    <link rel="preload" href="/assets/img/logo.png" as="image" type="image/png">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.woff2"
        as="font" type="font/woff2" crossorigin>
    <link rel="preload"
        href="https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZ9hjp-Ek-_EeA.woff2"
        as="font" type="font/woff2" crossorigin>

    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- App-specific meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="IMGD">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "IMGD - Igreja Ministério da Graça de Deus",
        "url": "https://<?php echo $_SERVER['HTTP_HOST']; ?>",
        "logo": "https://<?php echo $_SERVER['HTTP_HOST']; ?>/assets/img/logo.png",
        "description": "Uma comunidade de fé, esperança e amor em Cristo Jesus",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "MZ",
            "addressLocality": "Moçambique"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "availableLanguage": ["Portuguese"]
        },
        "sameAs": [
            "https://web.facebook.com/www.imgdjeque.org.mz",
            "https://youtube.com/@imgdvideos",
            "https://www.instagram.com/apostolojeque"
        ]
    }
    </script>
</head>

<body class="bg-gradient-to-b from-gray-50 to-white text-gray-900 antialiased min-h-screen flex flex-col">
    <!-- Loading screen -->
    <div id="loading-screen"
        class="fixed inset-0 bg-white z-[100] flex items-center justify-center transition-opacity duration-300">
        <div class="text-center">
            <div class="w-40 h-40 mx-auto mb-6 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full animate-ping">
                </div>
                <div class="relative w-40 h-40 flex items-center justify-center">
                    <img src="/assets/img/logo.png" alt="IMGD - Igreja Ministério da Graça de Deus"
                        class="h-full w-full object-cover">
                </div>
            </div>
            <div class="text-xl font-bold text-yellow-500 animate-pulse">Igreja Ministério da Graça de Deus</div>
            <div class="text-sm text-gray-500 mt-2">Carregando...</div>
        </div>
    </div>

    <!-- Skip to main content link -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 z-[100] bg-yellow-500 text-white px-4 py-2 rounded-lg font-semibold transition-transform transform focus:scale-105">
        Saltar para conteúdo principal
    </a>

    <!-- Header -->
    <?php include __DIR__ . '/partials/header.php'; ?>

    <!-- Main Content -->
    <main id="main-content" class="flex-grow" role="main">
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed bottom-4 right-4 z-[60] space-y-3 min-w-[300px] max-w-md"></div>

    <!-- JavaScript Libraries -->
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js" defer integrity="sha384-..."></script>

    <!-- Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script>
        // Remove loading screen
        window.addEventListener('load', () => {
            setTimeout(() => {
                const loadingScreen = document.getElementById('loading-screen');
                if (loadingScreen) {
                    loadingScreen.style.opacity = '0';
                    setTimeout(() => {
                        loadingScreen.style.display = 'none';
                    }, 300);
                }
            }, 300);
        });

        // Initialize Swiper
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize all Swiper instances
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

            // Lazy load images
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.classList.remove('lazy');
                            }
                            if (img.dataset.srcset) {
                                img.srcset = img.dataset.srcset;
                            }
                            observer.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '50px 0px',
                    threshold: 0.1
                });

                document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));
            }

            // Service Worker registration for PWA
            if ('serviceWorker' in navigator && window.location.hostname !== 'localhost') {
                navigator.serviceWorker.register('/sw.js').then(registration => {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }).catch(error => {
                    console.log('ServiceWorker registration failed: ', error);
                });
            }

            // Toast notification function
            window.showToast = function (message, type = 'info') {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');

                const types = {
                    success: { icon: 'check-circle', color: 'bg-green-500' },
                    error: { icon: 'exclamation-circle', color: 'bg-red-500' },
                    warning: { icon: 'exclamation-triangle', color: 'bg-yellow-500' },
                    info: { icon: 'info-circle', color: 'bg-blue-500' }
                };

                const config = types[type] || types.info;

                toast.className = `${config.color} text-white p-4 rounded-xl shadow-2xl animate-slide-up`;
                toast.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-${config.icon} text-xl mr-3"></i>
                        <div class="flex-1">${message}</div>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-4">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;

                container.appendChild(toast);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.style.opacity = '0';
                        toast.style.transform = 'translateX(100%)';
                        setTimeout(() => {
                            if (toast.parentNode) {
                                toast.parentNode.removeChild(toast);
                            }
                        }, 300);
                    }
                }, 5000);
            };

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

            // Add loading states to links
            document.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function (e) {
                    if (this.getAttribute('href') && !this.getAttribute('href').startsWith('#') && !this.getAttribute('href').startsWith('mailto:') && !this.getAttribute('href').startsWith('tel:')) {
                        if (!this.querySelector('.loading-spinner')) {
                            const spinner = document.createElement('span');
                            spinner.className = 'loading-spinner ml-2 hidden';
                            spinner.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                            this.appendChild(spinner);
                        }
                        this.querySelector('.loading-spinner').classList.remove('hidden');
                        this.classList.add('opacity-75');
                    }
                });
            });

            // Handle browser back/forward cache
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });

            // Performance monitoring
            if ('performance' in window) {
                const navTiming = performance.getEntriesByType('navigation')[0];
                if (navTiming) {
                    console.log('Page loaded in:', navTiming.loadEventEnd - navTiming.startTime, 'ms');
                }
            }

            // Error tracking
            window.addEventListener('error', function (e) {
                console.error('Error:', e.error);
                // You can send this to your error tracking service
            });

            // Offline detection
            window.addEventListener('offline', () => {
                window.showToast('Você está offline. Algumas funcionalidades podem não estar disponíveis.', 'warning');
            });

            window.addEventListener('online', () => {
                window.showToast('Conexão restaurada!', 'success');
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function (e) {
            // Ctrl/Cmd + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                Alpine.store('searchOpen', true);
            }

            // ESC to close modals
            if (e.key === 'Escape') {
                Alpine.store('mobileMenuOpen', false);
                Alpine.store('searchOpen', false);
            }
        });

        // Copy to clipboard function
        window.copyToClipboard = function (text) {
            navigator.clipboard.writeText(text).then(() => {
                window.showToast('Copiado para a área de transferência!', 'success');
            }).catch(() => {
                window.showToast('Erro ao copiar. Tente novamente.', 'error');
            });
        };

        // Share functionality
        window.shareContent = function (title, text, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: text,
                    url: url || window.location.href,
                });
            } else {
                window.copyToClipboard(url || window.location.href);
            }
        };
    </script>

    <!-- Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-XXXXX-Y"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-XXXXX-Y');
    </script>

</body>

</html>