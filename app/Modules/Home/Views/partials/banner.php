<!-- Hero / Banner -->
<section class="relative h-screen overflow-hidden">
    <!-- Imagem como background -->
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full">
            <img src="/assets/img/imgd.jpeg" alt="Igreja Ministério da Graça de Deus"
                class="w-full h-full object-cover sm:object-cover scale-100" loading="lazy">
        </div>
    </div>

    <!-- Overlay escuro para melhor contraste -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Conteúdo principal - movido para o final -->
    <div class="container mx-auto px-4 h-full flex items-end pb-16 relative z-10">
        <div class="max-w-4xl text-white w-full">
            <h1 class="text-4xl sm:text-5xl font-extrabold mb-6 leading-tight animate-fade-in-up">
                Bem-vindo à <br><span class="text-yellow-400">Igreja Ministério da Graça de Deus</span>
            </h1>
        </div>
    </div>
</section>

<!-- Adicione estas animações no seu CSS -->
<style>
    @keyframes fade-in-up {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 3s ease-out forwards;
    }
</style>