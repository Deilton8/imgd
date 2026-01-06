<?php if (!empty($proximo_evento)): ?>
    <?php
    $dataEvento = new DateTime($proximo_evento['data_inicio']);
    $dataFormatada = $dataEvento->format('d/m/Y');
    ?>
    <div
        class="bg-gradient-to-br from-yellow-600 via-yellow-600 to-yellow-700 rounded-2xl p-6 text-white shadow-lg border border-yellow-500/30 hover:shadow-xl transition-all duration-300 group">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
            <!-- Informações do Evento -->
            <div class="text-center lg:text-left flex-1">
                <div class="flex items-center justify-center lg:justify-start gap-2 mb-3">
                    <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-white text-sm"></i>
                    </div>
                    <h4 class="font-bold text-xl text-yellow-100">Próximo Evento</h4>
                </div>

                <h5 class="font-bold text-2xl mb-2 text-white group-hover:text-yellow-50 transition-colors">
                    <?php echo htmlspecialchars($proximo_evento['titulo']); ?>
                </h5>

                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 text-yellow-100 text-sm">
                    <div class="flex items-center gap-1">
                        <i class="fas fa-map-marker-alt text-yellow-300 text-xs"></i>
                        <span><?php echo htmlspecialchars($proximo_evento['local']); ?></span>
                    </div>
                    <div class="flex items-center gap-1">
                        <i class="fas fa-clock text-yellow-300 text-xs"></i>
                        <span><?php echo $dataFormatada ?></span>
                    </div>
                </div>
            </div>

            <!-- Countdown -->
            <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-yellow-400/30">
                <div class="text-center min-w-[60px]">
                    <div id="compact-days" class="text-3xl font-bold text-yellow-300 transition-all duration-300">00</div>
                    <div class="text-yellow-200 text-xs font-medium mt-1">Dias</div>
                </div>

                <div class="text-yellow-400 text-lg font-bold">:</div>

                <div class="text-center min-w-[60px]">
                    <div id="compact-hours" class="text-3xl font-bold text-yellow-300 transition-all duration-300">00</div>
                    <div class="text-yellow-200 text-xs font-medium mt-1">Horas</div>
                </div>

                <div class="text-yellow-400 text-lg font-bold">:</div>

                <div class="text-center min-w-[60px]">
                    <div id="compact-minutes" class="text-3xl font-bold text-yellow-300 transition-all duration-300">00
                    </div>
                    <div class="text-yellow-200 text-xs font-medium mt-1">Minutos</div>
                </div>

                <div class="text-yellow-400 text-lg font-bold hidden sm:block">:</div>

                <div class="text-center min-w-[60px] hidden sm:block">
                    <div id="compact-seconds" class="text-3xl font-bold text-yellow-300 transition-all duration-300">00
                    </div>
                    <div class="text-yellow-200 text-xs font-medium mt-1">Segundos</div>
                </div>
            </div>

            <!-- Botão de Ação -->
            <div class="flex-shrink-0">
                <a href="/evento/<?php echo $proximo_evento['slug']; ?>"
                    class="inline-flex items-center gap-2 bg-white text-yellow-700 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-50 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 group/btn">
                    <i class="fas fa-info-circle group-hover/btn:scale-110 transition-transform"></i>
                    Detalhes
                    <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Progress Bar (Opcional) -->
        <div class="mt-4">
            <div class="flex justify-between text-yellow-200 text-xs mb-1">
                <span>Tempo restante</span>
                <span id="countdown-percentage">100%</span>
            </div>
            <div class="w-full bg-yellow-700/50 rounded-full h-2">
                <div id="countdown-progress" class="bg-yellow-300 h-2 rounded-full transition-all duration-1000 ease-out"
                    style="width: 100%"></div>
            </div>
        </div>
    </div>

    <script>
        function updateCompactCountdown() {
            const eventDate = new Date('<?php echo $proximo_evento['data_inicio']; ?>').getTime();
            const now = new Date().getTime();
            const distance = eventDate - now;

            // Se o evento já passou
            if (distance < 0) {
                document.querySelector('.bg-gradient-to-br').innerHTML = `
            <div class="text-center py-4">
                <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-play text-white text-lg"></i>
                </div>
                <h4 class="font-bold text-xl text-white mb-2">Evento em Andamento!</h4>
                <p class="text-yellow-100 mb-4">Junte-se a nós neste momento especial.</p>
                <a href="/eventos/<?php echo $proximo_evento['id']; ?>" 
                   class="inline-flex items-center gap-2 bg-white text-yellow-700 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-50 transition-all">
                    <i class="fas fa-external-link-alt"></i>
                    Participar Agora
                </a>
            </div>
        `;
                return;
            }

            // Cálculos do tempo
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Animação suave dos números
            const animateValue = (element, newValue) => {
                const oldValue = parseInt(element.textContent);
                if (oldValue !== newValue) {
                    element.style.transform = 'scale(1.1)';
                    element.style.opacity = '0.7';
                    setTimeout(() => {
                        element.textContent = newValue.toString().padStart(2, '0');
                        element.style.transform = 'scale(1)';
                        element.style.opacity = '1';
                    }, 150);
                } else {
                    element.textContent = newValue.toString().padStart(2, '0');
                }
            };

            // Atualizar valores com animação
            animateValue(document.getElementById('compact-days'), days);
            animateValue(document.getElementById('compact-hours'), hours);
            animateValue(document.getElementById('compact-minutes'), minutes);

            if (document.getElementById('compact-seconds')) {
                animateValue(document.getElementById('compact-seconds'), seconds);
            }

            // Atualizar barra de progresso (opcional)
            const totalDuration = 30 * 24 * 60 * 60 * 1000; // 30 dias como referência
            const progress = Math.max(0, Math.min(100, 100 - (distance / totalDuration * 100)));
            const progressBar = document.getElementById('countdown-progress');
            const percentageText = document.getElementById('countdown-percentage');

            if (progressBar && percentageText) {
                progressBar.style.width = `${progress}%`;
                percentageText.textContent = `${Math.round(progress)}%`;
            }
        }

        // Inicializar e configurar intervalo
        document.addEventListener('DOMContentLoaded', function () {
            updateCompactCountdown();

            // Atualizar a cada segundo (mais preciso)
            setInterval(updateCompactCountdown, 1000);

            // Efeito de pulso suave nos números
            setInterval(() => {
                const numbers = document.querySelectorAll('#compact-days, #compact-hours, #compact-minutes, #compact-seconds');
                numbers.forEach(num => {
                    num.style.textShadow = '0 0 10px rgba(255, 255, 255, 0.3)';
                    setTimeout(() => {
                        num.style.textShadow = 'none';
                    }, 500);
                });
            }, 2000);
        });
    </script>

    <style>
        /* Animações CSS adicionais */
        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
            }

            50% {
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            }
        }

        .bg-gradient-to-br {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        /* Melhorar a legibilidade */
        #compact-days,
        #compact-hours,
        #compact-minutes,
        #compact-seconds {
            font-variant-numeric: tabular-nums;
            font-feature-settings: "tnum";
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
<?php endif; ?>