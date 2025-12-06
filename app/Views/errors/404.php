<?php
ob_start();
?>

<!-- Breadcrumb -->
<nav class="bg-gray-50 py-4 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li>
                <a href="/" class="hover:text-yellow-600 transition-colors duration-200 flex items-center">
                    <i class="fas fa-home mr-2 text-yellow-500"></i>
                    Início
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <span class="text-gray-900 font-medium">Erro 404</span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Error Icon -->
            <div class="w-32 h-32 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-8">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-5xl"></i>
            </div>

            <!-- Error Message -->
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Página Não Encontrada
            </h2>

            <div class="w-24 h-1 bg-gradient-to-r from-yellow-500 to-yellow-600 mx-auto mb-8 rounded-full"></div>

            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                A página que você está procurando não existe ou foi movida.
                Verifique o URL ou navegue pelas opções acima.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="/"
                    class="inline-flex items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl group">
                    <i class="fas fa-home mr-3 group-hover:scale-110 transition-transform"></i>
                    Página Inicial
                </a>

                <a href="/contacto"
                    class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl group">
                    <i class="fas fa-envelope mr-3 group-hover:scale-110 transition-transform"></i>
                    Contactar Suporte
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Modules/Shared/Views/layout_public.php";
?>