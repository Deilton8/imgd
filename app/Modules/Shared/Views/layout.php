<!DOCTYPE html>
<html lang="pt-br" x-data="layout()" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Painel Administrativo" ?></title>

    <!-- Favicon e Ícones -->
    <link rel="icon" type="image/x-icon" href="/assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/logo.png">

    <!-- Meta Tags -->
    <meta name="description" content="Painel Administrativo - IMGD - Igreja Ministério da Graça de Deus">
    <meta name="theme-color" content="#3b82f6">

    <!-- CSS Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        .active-menu {
            background: linear-gradient(135deg, rgb(59 130 246) 0%, rgb(99 102 241) 100%);
        }

        .sidebar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 50;
        }

        .main-content {
            margin-left: 16rem;
            /* 64 */
        }

        .main-content-collapsed {
            margin-left: 5rem;
            /* 20 */
        }

        @media (max-width: 1023px) {

            .main-content,
            .main-content-collapsed {
                margin-left: 0;
            }
        }

        /* Logo styles for admin panel */
        .admin-logo {
            filter: brightness(0) invert(1);
            transition: all 0.3s ease;
        }

        .sidebar-collapsed .admin-logo {
            transform: scale(0.8);
        }

        /* Loading animation */
        .loading-spinner {
            border: 2px solid #f3f4f6;
            border-top: 2px solid #3b82f6;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Custom scrollbar for admin */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen" :class="{ 'overflow-hidden': mobileMenuOpen }">

    <!-- Overlay Mobile -->
    <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
    </div>

    <!-- Sidebar Fixo -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="sidebar-fixed bg-gradient-to-b from-gray-900 to-gray-800 text-gray-100 flex flex-col sidebar-transition shadow-2xl">

        <!-- Logo -->
        <div class="p-6 border-b border-gray-700 flex items-center justify-between lg:justify-center">
            <div class="flex items-center gap-3" :class="{ 'lg:flex-col lg:gap-2': !sidebarOpen }">
                <div
                    class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                    A
                </div>
                <div x-show="sidebarOpen" x-transition class="flex flex-col">
                    <span class="text-xl font-bold">Painel Admin</span>
                    <span class="text-xs text-gray-400">v2.0</span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <?php
            $currentPath = $_SERVER['REQUEST_URI'] ?? '';
            $menuItems = [
                'dashboard' => ['icon' => '📊', 'label' => 'Dashboard', 'href' => '/admin'],
                'midia' => ['icon' => '🖼️', 'label' => 'Mídias', 'href' => '/admin/midia'],
                'eventos' => ['icon' => '📅', 'label' => 'Eventos', 'href' => '/admin/eventos'],
                'publicacoes' => ['icon' => '📝', 'label' => 'Publicações', 'href' => '/admin/publicacoes'],
                'sermoes' => ['icon' => '📖', 'label' => 'Sermões', 'href' => '/admin/sermoes'],
                'usuarios' => ['icon' => '👥', 'label' => 'Usuários', 'href' => '/admin/usuarios'],
            ];

            foreach ($menuItems as $key => $item):
                $isActive = strpos($currentPath, $item['href']) === 0;
                ?>
                <a href="<?= $item['href'] ?>"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-300 group hover-lift relative overflow-hidden"
                    :class="{
                   'active-menu text-white shadow-lg': <?= $isActive ? 'true' : 'false' ?>,
                   'lg:justify-center lg:px-3': !sidebarOpen
               }" title="<?= $item['label'] ?>">
                    <span class="text-lg flex-shrink-0" :class="{ 'lg:text-xl': !sidebarOpen }">
                        <?= $item['icon'] ?>
                    </span>
                    <span x-show="sidebarOpen" x-transition class="font-medium flex-1">
                        <?= $item['label'] ?>
                    </span>

                    <!-- Tooltip para sidebar recolhida -->
                    <div x-show="!sidebarOpen"
                        class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap z-50 shadow-lg">
                        <?= $item['label'] ?>
                    </div>

                    <!-- Indicador de página ativa -->
                    <?php if ($isActive): ?>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                        </div>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- User Info -->
        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center gap-3" :class="{ 'lg:justify-center': !sidebarOpen }">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['usuario']['nome'] ?? 'Usuario') ?>&background=0D8ABC&color=fff&bold=true"
                    class="w-10 h-10 rounded-xl border-2 border-gray-600 flex-shrink-0">
                <div x-show="sidebarOpen" x-transition class="flex-1 min-w-0">
                    <p class="font-semibold text-white truncate">
                        <?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Usuário') ?>
                    </p>
                    <p class="text-xs text-gray-400 truncate">
                        <?= htmlspecialchars($_SESSION['usuario']['email'] ?? 'admin@exemplo.com') ?>
                    </p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Conteúdo principal -->
    <main class="min-h-screen transition-all duration-300"
        :class="sidebarOpen ? 'main-content' : 'main-content-collapsed'">

        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-4">
                    <!-- Botão para mobile -->
                    <button @click="mobileMenuOpen = true"
                        class="text-gray-500 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-100 transition-colors lg:hidden">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <button @click="toggleSidebar"
                        class="text-gray-500 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-100 transition-colors lg:hidden">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <button @click="sidebarOpen = !sidebarOpen"
                        class="hidden lg:flex text-gray-500 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Breadcrumb -->
                    <nav class="flex items-center space-x-2 text-sm text-gray-500">
                        <a href="/admin" class="hover:text-gray-700 transition-colors">Dashboard</a>
                        <span class="text-gray-300">/</span>
                        <span class="text-gray-700 font-medium"><?= $title ?? 'Página Atual' ?></span>
                    </nav>
                </div>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ userDropdownOpen: false }">
                    <button @click="userDropdownOpen = !userDropdownOpen"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-100 transition-colors group">
                        <div class="text-right hidden sm:block">
                            <p class="font-medium text-gray-900 text-sm">
                                <?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Usuário') ?>
                            </p>
                            <p class="text-xs text-gray-500">Administrador</p>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['usuario']['nome'] ?? 'Usuario') ?>&background=0D8ABC&color=fff&bold=true"
                            class="w-10 h-10 rounded-xl border-2 border-gray-300 group-hover:border-gray-400 transition-colors">
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': userDropdownOpen }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="userDropdownOpen" @click.away="userDropdownOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-xl py-2 z-50"
                        style="display: none;">

                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="font-semibold text-gray-900">
                                <?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Usuário') ?>
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                <?= htmlspecialchars($_SESSION['usuario']['email'] ?? 'admin@exemplo.com') ?>
                            </p>
                        </div>

                        <div class="py-2">
                            <a href="/admin/usuario/<?= $_SESSION['usuario']['id'] ?? '' ?>"
                                class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors">
                                <span class="text-lg">👤</span>
                                <span>Meu Perfil</span>
                            </a>
                        </div>

                        <div class="border-t border-gray-100 pt-2">
                            <a href="/admin/logout"
                                class="flex items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
                                <span class="text-lg">🚪</span>
                                <span>Sair do Sistema</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Conteúdo -->
        <section class="p-6 bg-gray-50/30 min-h-[calc(100vh-80px)]">
            <!-- Alertas/Notificações podem ser colocados aqui -->
            <?= $content ?? '' ?>
        </section>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4 px-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500">
                <div class="flex items-center gap-4 mb-2 sm:mb-0">
                    <span>&copy; <?= date('Y') ?> Painel Administrativo. Todos os direitos reservados.</span>
                    <span class="hidden sm:inline">•</span>
                    <span class="hidden sm:inline">v2.0.0</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        Sistema Online
                    </span>
                    <span>Último acesso: <?= date('d/m/Y H:i') ?></span>
                </div>
            </div>
        </footer>
    </main>

    <script>
        function layout() {
            return {
                sidebarOpen: window.innerWidth >= 1024,
                mobileMenuOpen: false,

                init() {
                    // Verificar se é mobile
                    this.checkScreenSize();
                    window.addEventListener('resize', this.checkScreenSize.bind(this));

                    // Persistir estado do sidebar no localStorage
                    const savedState = localStorage.getItem('sidebarOpen');
                    if (savedState !== null) {
                        this.sidebarOpen = savedState === 'true';
                    }
                },

                checkScreenSize() {
                    if (window.innerWidth >= 1024) {
                        this.mobileMenuOpen = false;
                    } else {
                        this.sidebarOpen = false;
                    }
                },

                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                    // Salvar estado no localStorage
                    localStorage.setItem('sidebarOpen', this.sidebarOpen);
                }
            }
        }
    </script>
</body>

</html>