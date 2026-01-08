<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? "IMGD"); ?></title>

    <meta name="description"
        content="<?php echo htmlspecialchars($description ?? 'Igreja Ministério da Graça de Deus'); ?>">
    <meta name="keywords"
        content="<?php echo htmlspecialchars($keywords ?? 'igreja, cristã, ministério, graça de deus'); ?>">
    <meta name="author" content="IMGD">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#f59e0b',
                            600: '#d97706',
                        },
                        secondary: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html {
            font-family: 'Inter', system-ui, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
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

    <!-- Toast Container -->
    <div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2"></div>

    <!-- Scripts -->
    <script>
        // Toast function
        window.showToast = function (message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };

            toast.className = `${colors[type] || 'bg-blue-500'} text-white px-4 py-3 rounded-lg shadow-lg`;
            toast.textContent = message;

            container.appendChild(toast);

            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 5000);
        };

        // Back to top
        const backToTop = document.createElement('button');
        backToTop.innerHTML = '↑';
        backToTop.className = 'fixed bottom-6 right-6 w-10 h-10 bg-primary-500 text-white rounded-full shadow-lg hidden';
        backToTop.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
        document.body.appendChild(backToTop);

        window.addEventListener('scroll', () => {
            backToTop.classList.toggle('hidden', window.scrollY < 300);
        });
    </script>
</body>

</html>