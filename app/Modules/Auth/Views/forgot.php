<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Recuperar Senha - Painel Administrativo') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .success-gradient {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="h-full gradient-bg flex items-center justify-center p-4">
    <div class="card rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-white/20 fade-in">
        <!-- Header -->
        <div class="success-gradient p-6 text-center text-white">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-key text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold">Recuperar Senha</h1>
            <p class="text-green-100 text-sm mt-2">Vamos te ajudar a recuperar o acesso</p>
        </div>

        <div class="p-8">
            <!-- Alertas -->
            <?php if (!empty($error)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                    <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                    <div class="flex-1">
                        <p class="text-red-800 text-sm font-medium"><?= htmlspecialchars($error) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-start gap-3 mb-3">
                        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                        <div class="flex-1">
                            <p class="text-green-800 text-sm font-medium"><?= htmlspecialchars($success) ?></p>
                        </div>
                    </div>

                    <?php if (!empty($debug_link)): ?>
                        <div class="mt-4 p-3 bg-green-100 rounded-lg border border-green-200">
                            <p class="text-green-700 text-xs font-medium mb-2">
                                <i class="fas fa-info-circle mr-1"></i>Link de desenvolvimento:
                            </p>
                            <code
                                class="text-green-800 text-xs break-all bg-green-50 p-2 rounded border border-green-200 block">
                                                <?= htmlspecialchars($debug_link) ?>
                                            </code>
                        </div>
                    <?php endif; ?>

                    <div class="mt-4 flex items-center gap-2 text-green-700 text-sm">
                        <i class="fas fa-clock"></i>
                        <span>O link expira em 2 horas</span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (empty($success)): ?>
                <!-- Instruções -->
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                        <div class="flex-1">
                            <p class="text-blue-800 text-sm">
                                Digite seu e-mail cadastrado. Enviaremos um link para redefinir sua senha.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Formulário -->
                <form method="post" class="space-y-6" id="forgotForm">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>E-mail cadastrado
                        </label>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email ?? '') ?>" required
                            autocomplete="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 placeholder-gray-400"
                            placeholder="seu@email.com">
                    </div>

                    <button type="submit" id="submitBtn"
                        class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 rounded-lg shadow-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
                        <i class="fas fa-paper-plane"></i>
                        <span id="submitText">Enviar Link de Recuperação</span>
                        <div id="loadingSpinner" class="hidden">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </button>
                </form>
            <?php endif; ?>

            <!-- Ações -->
            <div class="mt-6 space-y-3">
                <a href="/admin/login"
                    class="w-full inline-flex items-center justify-center gap-2 text-gray-600 hover:text-gray-800 transition-colors font-medium py-2">
                    <i class="fas fa-arrow-left"></i>
                    Voltar para o login
                </a>

                <?php if (!empty($success)): ?>
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 text-center">
                        <p class="text-gray-600 text-sm">
                            Não recebeu o e-mail?
                            <a href="/admin/esqueci-senha" class="text-green-600 hover:text-green-800 font-medium">
                                Solicitar novo link
                            </a>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Informações de segurança -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                    <i class="fas fa-shield-alt text-green-500"></i>
                    <span>Proteção de conta ativada</span>
                </div>
                <ul class="text-xs text-gray-500 space-y-1">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Links de recuperação expiram em 2 horas</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Máximo de 3 solicitações por hora</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Notificação por e-mail segura</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Prevenir múltiplos envios
        document.getElementById('forgotForm')?.addEventListener('submit', function (e) {
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            if (submitBtn && submitText && loadingSpinner) {
                submitBtn.disabled = true;
                submitText.textContent = 'Enviando...';
                loadingSpinner.classList.remove('hidden');
            }
        });

        // Foco no campo email
        document.getElementById('email')?.focus();
    </script>
</body>

</html>