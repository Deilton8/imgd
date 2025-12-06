<?php ob_start(); ?>

<div x-data="publicationTable()" x-cloak class="min-h-screen bg-gray-50/30 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                        <span
                            class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white">
                            📝
                        </span>
                        Gerenciar Publicações
                    </h1>
                    <p class="text-gray-600 mt-2 text-lg">Gerencie notícias, avisos e artigos do blog</p>
                </div>

                <a href="/admin/publicacao/criar"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white px-6 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    <span class="text-lg">+</span>
                    Nova Publicação
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if (!empty($_SESSION['flash'])):
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            $type = isset($flash['success']) ? 'success' : 'error';
            $message = $flash['success'] ?? $flash['error'];
            ?>
            <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="mb-6 p-4 rounded-2xl border-l-4 <?= $type === 'success' ? 'bg-green-50 border-green-400 text-green-700' : 'bg-red-50 border-red-400 text-red-700' ?>">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-lg"><?= $type === 'success' ? '✅' : '❌' ?></span>
                        <p class="font-medium"><?= htmlspecialchars($message) ?></p>
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

        <!-- 🔍 Filtros e Estatísticas -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                <!-- Busca -->
                <div class="flex-1 max-w-md">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="text-purple-500">🔍</span>
                        Buscar Publicações
                    </label>
                    <div class="relative">
                        <input type="text" x-model.debounce.300ms="search"
                            placeholder="Digite título, conteúdo ou descrição..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white hover:bg-purple-50 focus:bg-white placeholder-gray-400">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Categoria -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Categoria</label>
                        <select x-model="filterCategory"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white hover:bg-purple-50 focus:bg-white appearance-none cursor-pointer">
                            <option value="">Todas as categorias</option>
                            <option value="aviso">📢 Aviso</option>
                            <option value="testemunho">🗣️ Testemunho</option>
                            <option value="blog">✍️ Blog</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select x-model="filterStatus"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white hover:bg-purple-50 focus:bg-white appearance-none cursor-pointer">
                            <option value="">Todos os status</option>
                            <option value="rascunho">📝 Rascunho</option>
                            <option value="publicado">🌐 Publicado</option>
                        </select>
                    </div>

                    <!-- Ordenação -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ordenar por</label>
                        <select x-model="sortField"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white hover:bg-purple-50 focus:bg-white appearance-none cursor-pointer">
                            <option value="publicado_em">Data Publicação</option>
                            <option value="titulo">Título</option>
                            <option value="criado_em">Data Criação</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filtros de Data -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 pt-6 border-t border-gray-200">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Data Inicial</label>
                    <input type="date" x-model="startDate"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white hover:bg-purple-50 focus:bg-white cursor-pointer">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Data Final</label>
                    <input type="date" x-model="endDate"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 bg-white hover:bg-purple-50 focus:bg-white cursor-pointer">
                </div>
                <div class="flex items-end">
                    <button @click="clearDateFilters"
                        class="w-full px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        🗑️ Limpar Datas
                    </button>
                </div>
            </div>

            <!-- Estatísticas e Ações -->
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500">Total:</span>
                        <span class="font-semibold text-gray-900" x-text="filteredPublications.length"></span>
                        <span class="text-gray-400">publicações</span>
                    </div>

                    <div class="hidden sm:flex items-center gap-4" x-show="hasActiveFilters">
                        <template x-for="filter in activeFilters" :key="filter.label">
                            <span
                                class="inline-flex items-center gap-1 bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium">
                                <span x-text="filter.label"></span>: <span x-text="filter.value"></span>
                                <button @click="clearFilter(filter.type)"
                                    class="hover:text-purple-600 transition">×</button>
                            </span>
                        </template>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button @click="clearFilters" x-show="hasActiveFilters"
                        class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        <span>🔄</span>
                        Limpar Filtros
                    </button>
                </div>
            </div>
        </div>

        <!-- 📋 Tabela -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gradient-to-r from-gray-50 to-purple-50/30">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                ID
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Publicação
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Categoria
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Datas
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Status
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <template x-for="p in paginatedPublications" :key="p.id">
                            <tr class="hover:bg-purple-50/50 transition-all duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900" x-text="p.id"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-semibold text-gray-900 group-hover:text-purple-600 transition-colors"
                                            x-text="p.titulo"></span>
                                        <span class="text-xs text-gray-500 mt-1 line-clamp-2"
                                            x-text="p.conteudo?.substring(0, 100) + '...'" x-show="p.conteudo"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getCategoryClasses(p.categoria)"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold capitalize"
                                        x-text="getCategoryText(p.categoria)"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col text-sm">
                                        <template x-if="p.publicado_em">
                                            <span class="text-gray-900 font-medium"
                                                x-text="formatDate(p.publicado_em)"></span>
                                        </template>
                                        <template x-if="!p.publicado_em">
                                            <span class="text-gray-400 text-xs">Não publicado</span>
                                        </template>
                                        <span class="text-gray-500 text-xs"
                                            x-text="'Criado: ' + formatDate(p.criado_em)"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getStatusClasses(p.status)"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold capitalize"
                                        x-text="getStatusText(p.status)"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="`/admin/publicacao/${p.id}`"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                                            title="Visualizar publicação">
                                            👁️ Ver
                                        </a>
                                        <a :href="`/admin/publicacao/${p.id}/editar`"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1"
                                            title="Editar publicação">
                                            ✏️ Editar
                                        </a>
                                        <button type="button" @click="confirmDelete(p)"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                                            title="Excluir publicação">
                                            🗑️ Excluir
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <template x-if="filteredPublications.length === 0">
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <span class="text-6xl mb-4">📝</span>
                                        <p class="text-lg font-medium text-gray-500 mb-2">Nenhuma publicação encontrada
                                        </p>
                                        <p class="text-sm text-gray-400 mb-4" x-show="hasActiveFilters">
                                            Tente ajustar os filtros ou <button @click="clearFilters"
                                                class="text-purple-600 hover:text-purple-700 underline">limpar todos os
                                                filtros</button>
                                        </p>
                                        <a href="/admin/publicacao/criar"
                                            class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition-colors">
                                            <span>+</span>
                                            Criar Primeira Publicação
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-t border-gray-200 bg-gray-50/50"
                x-show="filteredPublications.length > 0">
                <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                    Mostrando <span class="font-semibold" x-text="startIndex + 1"></span> a
                    <span class="font-semibold" x-text="Math.min(endIndex, filteredPublications.length)"></span> de
                    <span class="font-semibold" x-text="filteredPublications.length"></span> publicações
                </div>

                <div class="flex items-center gap-2">
                    <button @click="previousPage" :disabled="currentPage === 1"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-white disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                        ← Anterior
                    </button>

                    <div class="flex items-center gap-1">
                        <template x-for="page in visiblePages" :key="page">
                            <button @click="currentPage = page"
                                :class="page === currentPage ? 'bg-purple-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
                                class="w-8 h-8 rounded-lg text-sm font-medium transition-colors" x-text="page"></button>
                        </template>
                    </div>

                    <button @click="nextPage" :disabled="currentPage === totalPages"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-white disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                        Próxima →
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 🧾 Modal de Confirmação de Exclusão -->
    <div x-show="showModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4" style="display: none;">
        <div @click.away="showModal = false"
            class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all duration-300 scale-100">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl text-red-600">🗑️</span>
                </div>

                <h2 class="text-xl font-bold text-gray-900 mb-2">Excluir Publicação?</h2>
                <template x-if="publicationToDelete">
                    <p class="text-gray-600 mb-1">
                        <strong x-text="publicationToDelete.titulo"></strong>
                    </p>
                </template>
                <p class="text-gray-500 text-sm mb-6">
                    Esta ação não pode ser desfeita. A publicação será permanentemente removida.
                </p>

                <div class="flex justify-center gap-3">
                    <button @click="showModal = false"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        Cancelar
                    </button>
                    <a :href="`/admin/publicacao/${publicationToDelete?.id}/deletar`"
                        class="px-6 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-500 shadow-lg hover:shadow-xl transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Sim, Excluir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function publicationTable() {
        return {
            search: '',
            filterCategory: '',
            filterStatus: '',
            startDate: '',
            endDate: '',
            sortField: 'publicado_em',
            sortDirection: 'desc',
            showModal: false,
            publicationToDelete: null,
            currentPage: 1,
            pageSize: 10,
            publications: <?= json_encode($publicacoes, JSON_UNESCAPED_UNICODE) ?>,

            get filteredPublications() {
                let filtered = this.publications.filter(p => {
                    const matchSearch = !this.search ||
                        p.titulo?.toLowerCase().includes(this.search.toLowerCase()) ||
                        p.conteudo?.toLowerCase().includes(this.search.toLowerCase()) ||
                        p.descricao?.toLowerCase().includes(this.search.toLowerCase());

                    const matchCategory = !this.filterCategory || p.categoria === this.filterCategory;
                    const matchStatus = !this.filterStatus || p.status === this.filterStatus;

                    const matchStartDate = !this.startDate ||
                        (p.publicado_em && new Date(p.publicado_em) >= new Date(this.startDate + 'T00:00:00'));

                    const matchEndDate = !this.endDate ||
                        (p.publicado_em && new Date(p.publicado_em) <= new Date(this.endDate + 'T23:59:59'));

                    return matchSearch && matchCategory && matchStatus && matchStartDate && matchEndDate;
                });

                // Ordenação
                filtered.sort((a, b) => {
                    let aVal = a[this.sortField];
                    let bVal = b[this.sortField];

                    if (this.sortField.includes('_em')) {
                        aVal = new Date(aVal || '1970-01-01');
                        bVal = new Date(bVal || '1970-01-01');
                    }

                    if (aVal < bVal) return this.sortDirection === 'asc' ? -1 : 1;
                    if (aVal > bVal) return this.sortDirection === 'asc' ? 1 : -1;
                    return 0;
                });

                return filtered;
            },

            get paginatedPublications() {
                const start = (this.currentPage - 1) * this.pageSize;
                return this.filteredPublications.slice(start, start + this.pageSize);
            },

            get totalPages() {
                return Math.ceil(this.filteredPublications.length / this.pageSize);
            },

            get startIndex() {
                return (this.currentPage - 1) * this.pageSize;
            },

            get endIndex() {
                return Math.min(this.startIndex + this.pageSize, this.filteredPublications.length);
            },

            get visiblePages() {
                const pages = [];
                const total = this.totalPages;
                let start = Math.max(1, this.currentPage - 2);
                let end = Math.min(total, start + 4);

                if (end - start < 4) {
                    start = Math.max(1, end - 4);
                }

                for (let i = start; i <= end; i++) {
                    pages.push(i);
                }
                return pages;
            },

            get hasActiveFilters() {
                return this.search || this.filterCategory || this.filterStatus || this.startDate || this.endDate;
            },

            get activeFilters() {
                const filters = [];
                if (this.search) filters.push({ type: 'search', label: 'Busca', value: this.search });
                if (this.filterCategory) filters.push({ type: 'category', label: 'Categoria', value: this.getCategoryText(this.filterCategory) });
                if (this.filterStatus) filters.push({ type: 'status', label: 'Status', value: this.getStatusText(this.filterStatus) });
                if (this.startDate) filters.push({ type: 'startDate', label: 'De', value: this.formatDisplayDate(this.startDate) });
                if (this.endDate) filters.push({ type: 'endDate', label: 'Até', value: this.formatDisplayDate(this.endDate) });
                return filters;
            },

            previousPage() {
                if (this.currentPage > 1) this.currentPage--;
            },

            nextPage() {
                if (this.currentPage < this.totalPages) this.currentPage++;
            },

            clearFilters() {
                this.search = '';
                this.filterCategory = '';
                this.filterStatus = '';
                this.startDate = '';
                this.endDate = '';
                this.currentPage = 1;
            },

            clearDateFilters() {
                this.startDate = '';
                this.endDate = '';
                this.currentPage = 1;
            },

            clearFilter(type) {
                if (type === 'search') this.search = '';
                if (type === 'category') this.filterCategory = '';
                if (type === 'status') this.filterStatus = '';
                if (type === 'startDate') this.startDate = '';
                if (type === 'endDate') this.endDate = '';
                this.currentPage = 1;
            },

            confirmDelete(publication) {
                this.publicationToDelete = publication;
                this.showModal = true;
            },

            getCategoryClasses(category) {
                const classes = {
                    'aviso': 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                    'testemunho': 'bg-purple-100 text-purple-800 border border-purple-200',
                    'blog': 'bg-green-100 text-green-800 border border-green-200'
                };
                return classes[category] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getCategoryText(category) {
                const texts = {
                    'aviso': 'Aviso',
                    'testemunho': 'Testemunho',
                    'blog': 'Blog'
                };
                return texts[category] || category;
            },

            getStatusClasses(status) {
                const classes = {
                    'publicado': 'bg-green-100 text-green-800 border border-green-200',
                    'rascunho': 'bg-gray-100 text-gray-800 border border-gray-200'
                };
                return classes[status] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getStatusText(status) {
                const texts = {
                    'publicado': 'Publicado',
                    'rascunho': 'Rascunho'
                };
                return texts[status] || status;
            },

            formatDate(dateString) {
                if (!dateString) return '';
                return new Date(dateString).toLocaleDateString('pt-BR');
            },

            formatDisplayDate(dateString) {
                if (!dateString) return '';
                return new Date(dateString + 'T00:00:00').toLocaleDateString('pt-BR');
            },
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>