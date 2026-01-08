<?php
ob_start();

// Recupera dados da URL
$flashData = $_GET['flash'] ?? null;
$formData = $_GET['form_data'] ?? null;

$flashMessage = null;
$old = [];

if ($flashData) {
    $decoded = json_decode(base64_decode($flashData), true);
    if ($decoded) {
        $flashMessage = $decoded;
    }
}

if ($formData) {
    $decoded = json_decode(base64_decode($formData), true);
    if ($decoded) {
        $old = $decoded;
    }
}
?>

<!-- Page Header com gradiente melhorado -->
<section class="relative bg-gradient-to-br from-yellow-800 via-yellow-700 to-yellow-600 py-20 text-white" role="banner">
    <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-transparent"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center space-y-4">
            <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                <i class="fas fa-envelope text-yellow-300"></i>
                <span class="text-sm font-semibold">Fale Conosco</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-4 leading-tight tracking-tight">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-yellow-100">
                    Contacto
                </span>
            </h1>
            <p class="text-xl md:text-2xl text-yellow-100 font-light max-w-3xl mx-auto">
                Entre em contacto com a nossa comunidade de fé e amor
            </p>
        </div>
    </div>
    <!-- Elemento decorativo -->
    <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Breadcrumb melhorado -->
<nav class="bg-white/95 backdrop-blur-sm py-4 border-b border-yellow-100 shadow-sm" aria-label="Navegação">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-3 text-sm">
            <li>
                <a href="/"
                    class="flex items-center text-gray-600 hover:text-yellow-600 transition-all duration-300 group"
                    aria-label="Ir para início">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg flex items-center justify-center mr-2 group-hover:scale-110 transition-transform">
                        <i class="fas fa-home text-yellow-500 text-sm"></i>
                    </div>
                    <span class="font-medium">Início</span>
                </a>
            </li>
            <li class="flex items-center text-gray-400">
                <i class="fas fa-chevron-right text-xs mx-2"></i>
            </li>
            <li class="flex items-center">
                <span class="text-gray-900 font-semibold flex items-center">
                    <i class="fas fa-envelope-open-text text-yellow-500 mr-2"></i>
                    Contacto
                </span>
            </li>
        </ol>
    </div>
</nav>

<!-- Contacto -->
<section id="contact" class="py-16 bg-white" aria-labelledby="contacto-titulo">
    <div class="container mx-auto px-4">
        <header class="text-center mb-12">
            <h2 id="contacto-titulo" class="text-3xl md:text-4xl font-bold text-yellow-900 mb-4">Entre em Contacto</h2>
            <div class="w-20 h-1 bg-yellow-600 mx-auto mt-6"></div>
        </header>

        <!-- Notificação Flash -->
        <?php if ($flashMessage): ?>
            <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="max-w-4xl mx-auto mb-8 p-4 rounded-2xl border-l-4 <?= $flashMessage['type'] === 'error' ? 'bg-red-50 border-red-400 text-red-700' : 'bg-green-50 border-green-400 text-green-700' ?>">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-lg"><?= $flashMessage['type'] === 'error' ? '❌' : '✅' ?></span>
                        <p class="font-medium"><?= htmlspecialchars($flashMessage['message']) ?></p>
                    </div>
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Formulário -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 px-6 py-4">
                        <h3 class="text-xl font-bold text-white">Formulário de Contacto</h3>
                    </div>

                    <form method="POST" action="/contato" class="p-6 space-y-6" x-data="contactForm()" x-cloak>
                        <div>
                            <label for="nome" class="block text-gray-700 mb-2 font-semibold flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Nome Completo
                            </label>
                            <input type="text" name="nome" id="nome" required x-model="formData.nome"
                                value="<?= htmlspecialchars($old['nome'] ?? '') ?>" @input="validateForm()"
                                :class="{'border-red-300': errors.nome}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                                placeholder="Seu nome completo">
                            <div x-show="errors.nome" x-transition
                                class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                <span x-text="errors.nome"></span>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 mb-2 font-semibold flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Email
                            </label>
                            <input type="email" name="email" id="email" required x-model="formData.email"
                                value="<?= htmlspecialchars($old['email'] ?? '') ?>" @input="validateForm()"
                                :class="{'border-red-300': errors.email}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                                placeholder="seu@email.com">
                            <div x-show="errors.email" x-transition
                                class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                <span x-text="errors.email"></span>
                            </div>
                        </div>

                        <div>
                            <label for="assunto" class="block text-gray-700 mb-2 font-semibold flex items-center gap-2">
                                <span class="text-red-500">*</span>
                                Assunto
                            </label>
                            <select name="assunto" id="assunto" required x-model="formData.assunto"
                                @change="validateForm()" :class="{'border-red-300': errors.assunto}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300">
                                <option value="">Selecione um assunto</option>
                                <option value="Testemunho" <?= ($old['assunto'] ?? '') == 'Testemunho' ? 'selected' : '' ?>>Testemunho</option>
                                <option value="Oração" <?= ($old['assunto'] ?? '') == 'Oração' ? 'selected' : '' ?>>Pedido
                                    de Oração</option>
                                <option value="Informações" <?= ($old['assunto'] ?? '') == 'Informações' ? 'selected' : '' ?>>Informações</option>
                                <option value="Outro" <?= ($old['assunto'] ?? '') == 'Outro' ? 'selected' : '' ?>>Outro
                                </option>
                            </select>
                            <div x-show="errors.assunto" x-transition
                                class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                <span x-text="errors.assunto"></span>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="mensagem" class="block text-gray-700 font-semibold flex items-center gap-2">
                                    <span class="text-red-500">*</span>
                                    Mensagem
                                </label>
                                <span class="text-xs text-gray-500" x-text="`${formData.mensagem.length}/2000`"></span>
                            </div>
                            <textarea name="mensagem" id="mensagem" rows="5" required x-model="formData.mensagem"
                                @input="validateForm()" :class="{'border-red-300': errors.mensagem}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300 resize-none"
                                placeholder="Escreva sua mensagem..."><?= htmlspecialchars($old['mensagem'] ?? '') ?></textarea>
                            <div x-show="errors.mensagem" x-transition
                                class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                <span x-text="errors.mensagem"></span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="button" @click="resetForm()"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:border-gray-400 hover:text-gray-900 hover:shadow transition-all duration-300 font-medium flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Limpar
                            </button>

                            <button type="submit" :disabled="!isFormValid"
                                class="flex-1 bg-yellow-600 hover:bg-yellow-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center group">
                                <span>Enviar Mensagem</span>
                                <i
                                    class="fas fa-paper-plane ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Informações Importantes -->
                <div class="mt-6 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl p-6 border border-yellow-200">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informações Importantes
                    </h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="text-yellow-500 mt-1">✓</span>
                            <span>Respondemos em até 24 horas úteis</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-yellow-500 mt-1">✓</span>
                            <span>Para assuntos urgentes, utilize nosso telefone</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-yellow-500 mt-1">✓</span>
                            <span>Verifique sua caixa de spam caso não receba nossa resposta</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Informações de contacto -->
            <div class="lg:w-1/2 space-y-8">
                <div class="bg-white p-6 rounded-xl shadow-md h-full space-y-8">
                    <h3 class="text-2xl font-bold text-yellow-900 mb-6">Informações de Contacto</h3>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-yellow-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Endereço</h4>
                                <p class="text-gray-600">Av. Joaquim Chissano, nº 58<br>Bairro da Matola H<br>Matola,
                                    Moçambique</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-yellow-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-2">Emails</h4>
                                <div class="space-y-2">
                                    <p class="text-gray-600">info@imgd.org.mz</p>
                                    <p class="text-gray-600">parceiros@imgd.org.mz</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-share-alt text-yellow-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-3">Redes Sociais</h4>
                                <div class="flex space-x-3">
                                    <a href="https://web.facebook.com/www.imgdjeque.org.mz" aria-label="Facebook"
                                        class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors duration-300">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://www.instagram.com/apostolojeque" aria-label="Instagram"
                                        class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-white flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition-all duration-300">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="https://youtube.com/@imgdvideos" aria-label="YouTube"
                                        class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition-colors duration-300">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Mapa -->
                        <div class="w-full h-96 rounded-lg overflow-hidden shadow-lg">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3569.706080704633!2d32.46518553243779!3d-25.924982648049895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ee68fa9b6a8f893%3A0x82df5cea77af3550!2sIgreja%20Minist%C3%A9rio%20Da%20Gra%C3%A7a%20de%20Deus%20(IMGD)!5e0!3m2!1spt-PT!2smz!4v1755854650257!5m2!1spt-PT!2smz"
                                class="w-full h-full border-0" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Localização da Igreja Ministério da Graça de Deus">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function contactForm() {
        return {
            formData: {
                nome: '<?= addslashes($old['nome'] ?? '') ?>',
                email: '<?= addslashes($old['email'] ?? '') ?>',
                assunto: '<?= addslashes($old['assunto'] ?? '') ?>',
                mensagem: '<?= addslashes($old['mensagem'] ?? '') ?>'
            },
            errors: {},
            isFormValid: false,

            isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            },

            validateForm() {
                this.errors = {};

                // Validar nome
                if (!this.formData.nome.trim()) {
                    this.errors.nome = 'Nome é obrigatório';
                } else if (this.formData.nome.trim().length < 2) {
                    this.errors.nome = 'Nome deve ter pelo menos 2 caracteres';
                }

                // Validar email
                if (!this.formData.email.trim()) {
                    this.errors.email = 'Email é obrigatório';
                } else if (!this.isValidEmail(this.formData.email)) {
                    this.errors.email = 'Email inválido';
                }

                // Validar assunto
                if (!this.formData.assunto) {
                    this.errors.assunto = 'Assunto é obrigatório';
                }

                // Validar mensagem
                if (!this.formData.mensagem.trim()) {
                    this.errors.mensagem = 'Mensagem é obrigatória';
                } else if (this.formData.mensagem.trim().length < 10) {
                    this.errors.mensagem = 'Mensagem deve ter pelo menos 10 caracteres';
                } else if (this.formData.mensagem.trim().length > 2000) {
                    this.errors.mensagem = 'Mensagem não pode exceder 2000 caracteres';
                }

                this.isFormValid = Object.keys(this.errors).length === 0;
            },

            resetForm() {
                if (confirm('Tem certeza que deseja limpar todos os campos do formulário?')) {
                    this.formData = {
                        nome: '',
                        email: '',
                        assunto: '',
                        mensagem: ''
                    };
                    this.errors = {};
                    this.isFormValid = false;
                }
            },

            init() {
                this.validateForm();
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout_public.php";
?>