<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Login - Painel Administrativo') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
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
    <div class="login-card rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-white/20 fade-in">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-center text-white">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-lock text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold">Painel Administrativo</h1>
            <p class="text-blue-100 text-sm mt-2">Faça login para continuar</p>
        </div>

        <div class="p-8">
            <!-- Alertas -->
            <?php if (!empty($error)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3 shake">
                    <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                    <div class="flex-1">
                        <p class="text-red-800 text-sm font-medium"><?= htmlspecialchars($error) ?></p>
                        <?php if (isset($tentativasRestantes) && $tentativasRestantes > 0): ?>
                            <p class="text-red-600 text-xs mt-1">
                                Tentativas restantes: <strong><?= $tentativasRestantes ?></strong>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($warning)): ?>
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg flex items-start gap-3">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5"></i>
                    <p class="text-yellow-800 text-sm"><?= htmlspecialchars($warning) ?></p>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['timeout'])): ?>
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-start gap-3">
                    <i class="fas fa-clock text-blue-500 mt-0.5"></i>
                    <p class="text-blue-800 text-sm">Sessão expirada. Faça login novamente.</p>
                </div>
            <?php endif; ?>

            <!-- Formulário -->
            <form method="post" class="space-y-6" id="loginForm">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-2"></i>E-mail
                    </label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($email ?? '') ?>" required
                        autocomplete="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400"
                        placeholder="seu@email.com">
                </div>

                <div>
                    <label for="senha" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-2"></i>Senha
                    </label>
                    <div class="relative">
                        <input type="password" name="senha" id="senha" required autocomplete="current-password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 pr-10"
                            placeholder="Sua senha">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="lembrar" class="rounded text-blue-600 focus:ring-blue-500">
                        <span class="text-gray-600 select-none">Lembrar-me</span>
                    </label>
                    <a href="/admin/esqueci-senha"
                        class="text-blue-600 hover:text-blue-800 transition-colors font-medium">
                        Esqueceu a senha?
                    </a>
                </div>

                <button type="submit" id="submitBtn"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg shadow-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span id="submitText">Entrar no Sistema</span>
                    <div id="loadingSpinner" class="hidden">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </button>
            </form>

            <!-- Informações de segurança -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <i class="fas fa-shield-alt text-green-500"></i>
                    <span>Sistema protegido com autenticação segura</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('senha');
            const icon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }

        // Prevenir múltiplos envios
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            submitBtn.disabled = true;
            submitText.textContent = 'Entrando...';
            loadingSpinner.classList.remove('hidden');
        });

        // Foco no campo email
        document.getElementById('email')?.focus();
    </script>
</body>

</html>