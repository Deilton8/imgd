<!-- ===== IMPROVED: countdown.php ===== -->
<?php if (!empty($proximo_evento)): ?>
    <?php
    $dataEvento = new DateTime($proximo_evento['data_inicio']);
    $dataAtual = new DateTime();
    $diferenca = $dataAtual->diff($dataEvento);
    $diasRestantes = $diferenca->days;
    $horasRestantes = $diferenca->h;
    $minutosRestantes = $diferenca->i;
    $segundosRestantes = $diferenca->s;
    $totalSegundos = $diferenca->days * 86400 + $diferenca->h * 3600 + $diferenca->i * 60 + $diferenca->s;

    // Calcular progresso baseado na duração total do evento (se disponível)
    $duracaoEvento = isset($proximo_evento['duracao_dias']) ? $proximo_evento['duracao_dias'] * 86400 : 2592000; // Padrão: 30 dias
    $progresso = max(0, min(100, 100 - ($totalSegundos / $duracaoEvento * 100)));

    // Status do evento
    $eventoStatus = 'futuro';
    if ($totalSegundos < 0) {
        $eventoStatus = 'passado';
    } elseif ($totalSegundos < 86400) { // Menos de 24h
        $eventoStatus = 'proximo';
    }
    ?>

    <!-- Countdown com acessibilidade aprimorada -->
    <div class="bg-gradient-to-br from-yellow-900 via-yellow-600 to-yellow-900 rounded-2xl p-6 md:p-8 text-white shadow-xl border border-yellow-400/30 hover:shadow-2xl transition-all duration-500 group relative overflow-hidden"
        role="region" aria-labelledby="evento-titulo" data-status="<?= $eventoStatus ?>">
        <!-- Elementos decorativos -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full translate-y-12 -translate-x-12"></div>

        <div class="relative z-10">
            <!-- Header do Evento -->
            <header class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-8">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar text-white text-lg" aria-hidden="true"></i>
                        </div>
                        <h4 id="evento-titulo" class="font-bold text-xl text-white">
                            Próximo Evento <span class="text-yellow-200">Destacado</span>
                        </h4>
                    </div>

                    <h5
                        class="font-bold text-2xl md:text-3xl mb-3 text-white group-hover:text-yellow-50 transition-colors leading-tight">
                        <?php echo htmlspecialchars($proximo_evento['titulo']); ?>
                    </h5>

                    <div class="flex flex-wrap items-center gap-4 text-yellow-100 text-sm">
                        <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full">
                            <i class="fas fa-map-marker-alt text-yellow-300 text-xs" aria-hidden="true"></i>
                            <span><?php echo htmlspecialchars($proximo_evento['local']); ?></span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full">
                            <i class="fas fa-clock text-yellow-300 text-xs" aria-hidden="true"></i>
                            <time datetime="<?php echo $proximo_evento['data_inicio']; ?>">
                                <?php echo $dataEvento->format('d/m/Y \à\s H:i'); ?>
                            </time>
                        </div>
                        <?php if (!empty($proximo_evento['duracao'])): ?>
                            <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full">
                                <i class="fas fa-hourglass-half text-yellow-300 text-xs" aria-hidden="true"></i>
                                <span><?php echo htmlspecialchars($proximo_evento['duracao']); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="flex-shrink-0">
                    <span
                        class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold">
                        <?php if ($eventoStatus === 'proximo'): ?>
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Em Breve
                        <?php elseif ($eventoStatus === 'passado'): ?>
                            <i class="fas fa-check-circle text-green-300"></i>
                            Realizado
                        <?php else: ?>
                            <i class="fas fa-calendar-check text-yellow-300"></i>
                            Agendado
                        <?php endif; ?>
                    </span>
                </div>
            </header>

            <!-- Countdown Principal -->
            <div class="mb-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" role="timer" aria-live="polite"
                    aria-label="Contagem regressiva para o evento">
                    <!-- Dias -->
                    <div class="text-center">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 transition-all duration-300 hover:bg-white/20 hover:scale-105"
                            data-unit="days">
                            <div id="compact-days"
                                class="text-4xl md:text-5xl font-bold text-yellow-300 font-mono transition-all duration-500">
                                <?php echo str_pad($diasRestantes, 2, '0', STR_PAD_LEFT); ?>
                            </div>
                            <div class="text-yellow-200 text-sm font-medium mt-2">Dias</div>
                        </div>
                    </div>

                    <!-- Horas -->
                    <div class="text-center">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 transition-all duration-300 hover:bg-white/20 hover:scale-105"
                            data-unit="hours">
                            <div id="compact-hours"
                                class="text-4xl md:text-5xl font-bold text-yellow-300 font-mono transition-all duration-500">
                                <?php echo str_pad($horasRestantes, 2, '0', STR_PAD_LEFT); ?>
                            </div>
                            <div class="text-yellow-200 text-sm font-medium mt-2">Horas</div>
                        </div>
                    </div>

                    <!-- Minutos -->
                    <div class="text-center">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 transition-all duration-300 hover:bg-white/20 hover:scale-105"
                            data-unit="minutes">
                            <div id="compact-minutes"
                                class="text-4xl md:text-5xl font-bold text-yellow-300 font-mono transition-all duration-500">
                                <?php echo str_pad($minutosRestantes, 2, '0', STR_PAD_LEFT); ?>
                            </div>
                            <div class="text-yellow-200 text-sm font-medium mt-2">Minutos</div>
                        </div>
                    </div>

                    <!-- Segundos -->
                    <div class="text-center">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 transition-all duration-300 hover:bg-white/20 hover:scale-105"
                            data-unit="seconds">
                            <div id="compact-seconds"
                                class="text-4xl md:text-5xl font-bold text-yellow-300 font-mono transition-all duration-500">
                                <?php echo str_pad($segundosRestantes, 2, '0', STR_PAD_LEFT); ?>
                            </div>
                            <div class="text-yellow-200 text-sm font-medium mt-2">Segundos</div>
                        </div>
                    </div>
                </div>

                <!-- Progresso -->
                <div class="mt-8">
                    <div class="flex justify-between text-yellow-200 text-sm mb-2">
                        <span>Tempo restante</span>
                        <span id="countdown-percentage" class="font-semibold"><?php echo round($progresso); ?>%</span>
                    </div>
                    <div class="w-full bg-black/10 rounded-full h-2 overflow-hidden">
                        <div id="countdown-progress"
                            class="bg-gradient-to-r from-yellow-300 to-yellow-600 h-2 rounded-full transition-all duration-1000 ease-out"
                            style="width: <?php echo $progresso; ?>%" role="progressbar"
                            aria-valuenow="<?php echo $progresso; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="flex justify-between text-yellow-200/70 text-xs mt-1">
                        <span>Início do Evento</span>
                        <span><?php echo $dataEvento->format('d/m/Y \à\s H:i'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-between pt-6 border-t border-white/20">
                <div class="flex items-center gap-3 text-yellow-100">
                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="text-sm">
                        <div class="font-semibold">Participe Conosco</div>
                        <div class="opacity-80">Evento aberto ao público</div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="/evento/<?php echo $proximo_evento['slug']; ?>"
                        class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-xl font-semibold backdrop-blur-sm hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 group/btn border border-white/30"
                        aria-label="Ver detalhes do evento <?php echo htmlspecialchars($proximo_evento['titulo']); ?>">
                        <i class="fas fa-info-circle group-hover/btn:scale-110 transition-transform" aria-hidden="true"></i>
                        Detalhes
                        <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"
                            aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        class EventCountdown {
            constructor() {
                this.eventDate = new Date('<?php echo $proximo_evento['data_inicio']; ?>').getTime();
                this.timeUnits = ['days', 'hours', 'minutes', 'seconds'];
                this.interval = null;
                this.audioContext = null;
                this.isPlayingSound = false;

                this.init();
            }

            init() {
                // Inicializar contador
                this.updateCountdown();

                // Configurar intervalo de atualização
                this.interval = setInterval(() => this.updateCountdown(), 1000);

                // Configurar interações
                this.setupInteractions();

                // Configurar notificações
                this.setupNotifications();
            }

            updateCountdown() {
                const now = new Date().getTime();
                const distance = this.eventDate - now;

                // Se o evento já passou
                if (distance < 0) {
                    this.handleEventPast();
                    return;
                }

                // Calcular unidades de tempo
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Atualizar elementos com animação
                this.updateUnit('compact-days', days);
                this.updateUnit('compact-hours', hours);
                this.updateUnit('compact-minutes', minutes);
                this.updateUnit('compact-seconds', seconds);

                // Atualizar progresso
                this.updateProgress(distance);

                // Verificar notificações
                this.checkNotifications(distance);

                // Atualizar status
                this.updateStatus(distance);
            }

            updateUnit(elementId, newValue) {
                const element = document.getElementById(elementId);
                if (!element) return;

                const oldValue = parseInt(element.textContent);
                const formattedValue = newValue.toString().padStart(2, '0');

                // Apenas animar se o valor mudou
                if (oldValue !== newValue) {
                    // Efeito de animação
                    element.style.transform = 'scale(1.1)';
                    element.style.opacity = '0.7';

                    setTimeout(() => {
                        element.textContent = formattedValue;
                        element.style.transform = 'scale(1)';
                        element.style.opacity = '1';

                        // Efeito de destaque
                        element.style.textShadow = '0 0 15px rgba(245, 158, 11, 0.5)';
                        setTimeout(() => {
                            element.style.textShadow = 'none';
                        }, 500);

                    }, 150);
                } else {
                    element.textContent = formattedValue;
                }
            }

            updateProgress(distance) {
                const progressBar = document.getElementById('countdown-progress');
                const percentageText = document.getElementById('countdown-percentage');

                if (!progressBar || !percentageText) return;

                // Calcular progresso (baseado em 30 dias)
                const totalDuration = <?php echo $duracaoEvento; ?> * 1000; // Converter para milissegundos
                const progress = Math.max(0, Math.min(100, 100 - (distance / totalDuration * 100)));

                // Animar a barra de progresso
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', Math.round(progress));
                percentageText.textContent = `${Math.round(progress)}%`;

                // Mudar cor baseada no progresso
                if (progress > 75) {
                    progressBar.className = 'bg-gradient-to-r from-yellow-700 to-yellow-800 h-2 rounded-full transition-all duration-1000 ease-out';
                } else if (progress > 50) {
                    progressBar.className = 'bg-gradient-to-r from-yellow-500 to-yellow-600 h-2 rounded-full transition-all duration-1000 ease-out';
                } else if (progress > 25) {
                    progressBar.className = 'bg-gradient-to-r from-yellow-300 to-yellow-400 h-2 rounded-full transition-all duration-1000 ease-out';
                } else {
                    progressBar.className = 'bg-gradient-to-r from-yellow-100 to-yellow-200 h-2 rounded-full transition-all duration-1000 ease-out';
                }
            }

            updateStatus(distance) {
                const container = document.querySelector('[data-status]');
                if (!container) return;

                // Atualizar status
                let newStatus = 'futuro';
                if (distance < 0) {
                    newStatus = 'passado';
                } else if (distance < 86400000) { // Menos de 24h
                    newStatus = 'proximo';
                }

                if (container.dataset.status !== newStatus) {
                    container.dataset.status = newStatus;
                    this.updateStatusUI(newStatus);
                }
            }

            updateStatusUI(status) {
                // Atualizar badge de status
                const badge = document.querySelector('.inline-flex.items-center.gap-2');
                if (!badge) return;

                switch (status) {
                    case 'proximo':
                        badge.innerHTML = `
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Em Breve
                        `;
                        break;
                    case 'passado':
                        badge.innerHTML = `
                            <i class="fas fa-check-circle text-green-300"></i>
                            Realizado
                        `;
                        break;
                    default:
                        badge.innerHTML = `
                            <i class="fas fa-calendar-check text-yellow-300"></i>
                            Agendado
                        `;
                }
            }

            checkNotifications(distance) {
                // Notificar quando faltar 1 hora
                if (distance > 0 && distance <= 3600000 && !this.isPlayingSound) {
                    this.playNotificationSound();
                    this.showNotification('Falta 1 hora para o evento!');
                    this.isPlayingSound = true;
                }

                // Notificar quando faltar 15 minutos
                if (distance > 0 && distance <= 900000 && !this.isPlayingSound) {
                    this.playNotificationSound();
                    this.showNotification('Falta 15 minutos para o evento!');
                    this.isPlayingSound = true;
                }
            }

            playNotificationSound() {
                try {
                    if (!window.AudioContext) return;

                    if (!this.audioContext) {
                        this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    }

                    const oscillator = this.audioContext.createOscillator();
                    const gainNode = this.audioContext.createGain();

                    oscillator.connect(gainNode);
                    gainNode.connect(this.audioContext.destination);

                    oscillator.frequency.value = 880;
                    oscillator.type = 'sine';

                    gainNode.gain.setValueAtTime(0.3, this.audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, this.audioContext.currentTime + 1);

                    oscillator.start(this.audioContext.currentTime);
                    oscillator.stop(this.audioContext.currentTime + 1);

                    setTimeout(() => {
                        this.isPlayingSound = false;
                    }, 2000);

                } catch (error) {
                    console.warn('Audio notification not supported:', error);
                }
            }

            showNotification(message) {
                // Verificar permissões de notificação
                if (!("Notification" in window)) return;

                if (Notification.permission === "granted") {
                    new Notification("Evento IMGD", {
                        body: message,
                        icon: "/assets/img/logo.png"
                    });
                } else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            new Notification("Evento IMGD", {
                                body: message,
                                icon: "/assets/img/logo.png"
                            });
                        }
                    });
                }
            }

            handleEventPast() {
                clearInterval(this.interval);

                // Atualizar interface para evento passado
                document.querySelector('[data-status]').dataset.status = 'passado';
                this.updateStatusUI('passado');

                // Mostrar mensagem de evento em andamento
                const pastEventMessage = `
                    <div class="mt-4 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg border border-green-400/30">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-play-circle text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-xl mb-1">Evento em Andamento!</h4>
                                <p class="text-green-100 mb-3">O evento já começou. Junte-se a nós!</p>
                            </div>
                            <a href="/eventos/<?php echo $proximo_evento['id']; ?>/transmissao" 
                               class="inline-flex items-center gap-2 bg-white text-green-700 px-6 py-3 rounded-xl font-semibold hover:bg-green-50 transition-all shadow-md hover:shadow-lg">
                                <i class="fas fa-video"></i>
                                Assistir Agora
                            </a>
                        </div>
                    </div>
                `;

                const container = document.querySelector('[data-status]').parentNode;
                container.insertAdjacentHTML('beforeend', pastEventMessage);
            }

            setupInteractions() {
                // Adicionar interatividade às unidades de tempo
                this.timeUnits.forEach(unit => {
                    const elements = document.querySelectorAll(`[data-unit="${unit}"]`);
                    elements.forEach(element => {
                        element.addEventListener('click', () => {
                            this.zoomUnit(unit);
                        });

                        element.addEventListener('keypress', (e) => {
                            if (e.key === 'Enter' || e.key === ' ') {
                                this.zoomUnit(unit);
                            }
                        });
                    });
                });
            }

            zoomUnit(unit) {
                const element = document.querySelector(`[data-unit="${unit}"]`);
                if (!element) return;

                element.style.transform = 'scale(1.15)';
                setTimeout(() => {
                    element.style.transform = '';
                }, 300);

                // Feedback tátil (se suportado)
                if (navigator.vibrate) {
                    navigator.vibrate(50);
                }
            }

            setupNotifications() {
                // Pedir permissão para notificações
                if ("Notification" in window && Notification.permission === "default") {
                    setTimeout(() => {
                        Notification.requestPermission();
                    }, 3000);
                }
            }

            destroy() {
                clearInterval(this.interval);
                if (this.audioContext) {
                    this.audioContext.close();
                }
            }
        }

        // Inicializar quando o DOM estiver pronto
        document.addEventListener('DOMContentLoaded', function () {
            const countdown = new EventCountdown();

            // Salvar referência para limpeza
            window.eventCountdown = countdown;

            // Limpar ao sair da página
            window.addEventListener('beforeunload', () => {
                countdown.destroy();
            });
        });
    </script>

    <style>
        /* Animações otimizadas */
        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
            }

            50% {
                box-shadow: 0 0 25px rgba(255, 255, 255, 0.4);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-5px) scale(1.05);
            }
        }

        .bg-gradient-to-br {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        [data-status="proximo"] .bg-gradient-to-br {
            animation: pulse-glow 1.5s ease-in-out infinite;
        }

        /* Efeitos de hover */
        [data-unit]:hover {
            cursor: pointer;
            animation: float 0.5s ease-in-out;
        }

        /* Melhorar legibilidade */
        #compact-days,
        #compact-hours,
        #compact-minutes,
        #compact-seconds {
            font-variant-numeric: tabular-nums;
            font-feature-settings: "tnum";
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .grid-cols-4 {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .text-4xl {
                font-size: 2rem;
            }

            .text-5xl {
                font-size: 2.5rem;
            }

            .flex-col.sm\:flex-row {
                flex-direction: column;
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .grid-cols-4 {
                grid-template-columns: 1fr;
            }
        }

        /* Acessibilidade */
        [data-unit]:focus {
            outline: 3px solid rgba(255, 255, 255, 0.8);
            outline-offset: 2px;
            border-radius: 8px;
        }
    </style>
<?php endif; ?>