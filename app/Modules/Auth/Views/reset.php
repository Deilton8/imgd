<!DOCTYPE html>
<html lang="pt-BR" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Redefinir Senha - Painel Administrativo') ?></title>
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

        .warning-gradient {
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
        }

        .success-gradient {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        }

        .password-strength {
            height: 4px;
            transition: all 0.3s ease;
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

        <?php if (empty($success)): ?>
            <!-- Header para redefinição -->
            <div class="warning-gradient p-6 text-center text-white">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-redo-alt text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold">Nova Senha</h1>
                <p class="text-orange-100 text-sm mt-2">Crie uma nova senha segura</p>
            </div>
        <?php else: ?>
            <!-- Header para sucesso -->
            <div class="success-gradient p-6 text-center text-white">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold">Senha Alterada!</h1>
                <p class="text-green-100 text-sm mt-2">Sua senha foi redefinida com sucesso</p>
            </div>
        <?php endif; ?>

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
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-center">
                    <i class="fas fa-check-circle text-green-500 text-3xl mb-3"></i>
                    <p class="text-green-800 text-sm font-medium mb-4"><?= htmlspecialchars($success) ?></p>

                    <div class="space-y-3">
                        <a href="/admin/login"
                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 rounded-lg shadow-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i>
                            Fazer Login Agora
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Instruções -->
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                        <div class="flex-1">
                            <p class="text-blue-800 text-sm font-medium mb-1">Dicas para uma senha segura:</p>
                            <ul class="text-blue-700 text-xs space-y-1">
                                <li class="flex items-center gap-2">
                                    <i class="fas fa-check"></i>
                                    <span>Mínimo 6 caracteres</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fas fa-check"></i>
                                    <span>Use letras, números e símbolos</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fas fa-check"></i>
                                    <span>Evite senhas óbvias ou pessoais</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Formulário -->
                <form method="post" class="space-y-6" id="resetForm">
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">

                    <div>
                        <label for="senha" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-2"></i>Nova Senha
                        </label>
                        <div class="relative">
                            <input type="password" name="senha" id="senha" required minlength="6"
                                autocomplete="new-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 placeholder-gray-400 pr-10"
                                placeholder="Digite sua nova senha" oninput="checkPasswordStrength()">
                            <button type="button" onclick="togglePassword('senha', 'senhaIcon')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye" id="senhaIcon"></i>
                            </button>
                        </div>

                        <!-- Indicador de força da senha -->
                        <div class="mt-2">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs text-gray-500">Força da senha:</span>
                                <span class="text-xs font-medium" id="passwordStrengthText">Fraca</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                <div id="passwordStrengthBar" class="password-strength bg-red-500 rounded-full w-1/4"></div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="confirmar" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-2"></i>Confirmar Nova Senha
                        </label>
                        <div class="relative">
                            <input type="password" name="confirmar" id="confirmar" required minlength="6"
                                autocomplete="new-password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 placeholder-gray-400 pr-10"
                                placeholder="Confirme sua nova senha" oninput="checkPasswordMatch()">
                            <button type="button" onclick="togglePassword('confirmar', 'confirmarIcon')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-eye" id="confirmarIcon"></i>
                            </button>
                        </div>

                        <!-- Indicador de correspondência -->
                        <div class="mt-2 flex items-center gap-2 text-xs" id="passwordMatch">
                            <i class="fas fa-info-circle text-gray-400"></i>
                            <span class="text-gray-500">As senhas precisam ser iguais</span>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn"
                        class="w-full bg-gradient-to-r from-orange-600 to-red-600 text-white py-3 rounded-lg shadow-lg hover:from-orange-700 hover:to-red-700 transition-all duration-200 font-semibold flex items-center justify-center gap-2">
                        <i class="fas fa-redo-alt"></i>
                        <span id="submitText">Redefinir Senha</span>
                        <div id="loadingSpinner" class="hidden">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </button>
                </form>
            <?php endif; ?>

            <!-- Ações -->
            <div class="mt-6 space-y-3">
                <?php if (empty($success)): ?>
                    <a href="/admin/login"
                        class="w-full inline-flex items-center justify-center gap-2 text-gray-600 hover:text-gray-800 transition-colors font-medium py-2">
                        <i class="fas fa-arrow-left"></i>
                        Voltar para o login
                    </a>
                <?php endif; ?>
            </div>

            <!-- Informações de segurança -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                    <i class="fas fa-shield-alt text-orange-500"></i>
                    <span>Proteção de senha ativada</span>
                </div>
                <ul class="text-xs text-gray-500 space-y-1">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-sync-alt text-orange-500"></i>
                        <span>Senha será atualizada imediatamente</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-ban text-orange-500"></i>
                        <span>Tokens anteriores serão invalidados</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-orange-500"></i>
                        <span>Login seguro garantido</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const passwordInput = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('senha').value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');

            let strength = 0;
            let color = 'bg-red-500';
            let text = 'Fraca';
            let width = '25%';

            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            switch (strength) {
                case 0:
                case 1:
                    color = 'bg-red-500';
                    text = 'Fraca';
                    width = '25%';
                    break;
                case 2:
                    color = 'bg-yellow-500';
                    text = 'Média';
                    width = '50%';
                    break;
                case 3:
                    color = 'bg-blue-500';
                    text = 'Boa';
                    width = '75%';
                    break;
                case 4:
                case 5:
                    color = 'bg-green-500';
                    text = 'Forte';
                    width = '100%';
                    break;
            }

            strengthBar.className = `password-strength ${color} rounded-full`;
            strengthBar.style.width = width;
            strengthText.textContent = text;
            strengthText.className = `text-xs font-medium ${color === 'bg-red-500' ? 'text-red-600' :
                    color === 'bg-yellow-500' ? 'text-yellow-600' :
                        color === 'bg-blue-500' ? 'text-blue-600' : 'text-green-600'
                }`;
        }

        function checkPasswordMatch() {
            const password = document.getElementById('senha').value;
            const confirm = document.getElementById('confirmar').value;
            const matchElement = document.getElementById('passwordMatch');

            if (confirm.length === 0) {
                matchElement.innerHTML = '<i class="fas fa-info-circle text-gray-400"></i><span class="text-gray-500">As senhas precisam ser iguais</span>';
                return;
            }

            if (password === confirm) {
                matchElement.innerHTML = '<i class="fas fa-check-circle text-green-500"></i><span class="text-green-600">Senhas coincidem</span>';
            } else {
                matchElement.innerHTML = '<i class="fas fa-times-circle text-red-500"></i><span class="text-red-600">Senhas não coincidem</span>';
            }
        }

        // Prevenir múltiplos envios
        document.getElementById('resetForm')?.addEventListener('submit', function (e) {
            const password = document.getElementById('senha').value;
            const confirm = document.getElementById('confirmar').value;

            if (password !== confirm) {
                e.preventDefault();
                alert('As senhas não coincidem. Por favor, verifique.');
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            if (submitBtn && submitText && loadingSpinner) {
                submitBtn.disabled = true;
                submitText.textContent = 'Redefinindo...';
                loadingSpinner.classList.remove('hidden');
            }
        });

        // Foco no campo senha
        document.getElementById('senha')?.focus();
    </script>
</body>

</html>