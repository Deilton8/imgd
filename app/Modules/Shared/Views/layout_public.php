<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? "IMGD - Igreja Ministério da Graça de Deus"); ?></title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="<?php echo htmlspecialchars($description ?? 'Igreja Ministério da Graça de Deus - Uma comunidade de fé, esperança e amor em Cristo Jesus.'); ?>">
    <meta name="author" content="IMGD - Igreja Ministério da Graça de Deus">
    <meta name="robots" content="index, follow">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    }
                }
            }
        }
    </script>
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

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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