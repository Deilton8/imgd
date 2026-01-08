<!-- Contacto -->
<section id="contact" class="py-16 bg-white" aria-labelledby="contacto-titulo">
    <div class="container mx-auto px-4">
        <header class="text-center mb-12">
            <h2 id="contacto-titulo" class="text-3xl md:text-4xl font-bold text-yellow-900 mb-4">Entre em Contacto</h2>
            <div class="w-20 h-1 bg-yellow-600 mx-auto mt-6"></div>
        </header>

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
            </div>

            <!-- Informações de contacto -->
            <div class="lg:w-1/2">
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