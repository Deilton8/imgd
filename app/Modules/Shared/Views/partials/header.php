<!-- ================> Header section start here <================== -->
<header class="header fixed top-0 left-0 right-0 z-50" x-data="{ 
    mobileMenuOpen: false, 
    sobreOpen: false,
    mobileSobreOpen: false
  }">

    <!-- Main Navigation -->
    <nav id="main-nav" class="bg-transparent transition-all duration-500 z-50" role="navigation"
        aria-label="Navegação principal">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center transition-all duration-300 hover:scale-120 header-logo"
                    aria-label="Página inicial - IMGD">
                    <!-- Logo para Desktop -->
                    <img src="/assets/img/logo.png" alt="IMGD - Igreja Ministério da Graça de Deus"
                        class="hidden md:block w-auto h-32 object-cover transition-all duration-300 logo-image">

                    <!-- Logo para Mobile -->
                    <img src="/assets/img/logo.png" alt="IMGD - Igreja Ministério da Graça de Deus"
                        class="md:hidden w-auto h-24 object-cover transition-all duration-300 logo-image"
                        loading="lazy">
                </a>

                <!-- Mobile Menu Button -->
                <div class="flex">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="relative w-16 h-16 bg-black/30 hover:bg-black/50 rounded-xl flex items-center justify-center transition-all duration-300 group hover:scale-120"
                        :aria-expanded="mobileMenuOpen" aria-controls="sidebar-menu" aria-label="Alternar menu">
                        <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'"
                            class="text-yellow-500 text-lg group-hover:scale-120 transition-transform duration-300"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar Menu -->
    <div x-cloak x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-full" id="sidebar-menu"
        class="fixed top-0 right-0 h-full w-80 bg-gradient-to-b from-white via-white/90 to-white shadow-2xl z-40 overflow-y-auto"
        role="dialog" aria-modal="true" aria-label="Menu lateral" @click.away="mobileMenuOpen = false">

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between p-6 border-b border-white/10">
            <h2 class="text-xl font-bold text-black">Menu</h2>
            <button @click="mobileMenuOpen = false"
                class="w-10 h-10 bg-black/10 hover:bg-black/30 rounded-lg flex items-center justify-center transition-all duration-300"
                aria-label="Fechar menu">
                <i class="fas fa-times text-black"></i>
            </button>
        </div>

        <!-- Sidebar Content -->
        <div class="p-6">
            <ul class="flex flex-col space-y-4">
                <!-- Home -->
                <li>
                    <a href="/"
                        class="flex items-center space-x-4 p-4 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-xl group"
                        role="menuitem">
                        <div
                            class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center group-hover:bg-yellow-500/50 transition-colors">
                            <i class="fas fa-home text-yellow-500"></i>
                        </div>
                        <span class="text-black font-medium group-hover:text-yellow-500 transition-colors">Início</span>
                    </a>
                </li>

                <!-- Sobre Dropdown -->
                <li class="relative">
                    <button @click="mobileSobreOpen = !mobileSobreOpen"
                        class="w-full flex items-center justify-between p-4 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-xl group"
                        :aria-expanded="mobileSobreOpen" aria-controls="mobile-sobre-menu">
                        <div class="flex items-center space-x-4">
                            <div
                                class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center group-hover:bg-yellow-500/50 transition-colors">
                                <i class="fas fa-info-circle text-yellow-500"></i>
                            </div>
                            <span
                                class="text-black font-medium group-hover:text-yellow-500 transition-colors">Sobre</span>
                        </div>
                        <i class="fas fa-chevron-down text-sm transition-transform duration-200 text-yellow-500"
                            :class="{'rotate-180': mobileSobreOpen}"></i>
                    </button>

                    <!-- Submenu -->
                    <ul x-show="mobileSobreOpen" x-transition id="mobile-sobre-menu"
                        class="ml-12 mt-2 space-y-2 bg-gray-200 rounded-lg p-2" role="menu">
                        <li>
                            <a href="/declaracao-de-fe"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                                role="menuitem">
                                <i class="fas fa-cross text-yellow-500 text-sm"></i>
                                <span class="text-black/80 group-hover:text-yellow-500 transition-colors">Declaração de
                                    Fé</span>
                            </a>
                        </li>
                        <li>
                            <a href="/sobre-imgd"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                                role="menuitem">
                                <i class="fas fa-church text-yellow-500 text-sm"></i>
                                <span class="text-black/80 group-hover:text-yellow-500 transition-colors">IMGD</span>
                            </a>
                        </li>
                        <li>
                            <a href="/apostolo-jeque"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                                role="menuitem">
                                <i class="fas fa-user-circle text-yellow-500 text-sm"></i>
                                <span class="text-black/80 group-hover:text-yellow-500 transition-colors">AP.
                                    Jeque</span>
                            </a>
                        </li>
                        <li>
                            <a href="/acao-social"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                                role="menuitem">
                                <i class="fas fa-hands-helping text-yellow-500 text-sm"></i>
                                <span class="text-black/80 group-hover:text-yellow-500 transition-colors">Acção
                                    Social</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Eventos -->
                <li>
                    <a href="/eventos"
                        class="flex items-center space-x-4 p-4 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-xl group"
                        role="menuitem">
                        <div
                            class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center group-hover:bg-yellow-500/50 transition-colors">
                            <i class="fas fa-calendar-alt text-yellow-500"></i>
                        </div>
                        <span
                            class="text-black font-medium group-hover:text-yellow-500 transition-colors">Eventos</span>
                    </a>
                </li>

                <!-- Mensagens -->
                <li>
                    <a href="/sermoes"
                        class="flex items-center space-x-4 p-4 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-xl group"
                        role="menuitem">
                        <div
                            class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center group-hover:bg-yellow-500/50 transition-colors">
                            <i class="fas fa-podcast text-yellow-500"></i>
                        </div>
                        <span
                            class="text-black font-medium group-hover:text-yellow-500 transition-colors">Mensagens</span>
                    </a>
                </li>

                <!-- Publicações -->
                <li>
                    <a href="/blog"
                        class="flex items-center space-x-4 p-4 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-xl group"
                        role="menuitem">
                        <div
                            class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center group-hover:bg-yellow-500/50 transition-colors">
                            <i class="fas fa-book text-yellow-500"></i>
                        </div>
                        <span
                            class="text-black font-medium group-hover:text-yellow-500 transition-colors">Publicações</span>
                    </a>
                </li>

                <!-- Contacto -->
                <li>
                    <a href="/contato"
                        class="flex items-center space-x-4 p-4 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-xl group"
                        role="menuitem">
                        <div
                            class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center group-hover:bg-yellow-500/50 transition-colors">
                            <i class="fas fa-envelope text-yellow-500"></i>
                        </div>
                        <span
                            class="text-black font-medium group-hover:text-yellow-500 transition-colors">Contato</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Overlay for sidebar -->
    <div x-cloak x-show="mobileMenuOpen" x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30"
        @click="mobileMenuOpen = false"></div>
</header>
<!-- ================> Header section end here <================== -->

<style>
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .animate-slideDown {
        animation: slideDown 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Smooth scrolling for better UX */
    html {
        scroll-behavior: smooth;
    }

    /* Custom scrollbar for sidebar */
    #sidebar-menu::-webkit-scrollbar {
        width: 4px;
    }

    #sidebar-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    #sidebar-menu::-webkit-scrollbar-thumb {
        background: #f59e0b;
        border-radius: 4px;
    }

    #sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: #d97706;
    }

    /* Mobile logo adjustments */
    @media (max-width: 768px) {
        .header-logo {
            max-width: 120px;
        }
    }

    /* Prevent body scroll when sidebar is open */
    body:has(#sidebar-menu[x-show="true"]) {
        overflow: hidden;
    }
    
    /* Hide elements with x-cloak until Alpine is loaded */
    [x-cloak] {
        display: none !important;
    }
</style>