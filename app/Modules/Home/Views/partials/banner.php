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

    <!-- Conteúdo principal -->
    <div class="container mx-auto px-4 h-full flex items-end pb-16 relative z-10">
        <div class="max-w-4xl text-white w-full">
            <h1 class="text-4xl sm:text-5xl font-extrabold mb-6 leading-tight animate-fade-in-up">
                Bem-vindo à <br>
                <span id="typewriter-text" class="text-yellow-400"></span>
                <span id="typewriter-cursor" class="ml-1 opacity-100 text-yellow-400">|</span>
            </h1>
        </div>
    </div>
</section>

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

    @keyframes cursor-blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }
    }

    .cursor-blink {
        animation: cursor-blink 0.5s infinite;
    }
</style>

<script>
    class TextType {
        constructor(options = {}) {
            this.element = options.element || document.getElementById('typewriter-text');
            this.cursorElement = options.cursorElement || document.getElementById('typewriter-cursor');
            this.texts = options.texts || ['Igreja Ministério da Graça de Deus'];
            this.typingSpeed = options.typingSpeed || 50;
            this.deletingSpeed = options.deletingSpeed || 30;
            this.pauseDuration = options.pauseDuration || 2000;
            this.loop = options.loop !== false;
            this.initialDelay = options.initialDelay || 0;
            this.showCursor = options.showCursor !== false;
            this.cursorBlinkDuration = options.cursorBlinkDuration || 0.5;
            this.reverseMode = options.reverseMode || false;
            this.textColors = options.textColors || [];

            this.displayedText = '';
            this.currentCharIndex = 0;
            this.isDeleting = false;
            this.currentTextIndex = 0;
            this.isVisible = true;
            this.timeout = null;

            this.init();
        }

        init() {
            if (!this.element) return;

            // Configurar cursor
            if (this.showCursor && this.cursorElement) {
                this.cursorElement.style.animation = `cursor-blink ${this.cursorBlinkDuration}s infinite`;
            }

            // Iniciar animação
            setTimeout(() => {
                this.type();
            }, this.initialDelay);
        }

        type() {
            clearTimeout(this.timeout);

            const currentText = this.texts[this.currentTextIndex];
            const processedText = this.reverseMode ?
                currentText.split('').reverse().join('') :
                currentText;

            if (this.isDeleting) {
                // Modo deletando
                if (this.displayedText === '') {
                    this.isDeleting = false;

                    // Avançar para o próximo texto
                    this.currentTextIndex = (this.currentTextIndex + 1) % this.texts.length;
                    this.currentCharIndex = 0;

                    // Pausar antes de começar a digitar novamente
                    this.timeout = setTimeout(() => this.type(), this.pauseDuration);
                    return;
                }

                // Remover caractere
                this.timeout = setTimeout(() => {
                    this.displayedText = this.displayedText.slice(0, -1);
                    this.element.textContent = this.displayedText;
                    this.type();
                }, this.deletingSpeed);

            } else {
                // Modo digitando
                if (this.currentCharIndex < processedText.length) {
                    this.timeout = setTimeout(() => {
                        this.displayedText += processedText[this.currentCharIndex];
                        this.element.textContent = this.displayedText;

                        // Aplicar cor se especificado
                        if (this.textColors.length > 0) {
                            const color = this.textColors[this.currentTextIndex % this.textColors.length];
                            if (color) {
                                this.element.style.color = color;
                            }
                        }

                        this.currentCharIndex++;
                        this.type();
                    }, this.typingSpeed);

                } else {
                    // Texto completo, pausar antes de deletar
                    if (this.loop || this.currentTextIndex < this.texts.length - 1) {
                        this.timeout = setTimeout(() => {
                            this.isDeleting = true;
                            this.type();
                        }, this.pauseDuration);
                    }
                }
            }
        }

        destroy() {
            clearTimeout(this.timeout);
            if (this.cursorElement) {
                this.cursorElement.style.animation = '';
            }
        }
    }

    // Inicializar quando o DOM estiver pronto
    document.addEventListener('DOMContentLoaded', function () {
        const typewriter = new TextType({
            element: document.getElementById('typewriter-text'),
            cursorElement: document.getElementById('typewriter-cursor'),
            texts: [
                'Igreja Ministério da Graça de Deus'
            ],
            typingSpeed: 60,
            deletingSpeed: 40,
            pauseDuration: 1500,
            loop: true,
            initialDelay: 1000,
            textColors: ['#fbbf24'] // Cores diferentes para cada texto
        });

        // Opcional: destruir quando sair da seção
        // window.addEventListener('beforeunload', () => typewriter.destroy());
    });
</script>