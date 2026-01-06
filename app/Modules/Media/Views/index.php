<?php ob_start(); ?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50" x-data="{
        openDelete: false, 
        openPreview: false, 
        selectedId: null,
        previews: [],
        currentIndex: 0,
        isLoading: false,
        search: '<?= htmlspecialchars($filters['q'] ?? '') ?>',
        filterType: '<?= htmlspecialchars($filters['tipo'] ?? '') ?>',
        sortBy: 'name',
        sortOrder: 'asc',
        mediaList: [
            <?php foreach ($midias as $m): ?>
                {
                    id: <?= (int) $m['id'] ?>,
                    type: '<?= $m['tipo_arquivo'] ?>',
                    src: '/<?= $m['caminho_arquivo'] ?>',
                    mime: '<?= $m['tipo_mime'] ?>',
                    size: '<?= $m['tamanho'] ?>',
                    name: '<?= htmlspecialchars($m['nome_arquivo']) ?>',
                    uploaded: '<?= date('d/m/Y H:i', strtotime($m['created_at'] ?? 'now')) ?>'
                },
            <?php endforeach; ?>
        ],
        get filteredMedia() {
            const q = this.search.toLowerCase();
            let filtered = this.mediaList.filter(m => {
                const matchType = this.filterType ? m.type === this.filterType : true;
                const matchSearch = m.name.toLowerCase().includes(q) || m.mime.toLowerCase().includes(q);
                return matchType && matchSearch;
            });
            
            // Ordenação
            filtered.sort((a, b) => {
                let valA, valB;
                switch(this.sortBy) {
                    case 'name': valA = a.name; valB = b.name; break;
                    case 'size': valA = parseFloat(a.size); valB = parseFloat(b.size); break;
                    case 'date': valA = new Date(a.uploaded); valB = new Date(b.uploaded); break;
                    default: valA = a.name; valB = b.name;
                }
                
                if (typeof valA === 'string') {
                    return this.sortOrder === 'asc' 
                        ? valA.localeCompare(valB)
                        : valB.localeCompare(valA);
                } else {
                    return this.sortOrder === 'asc' ? valA - valB : valB - valA;
                }
            });
            
            return filtered;
        },
        get fileCounts() {
            const counts = { total: this.mediaList.length };
            ['imagem', 'video', 'audio', 'documento'].forEach(type => {
                counts[type] = this.mediaList.filter(m => m.type === type).length;
            });
            return counts;
        },
        open(index) { 
            this.currentIndex = index; 
            this.openPreview = true; 
            document.body.classList.add('overflow-hidden');
        },
        next() { 
            this.currentIndex = (this.currentIndex + 1) % this.filteredMedia.length; 
        },
        prev() { 
            this.currentIndex = (this.currentIndex - 1 + this.filteredMedia.length) % this.filteredMedia.length; 
        },
        close() { 
            this.openPreview = false; 
            document.body.classList.remove('overflow-hidden');
        },
        confirmDelete(id) {
            this.selectedId = id;
            this.openDelete = true;
        },
        get currentMedia() { 
            return this.filteredMedia[this.currentIndex] || {}; 
        }
     }" @keydown.window="
        if (openPreview) {
            if ($event.key === 'ArrowRight' || $event.key === ' ') next();
            if ($event.key === 'ArrowLeft') prev();
            if ($event.key === 'Escape') close();
        }
     " x-cloak>

    <!-- 🔔 Toast Notification -->
    <?php if (!empty($_SESSION['flash'])): ?>
        <?php $flash = $_SESSION['flash'];
        unset($_SESSION['flash']); ?>
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click.away="show = false"
            class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div
                class="flex items-center p-4 <?= isset($flash['success']) ? 'bg-gradient-to-r from-green-50 to-emerald-50' : 'bg-gradient-to-r from-red-50 to-rose-50' ?>">
                <div class="flex-shrink-0">
                    <?php if (isset($flash['success'])): ?>
                        <div class="w-10 h-10 flex items-center justify-center bg-green-100 text-green-600 rounded-full">
                            ✓
                        </div>
                    <?php else: ?>
                        <div class="w-10 h-10 flex items-center justify-center bg-red-100 text-red-600 rounded-full">
                            ⚠
                        </div>
                    <?php endif; ?>
                </div>
                <div class="ml-4 flex-1">
                    <p class="text-sm font-medium text-gray-900">
                        <?= isset($flash['success']) ? 'Sucesso!' : 'Atenção!' ?>
                    </p>
                    <p class="text-sm text-gray-600 mt-1">
                        <?= htmlspecialchars($flash['success'] ?? $flash['error'] ?? '') ?>
                    </p>
                </div>
                <button @click="show = false" class="ml-4 text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>
            <div x-data="{ progress: 100 }" x-init="
                let interval = setInterval(() => {
                    progress -= 1;
                    if (progress <= 0) {
                        clearInterval(interval);
                        show = false;
                    }
                }, 50);
            "
                class="h-1 bg-gradient-to-r <?= isset($flash['success']) ? 'from-green-400 to-emerald-400' : 'from-red-400 to-rose-400' ?>">
            </div>
        </div>
    <?php endif; ?>

    <!-- 📊 Estatísticas -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-4">
            <div class="text-sm text-blue-600 font-medium">Total</div>
            <div class="text-2xl font-bold text-blue-800" x-text="fileCounts.total"></div>
            <div class="text-xs text-blue-500 mt-1">arquivos</div>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-emerald-100 border border-green-200 rounded-2xl p-4">
            <div class="text-sm text-green-600 font-medium">🖼️ Imagens</div>
            <div class="text-2xl font-bold text-green-800" x-text="fileCounts.imagem"></div>
            <div class="text-xs text-green-500 mt-1">arquivos</div>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-violet-100 border border-purple-200 rounded-2xl p-4">
            <div class="text-sm text-purple-600 font-medium">🎬 Vídeos</div>
            <div class="text-2xl font-bold text-purple-800" x-text="fileCounts.video"></div>
            <div class="text-xs text-purple-500 mt-1">arquivos</div>
        </div>
        <div class="bg-gradient-to-br from-yellow-50 to-amber-100 border border-yellow-200 rounded-2xl p-4">
            <div class="text-sm text-yellow-600 font-medium">🎵 Áudios</div>
            <div class="text-2xl font-bold text-yellow-800" x-text="fileCounts.audio"></div>
            <div class="text-xs text-yellow-500 mt-1">arquivos</div>
        </div>
        <div class="bg-gradient-to-br from-gray-50 to-slate-100 border border-gray-200 rounded-2xl p-4">
            <div class="text-sm text-gray-600 font-medium">📄 Documentos</div>
            <div class="text-2xl font-bold text-gray-800" x-text="fileCounts.documento"></div>
            <div class="text-xs text-gray-500 mt-1">arquivos</div>
        </div>
    </div>

    <!-- 🔍 Filtros Avançados -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <!-- Busca -->
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" x-model.debounce.300ms="search" placeholder="Buscar por nome ou tipo..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white hover:bg-gray-50">
                </div>
            </div>

            <!-- Filtros em linha -->
            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Tipo -->
                <div class="w-full sm:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                    <div class="relative">
                        <select x-model="filterType"
                            class="w-full appearance-none border border-gray-300 rounded-xl pl-4 pr-10 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white hover:bg-gray-50">
                            <option value="">Todos os tipos</option>
                            <option value="imagem">🖼️ Imagens</option>
                            <option value="video">🎬 Vídeos</option>
                            <option value="audio">🎵 Áudios</option>
                            <option value="documento">📄 Documentos</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Ordenação -->
                <div class="w-full sm:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ordenar por</label>
                    <div class="flex gap-2">
                        <select x-model="sortBy"
                            class="flex-1 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white hover:bg-gray-50">
                            <option value="name">Nome</option>
                            <option value="size">Tamanho</option>
                            <option value="date">Data</option>
                        </select>
                        <button @click="sortOrder = sortOrder === 'asc' ? 'desc' : 'asc'"
                            class="px-4 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors"
                            :class="{ 'bg-blue-50 border-blue-300': sortOrder === 'desc' }">
                            <svg class="w-5 h-5 transform transition-transform"
                                :class="{ 'rotate-180': sortOrder === 'desc' }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 15l7-7 7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contador de resultados -->
        <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
            <span x-text="`Mostrando ${filteredMedia.length} de ${mediaList.length} arquivos`"></span>
            <button @click="search = ''; filterType = ''; sortBy = 'name'; sortOrder = 'asc'"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Limpar filtros
            </button>
        </div>
    </div>

    <!-- 📤 Upload -->
    <form action="/admin/midia/criar" method="post" enctype="multipart/form-data" x-data="{ 
        previews: [], 
        dragging: false,
        isLoading: false,
        handleFiles(files) {
            this.previews = [];
            Array.from(files).forEach(file => {
                let type = file.type.includes('image') ? 'image' : 
                           file.type.includes('video') ? 'video' :
                           file.type.includes('audio') ? 'audio' : 'documento';
                this.previews.push({ 
                    type, 
                    src: URL.createObjectURL(file), 
                    name: file.name, 
                    size: file.size,
                    file 
                });
            });
        },
        uploadProgress: 0
    }" @submit.prevent="
        isLoading = true;
        let formData = new FormData($el);
        let xhr = new XMLHttpRequest();
        
        xhr.upload.addEventListener('progress', (e) => {
            if (e.lengthComputable) {
                uploadProgress = Math.round((e.loaded / e.total) * 100);
            }
        });
        
        xhr.onload = function() {
            isLoading = false;
            if (xhr.status === 200) {
                window.location.reload();
            }
        };
        
        xhr.open('POST', $el.action);
        xhr.send(formData);
    "
        class="mb-12 bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-lg border border-gray-200 p-6 transition-all hover:shadow-xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">📤 Enviar Novos Arquivos</h2>
                <p class="text-gray-600 text-sm mt-1">Formatos suportados: JPG, PNG, GIF, MP4, MP3, PDF, DOC</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Máx. 50MB por arquivo
            </div>
        </div>

        <!-- Drop Zone -->
        <div x-ref="dropZone" @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
            @drop.prevent="dragging = false; handleFiles($event.dataTransfer.files)"
            :class="dragging ? 'border-blue-400 bg-blue-50 ring-4 ring-blue-100' : 'border-gray-300 bg-white hover:bg-gray-50'"
            class="border-3 border-dashed rounded-2xl flex flex-col items-center justify-center p-12 transition-all duration-300 cursor-pointer"
            @click="$refs.fileInput.click()">
            <input type="file" name="arquivos[]" multiple
                accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.txt,.xls,.xlsx,.ppt,.pptx" x-ref="fileInput"
                class="hidden" @change="handleFiles($event.target.files)">

            <div class="text-center">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full mb-6">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Arraste ou clique para fazer upload</h3>
                <p class="text-gray-500 mb-4">Solte seus arquivos aqui ou clique para navegar</p>
                <button type="button"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Selecionar Arquivos
                </button>
            </div>
        </div>

        <!-- Pré-visualizações -->
        <template x-if="previews.length > 0">
            <div class="mt-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-medium text-gray-700">
                        <span x-text="previews.length"></span> arquivo(s) selecionado(s)
                    </h4>
                    <button type="button" @click="previews = []; $refs.fileInput.value = ''"
                        class="text-sm text-red-600 hover:text-red-800 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Remover todos
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <template x-for="(file, index) in previews" :key="index">
                        <div
                            class="group relative bg-white rounded-xl border border-gray-200 p-4 hover:border-blue-300 hover:shadow-md transition-all">
                            <!-- Preview -->
                            <div class="mb-3">
                                <template x-if="file.type === 'image'">
                                    <img :src="file.src" class="w-full h-40 object-contain rounded-lg">
                                </template>
                                <template x-if="file.type === 'video'">
                                    <video :src="file.src" class="w-full h-40 object-contain rounded-lg" controls
                                        muted></video>
                                </template>
                                <template x-if="file.type === 'audio'">
                                    <div
                                        class="w-full h-40 bg-gradient-to-br from-yellow-50 to-amber-50 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                        </svg>
                                    </div>
                                </template>
                                <template x-if="file.type === 'documento'">
                                    <div
                                        class="w-full h-40 bg-gradient-to-br from-gray-50 to-slate-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </template>
                            </div>

                            <!-- Informações -->
                            <div>
                                <p class="font-medium text-gray-800 truncate" x-text="file.name"></p>
                                <p class="text-sm text-gray-500 mt-1" x-text="Math.round(file.size / 1024) + ' KB'"></p>
                            </div>

                            <!-- Botão remover -->
                            <button type="button" @click="previews.splice(index, 1)"
                                class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>

                <!-- Botão upload -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">
                            Total: <span
                                x-text="previews.reduce((acc, file) => acc + file.size, 0) / 1024 / 1024"></span> MB
                        </span>
                        <button type="submit" :disabled="isLoading"
                            class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-3 rounded-xl font-medium transition-all shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                            <template x-if="isLoading">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Enviando...
                            </template>
                            <template x-if="!isLoading">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    Enviar Arquivos
                                </span>
                            </template>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </form>

    <!-- 🗂️ Galeria de Arquivos -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📁 Biblioteca de Mídia</h2>
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span x-text="filteredMedia.length"></span> arquivos encontrados
            </div>
        </div>

        <div x-show="filteredMedia.length > 0"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <template x-for="(m, index) in filteredMedia" :key="m.id">
                <div
                    class="group relative bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <!-- Badge tipo -->
                    <div class="absolute top-3 left-3 z-10">
                        <span :class="{
                            'bg-blue-500 text-white': m.type === 'imagem',
                            'bg-purple-500 text-white': m.type === 'video',
                            'bg-yellow-500 text-white': m.type === 'audio',
                            'bg-gray-600 text-white': m.type === 'documento'
                        }" class="px-2 py-1 rounded-full text-xs font-medium">
                            <template x-if="m.type === 'imagem'">🖼️ Imagem</template>
                            <template x-if="m.type === 'video'">🎬 Vídeo</template>
                            <template x-if="m.type === 'audio'">🎵 Áudio</template>
                            <template x-if="m.type === 'documento'">📄 Documento</template>
                        </span>
                    </div>

                    <!-- Preview -->
                    <div class="relative h-48 bg-gradient-to-br from-gray-50 to-gray-100 cursor-pointer"
                        @click="open(index)">
                        <template x-if="m.type === 'imagem'">
                            <img :src="m.src"
                                class="w-full h-full object-contain transition-transform group-hover:scale-105 duration-300">
                        </template>
                        <template x-if="m.type === 'video'">
                            <video :src="m.src"
                                class="w-full h-full object-contain transition-transform group-hover:scale-105 duration-300"
                                autoplay muted></video>
                        </template>
                        <template x-if="m.type === 'audio'">
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="relative">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="m.type === 'documento'">
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="relative">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-gray-600 to-gray-700 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Overlay hover -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                            <span class="text-white text-sm font-medium">Clique para visualizar</span>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 truncate mb-1" x-text="m.name"></h3>
                        <p class="text-xs text-gray-500 truncate mb-2" x-text="m.mime"></p>

                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span x-text="Math.round(m.size / 1024) + ' KB'"></span>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <a :href="m.src" target="_blank" download
                                class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Baixar
                            </a>
                            <button @click="confirmDelete(m.id)"
                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <div x-show="filteredMedia.length === 0"
            class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-2xl border-2 border-dashed border-gray-300 p-16 text-center">
            <div class="max-w-md mx-auto">
                <div
                    class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Nenhum arquivo encontrado</h3>
                <p class="text-gray-500 mb-6">Tente ajustar os filtros ou faça upload de novos arquivos</p>
                <button @click="search = ''; filterType = ''"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-medium transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Limpar filtros
                </button>
            </div>
        </div>
    </div>

    <!-- 📄 Paginação -->
    <?php if ($totalPages > 1): ?>
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-12 pt-8 border-t border-gray-200">
            <div class="text-sm text-gray-500">
                Página <?= $page ?> de <?= $totalPages ?>
            </div>
            <div class="flex items-center gap-2">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&tipo=<?= urlencode($filters['tipo'] ?? '') ?>&q=<?= urlencode($filters['q'] ?? '') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Anterior
                    </a>
                <?php endif; ?>

                <div class="flex items-center gap-1">
                    <?php
                    $start = max(1, $page - 2);
                    $end = min($totalPages, $page + 2);

                    if ($start > 1)
                        echo '<span class="px-3 py-1">...</span>';

                    for ($i = $start; $i <= $end; $i++): ?>
                        <a href="?page=<?= $i ?>&tipo=<?= urlencode($filters['tipo'] ?? '') ?>&q=<?= urlencode($filters['q'] ?? '') ?>"
                            class="w-10 h-10 flex items-center justify-center rounded-xl border <?= $i == $page ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white border-blue-600' : 'border-gray-300 hover:bg-gray-50' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor;

                    if ($end < $totalPages)
                        echo '<span class="px-3 py-1">...</span>';
                    ?>
                </div>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>&tipo=<?= urlencode($filters['tipo'] ?? '') ?>&q=<?= urlencode($filters['q'] ?? '') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50 flex items-center gap-2">
                        Próxima
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal de Exclusão -->
    <div x-show="openDelete" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="openDelete = false"></div>

            <!-- Modal -->
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Confirmar exclusão</h3>
                        <p class="text-gray-600">Esta ação não pode ser desfeita</p>
                    </div>
                </div>

                <!-- Detalhes do arquivo -->
                <template x-if="selectedId !== null">
                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <template x-for="media in mediaList" :key="media.id">
                            <template x-if="media.id === selectedId">
                                <div class="flex items-start gap-4">
                                    <!-- Ícone -->
                                    <div :class="{
                                        'bg-blue-100 text-blue-600': media.type === 'imagem',
                                        'bg-purple-100 text-purple-600': media.type === 'video',
                                        'bg-yellow-100 text-yellow-600': media.type === 'audio',
                                        'bg-gray-100 text-gray-600': media.type === 'documento'
                                    }" class="flex-shrink-0 w-20 h-20 rounded-xl flex items-center justify-center">
                                        <template x-if="media.type === 'imagem'">
                                            <img :src="media.src" class="w-full h-full object-contain">
                                        </template>
                                        <template x-if="media.type === 'video'">
                                            <video :src="media.src" class="w-full h-full object-contain" autoplay
                                                muted></video>
                                        </template>
                                        <template x-if="media.type === 'audio'">🎵</template>
                                        <template x-if="media.type === 'documento'">📄</template>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-medium text-gray-900 truncate" x-text="media.name"></h4>
                                        <div class="mt-2 space-y-1 text-sm text-gray-500">
                                            <div class="flex items-center gap-2">
                                                <span class="font-medium">Tipo:</span>
                                                <span x-text="media.mime"></span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="font-medium">Tamanho:</span>
                                                <span x-text="Math.round((media.size||0)/1024) + ' KB'"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </template>

                <!-- Actions -->
                <div class="flex justify-end gap-3">
                    <button type="button" @click="openDelete = false"
                        class="px-5 py-2.5 border border-gray-300 rounded-xl hover:bg-gray-50 font-medium transition-colors">
                        Cancelar
                    </button>
                    <a :href="`/admin/midia/${selectedId}/deletar`"
                        class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl font-medium shadow-sm hover:shadow transition-all">
                        Excluir Arquivo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Visualização -->
    <div x-show="openPreview" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-[60] bg-black bg-opacity-90 backdrop-blur-sm"
        style="display: none;">
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <!-- Botões de navegação -->
            <button @click="prev()"
                class="absolute left-4 lg:left-8 z-10 w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button @click="next()"
                class="absolute right-4 lg:right-8 z-10 w-12 h-12 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Botão fechar -->
            <button @click="close()"
                class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Conteúdo -->
            <div class="relative max-w-6xl w-full max-h-[90vh] flex items-center justify-center">
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-2xl w-full">
                    <!-- Informações -->
                    <div class="mb-6 flex items-center justify-between">
                        <div class="truncate">
                            <h3 class="text-lg font-bold text-gray-900 truncate" x-text="currentMedia.name"></h3>
                            <p class="text-sm text-gray-500 mt-1">
                                <span x-text="currentMedia.mime"></span> •
                                <span x-text="Math.round((currentMedia.size||0)/1024) + ' KB'"></span> •
                                <span x-text="currentIndex + 1"></span> de <span x-text="filteredMedia.length"></span>
                            </p>
                        </div>
                        <a :href="currentMedia.src" target="_blank" download
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Baixar
                        </a>
                    </div>

                    <!-- Preview -->
                    <div class="bg-gray-900 rounded-xl overflow-hidden flex items-center justify-center min-h-[60vh]">
                        <template x-if="currentMedia.type === 'imagem'">
                            <img :src="currentMedia.src" class="max-w-full max-h-[60vh] object-contain">
                        </template>

                        <template x-if="currentMedia.type === 'video'">
                            <video controls class="w-full max-h-[60vh] rounded-lg" autoplay muted>
                                <source :src="currentMedia.src" :type="currentMedia.mime">
                            </video>
                        </template>

                        <template x-if="currentMedia.type === 'audio'">
                            <div class="p-8 w-full max-w-md">
                                <div class="bg-gradient-to-br from-yellow-500 to-amber-600 rounded-xl p-8">
                                    <div class="text-center text-white mb-6">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                        </svg>
                                        <h4 class="text-xl font-bold" x-text="currentMedia.name"></h4>
                                    </div>
                                    <audio controls class="w-full">
                                        <source :src="currentMedia.src" :type="currentMedia.mime">
                                    </audio>
                                </div>
                            </div>
                        </template>

                        <template x-if="currentMedia.type === 'documento'">
                            <div class="w-full h-[60vh]">
                                <template x-if="currentMedia.src.endsWith('.pdf')">
                                    <iframe :src="currentMedia.src + '#toolbar=0&view=fitH'"
                                        class="w-full h-full rounded-lg"></iframe>
                                </template>
                                <template x-if="!currentMedia.src.endsWith('.pdf')">
                                    <div class="h-full flex items-center justify-center">
                                        <div class="text-center p-8">
                                            <div
                                                class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-600 to-gray-700 rounded-full flex items-center justify-center">
                                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <h4 class="text-xl font-bold text-white mb-2" x-text="currentMedia.name">
                                            </h4>
                                            <p class="text-gray-300 mb-6">Visualização não disponível para este formato
                                            </p>
                                            <a :href="currentMedia.src" download
                                                class="inline-flex items-center gap-2 bg-white text-gray-900 px-6 py-3 rounded-xl font-medium hover:bg-gray-100 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                Baixar Documento
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- Miniaturas -->
                    <div class="mt-6">
                        <div class="flex items-center overflow-x-auto gap-2 py-2 px-1 -mx-1">
                            <template x-for="(media, index) in filteredMedia" :key="media.id">
                                <button @click="currentIndex = index" :class="{
                                        'ring-2 ring-blue-500 ring-offset-2': currentIndex === index,
                                        'opacity-60 hover:opacity-100': currentIndex !== index
                                    }"
                                    class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden bg-gray-800 transition-all">
                                    <template x-if="media.type === 'imagem'">
                                        <img :src="media.src" class="w-full h-full object-contain">
                                    </template>
                                    <template x-if="media.type !== 'imagem'">
                                        <div :class="{
                                            'bg-blue-500': media.type === 'imagem',
                                            'bg-purple-500': media.type === 'video',
                                            'bg-yellow-500': media.type === 'audio',
                                            'bg-gray-600': media.type === 'documento'
                                        }" class="w-full h-full flex items-center justify-center text-white">
                                            <template x-if="media.type === 'video'">🎬</template>
                                            <template x-if="media.type === 'audio'">🎵</template>
                                            <template x-if="media.type === 'documento'">📄</template>
                                        </div>
                                    </template>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout.php";
?>