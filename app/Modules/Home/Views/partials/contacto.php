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
                <form method="POST" action="?url=contact" class="bg-white p-6 rounded-xl shadow-md space-y-6">
                    <div>
                        <label for="nome" class="block text-gray-700 mb-2 font-semibold">Nome Completo</label>
                        <input id="nome" name="name" type="text" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                            placeholder="Seu nome completo">
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 mb-2 font-semibold">Email</label>
                        <input id="email" name="email" type="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300"
                            placeholder="seu@email.com">
                    </div>
                    <div>
                        <label for="assunto" class="block text-gray-700 mb-2 font-semibold">Assunto</label>
                        <select id="assunto" name="subject" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300">
                            <option value="">Selecione um assunto</option>
                            <option value="Testemunho">Testemunho</option>
                            <option value="Oração">Pedido de Oração</option>
                            <option value="Informações">Informações</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div>
                        <label for="mensagem" class="block text-gray-700 mb-2 font-semibold">Mensagem</label>
                        <textarea id="mensagem" name="message" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-300 resize-none"
                            placeholder="Escreva sua mensagem..."></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center group">
                        <span>Enviar Mensagem</span>
                        <i
                            class="fas fa-paper-plane ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </button>
                </form>
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