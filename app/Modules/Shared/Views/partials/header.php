<!-- ================> Header section start here <================== -->
<header class="header" x-data="{ 
    mobileMenuOpen: false, 
    sobreOpen: false, 
    blogOpen: false,
    mobileSobreOpen: false,
    isScrolled: false
  }" @scroll.window="isScrolled = window.scrollY > 50">

    <!-- Main Navigation -->
    <nav id="main-nav" class="bg-black shadow-2xl transition-all duration-500 z-50"
        :class="isScrolled ? 'bg-black/30 py-2' : 'bg-black py-4'" role="navigation" aria-label="Navegação principal">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/"
                    class="flex items-center space-x-3 group focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-black rounded-lg p-2 transition-all duration-300"
                    aria-label="Página inicial - IMGD">
                    <!-- Logo para Desktop -->
                    <img src="/assets/img/logo.png" alt="IMGD - Igreja Ministério da Graça de Deus"
                        class="hidden md:block w-auto h-16 object-cover transition-all duration-300"
                        :class="isScrolled ? 'h-14' : 'h-16'" loading="lazy">

                    <!-- Logo para Mobile -->
                    <img src="/assets/img/logo.png" alt="IMGD - Igreja Ministério da Graça de Deus"
                        class="md:hidden w-auto h-12 object-cover transition-all duration-300"
                        :class="isScrolled ? 'h-10' : 'h-12'" loading="lazy">
                </a>

                <!-- Mobile Menu Button -->
                <div class="flex md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="relative w-12 h-12 bg-yellow-500/10 hover:bg-yellow-500/20 border border-yellow-500/20 rounded-xl flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-black transition-all duration-300 group"
                        :aria-expanded="mobileMenuOpen" aria-controls="mobile-menu" aria-label="Alternar menu mobile">
                        <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'"
                            class="text-yellow-400 text-lg group-hover:scale-110 transition-transform duration-300"></i>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <!-- Sobre Dropdown -->
                    <div class="relative" @mouseenter="sobreOpen = true" @mouseleave="sobreOpen = false"
                        @keydown.escape="sobreOpen = false">
                        <button @click="sobreOpen = !sobreOpen"
                            class="group relative px-6 py-3 text-white/90 hover:text-yellow-400 font-medium flex items-center space-x-2 focus:outline-none focus:text-yellow-400 transition-all duration-300 rounded-lg hover:bg-white/5"
                            :aria-expanded="sobreOpen" aria-haspopup="true" aria-controls="sobre-menu">
                            <i
                                class="fas fa-info-circle text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                            <span>Sobre</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                                :class="{'rotate-180': sobreOpen}"></i>

                            <!-- Hover effect -->
                            <div
                                class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-yellow-500 to-yellow-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                            </div>
                        </button>

                        <div x-show="sobreOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform -translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 transform -translate-y-2 scale-95" id="sobre-menu"
                            class="absolute left-0 mt-1 w-64 bg-white/95 shadow-2xl rounded-xl py-3 z-10 focus:outline-none border border-white/20"
                            role="menu" aria-orientation="vertical">

                            <a href="/declaracao-de-fe"
                                class="group/menu-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 focus:bg-yellow-50 focus:text-yellow-600 focus:outline-none transition-all duration-300 border-l-4 border-transparent hover:border-yellow-500"
                                role="menuitem">
                                <i
                                    class="fas fa-cross text-yellow-500/70 group-hover/menu-item:text-yellow-600 transition-colors"></i>
                                <span>Declaração de Fé</span>
                            </a>

                            <a href="/sobre-imgd"
                                class="group/menu-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 focus:bg-yellow-50 focus:text-yellow-600 focus:outline-none transition-all duration-300 border-l-4 border-transparent hover:border-yellow-500"
                                role="menuitem">
                                <i
                                    class="fas fa-church text-yellow-500/70 group-hover/menu-item:text-yellow-600 transition-colors"></i>
                                <span>IMGD</span>
                            </a>

                            <a href="/apostolo-jeque"
                                class="group/menu-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 focus:bg-yellow-50 focus:text-yellow-600 focus:outline-none transition-all duration-300 border-l-4 border-transparent hover:border-yellow-500"
                                role="menuitem">
                                <i
                                    class="fas fa-user-circle text-yellow-500/70 group-hover/menu-item:text-yellow-600 transition-colors"></i>
                                <span>AP. Jeque</span>
                            </a>

                            <a href="/acao-social"
                                class="group/menu-item flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 focus:bg-yellow-50 focus:text-yellow-600 focus:outline-none transition-all duration-300 border-l-4 border-transparent hover:border-yellow-500"
                                role="menuitem">
                                <i
                                    class="fas fa-hands-helping text-yellow-500/70 group-hover/menu-item:text-yellow-600 transition-colors"></i>
                                <span>Acção Social</span>
                            </a>
                        </div>
                    </div>

                    <!-- Other Navigation Items -->
                    <a href="/eventos"
                        class="group relative px-6 py-3 text-white/90 hover:text-yellow-400 font-medium flex items-center space-x-2 focus:outline-none focus:text-yellow-400 transition-all duration-300 rounded-lg hover:bg-white/5">
                        <i
                            class="fas fa-calendar-alt text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                        <span>Eventos</span>
                        <div
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-yellow-500 to-yellow-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                        </div>
                    </a>

                    <a href="/sermoes"
                        class="group relative px-6 py-3 text-white/90 hover:text-yellow-400 font-medium flex items-center space-x-2 focus:outline-none focus:text-yellow-400 transition-all duration-300 rounded-lg hover:bg-white/5">
                        <i class="fas fa-podcast text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                        <span>Mensagens</span>
                        <div
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-yellow-500 to-yellow-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                        </div>
                    </a>

                    <a href="/blog"
                        class="group relative px-6 py-3 text-white/90 hover:text-yellow-400 font-medium flex items-center space-x-2 focus:outline-none focus:text-yellow-400 transition-all duration-300 rounded-lg hover:bg-white/5">
                        <i class="fas fa-book text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                        <span>Publicações</span>
                        <div
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-yellow-500 to-yellow-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                        </div>
                    </a>

                    <a href="/contacto"
                        class="group relative px-6 py-3 text-white/90 hover:text-yellow-400 font-medium flex items-center space-x-2 focus:outline-none focus:text-yellow-400 transition-all duration-300 rounded-lg hover:bg-white/5">
                        <i class="fas fa-envelope text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                        <span>Contacto</span>
                        <div
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-yellow-500 to-yellow-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                        </div>
                    </a>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 transform -translate-y-4 scale-95" id="mobile-menu"
                class="md:hidden bg-black rounded-xl mt-4 p-4 border border-white/10 shadow-2xl" role="menu"
                aria-label="Menu mobile">

                <ul class="flex flex-col space-y-2">
                    <li class="relative">
                        <button @click="mobileSobreOpen = !mobileSobreOpen"
                            class="w-full text-left flex justify-between items-center px-4 py-3 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                            :aria-expanded="mobileSobreOpen" aria-controls="mobile-sobre-menu">
                            <div class="flex items-center space-x-3">
                                <i
                                    class="fas fa-info-circle text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                                <span class="text-white/90 group-hover:text-yellow-400 transition-colors">Sobre</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200 text-yellow-500/80"
                                :class="{'rotate-180': mobileSobreOpen}"></i>
                        </button>
                        <ul x-show="mobileSobreOpen" x-transition id="mobile-sobre-menu"
                            class="pl-4 mt-2 space-y-1 bg-black/50 rounded-lg p-2" role="menu">
                            <li>
                                <a href="/declaracao-de-fe"
                                    class="flex items-center space-x-3 px-4 py-2 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                                    role="menuitem">
                                    <i class="fas fa-cross text-yellow-500/70 text-sm"></i>
                                    <span class="text-white/80 group-hover:text-yellow-400 transition-colors">Declaração
                                        de Fé</span>
                                </a>
                            </li>
                            <li>
                                <a href="/sobre-imgd"
                                    class="flex items-center space-x-3 px-4 py-2 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                                    role="menuitem">
                                    <i class="fas fa-church text-yellow-500/70 text-sm"></i>
                                    <span
                                        class="text-white/80 group-hover:text-yellow-400 transition-colors">IMGD</span>
                                </a>
                            </li>
                            <li>
                                <a href="/apostolo-jeque"
                                    class="flex items-center space-x-3 px-4 py-2 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                                    role="menuitem">
                                    <i class="fas fa-user-circle text-yellow-500/70 text-sm"></i>
                                    <span class="text-white/80 group-hover:text-yellow-400 transition-colors">AP.
                                        Jeque</span>
                                </a>
                            </li>
                            <li>
                                <a href="/acao-social"
                                    class="flex items-center space-x-3 px-4 py-2 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                                    role="menuitem">
                                    <i class="fas fa-hands-helping text-yellow-500/70 text-sm"></i>
                                    <span class="text-white/80 group-hover:text-yellow-400 transition-colors">Acção
                                        Social</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="/eventos"
                            class="flex items-center space-x-3 px-4 py-3 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                            role="menuitem">
                            <i
                                class="fas fa-calendar-alt text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                            <span class="text-white/90 group-hover:text-yellow-400 transition-colors">Eventos</span>
                        </a>
                    </li>
                    <li>
                        <a href="/sermoes"
                            class="flex items-center space-x-3 px-4 py-3 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                            role="menuitem">
                            <i
                                class="fas fa-podcast text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                            <span class="text-white/90 group-hover:text-yellow-400 transition-colors">Mensagens</span>
                        </a>
                    </li>
                    <li>
                        <a href="/blog"
                            class="flex items-center space-x-3 px-4 py-3 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                            role="menuitem">
                            <i class="fas fa-book text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                            <span class="text-white/90 group-hover:text-yellow-400 transition-colors">Publicações</span>
                        </a>
                    </li>
                    <li>
                        <a href="/contacto"
                            class="flex items-center space-x-3 px-4 py-3 bg-white/5 hover:bg-white/10 focus:bg-white/10 focus:outline-none transition-all duration-300 rounded-lg group"
                            role="menuitem">
                            <i
                                class="fas fa-envelope text-yellow-500/80 group-hover:text-yellow-400 transition-colors"></i>
                            <span class="text-white/90 group-hover:text-yellow-400 transition-colors">Contacto</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- ================> Header section end here <================== -->

<script>
    // Sticky Main Navigation - Improved version
    document.addEventListener('DOMContentLoaded', function () {
        const nav = document.getElementById('main-nav');
        const offsetTop = nav.offsetTop;
        let ticking = false;

        function updateStickyNav() {
            const isScrolled = window.scrollY > offsetTop;
            if (isScrolled) {
                nav.classList.add('fixed', 'top-0', 'left-0', 'right-0', 'animate-slideDown');
                nav.style.backdropFilter = 'blur(12px)';
            } else {
                nav.classList.remove('fixed', 'top-0', 'left-0', 'right-0', 'animate-slideDown');
                nav.style.backdropFilter = 'blur(8px)';
            }
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateStickyNav);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick, { passive: true });

        // Initial check
        updateStickyNav();
    });
</script>

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
        animation: slideDown 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Smooth scrolling for better UX */
    html {
        scroll-behavior: smooth;
    }

    /* Custom scrollbar for webkit browsers */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #1f2937;
    }

    ::-webkit-scrollbar-thumb {
        background: #f59e0b;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #d97706;
    }

    /* Logo image optimization */
    .logo-image {
        filter: brightness(0) invert(1);
        /* Makes logo white */
        transition: all 0.3s ease;
    }

    .group:hover .logo-image {
        filter: brightness(0) invert(79%) sepia(53%) saturate(576%) hue-rotate(360deg);
        /* Yellow on hover */
    }

    /* Mobile logo adjustments */
    @media (max-width: 768px) {
        .header-logo {
            max-width: 120px;
        }
    }
</style>