<?php ob_start(); ?>

<div x-data="eventTable()" x-cloak class="min-h-screen bg-gray-50/30 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                        <span
                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white">
                            📅
                        </span>
                        Gerenciar Eventos
                    </h1>
                    <p class="text-gray-600 mt-2 text-lg">Gerencie todos os eventos do sistema</p>
                </div>

                <a href="/admin/evento/criar"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white px-6 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span class="text-lg">+</span>
                    Novo Evento
                </a>
            </div>
        </div>

        <!-- 🔍 Filtros e Estatísticas -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                <!-- Busca -->
                <div class="flex-1 max-w-md">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="text-blue-500">🔍</span>
                        Buscar Eventos
                    </label>
                    <div class="relative">
                        <input type="text" x-model.debounce.300ms="search"
                            placeholder="Digite título, local ou descrição..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white placeholder-gray-400">
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
                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select x-model="filterStatus"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white appearance-none cursor-pointer">
                            <option value="">Todos os status</option>
                            <option value="pendente">🟡 Pendente</option>
                            <option value="em_andamento">🔵 Em andamento</option>
                            <option value="concluido">🟢 Concluído</option>
                            <option value="cancelado">🔴 Cancelado</option>
                        </select>
                    </div>

                    <!-- Data Início -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">De</label>
                        <input type="date" x-model="filterStartDate"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white cursor-pointer">
                    </div>

                    <!-- Data Fim -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Até</label>
                        <input type="date" x-model="filterEndDate"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white hover:bg-blue-50 focus:bg-white cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Estatísticas e Ações -->
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500">Total:</span>
                        <span class="font-semibold text-gray-900" x-text="filteredEvents.length"></span>
                        <span class="text-gray-400">eventos</span>
                    </div>

                    <div class="hidden sm:flex items-center gap-4" x-show="hasActiveFilters">
                        <template x-for="filter in activeFilters" :key="filter.label">
                            <span
                                class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                                <span x-text="filter.label"></span>: <span x-text="filter.value"></span>
                                <button @click="clearFilter(filter.type)"
                                    class="hover:text-blue-600 transition">×</button>
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
                    <thead class="bg-gradient-to-r from-gray-50 to-blue-50/30">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2 cursor-pointer" @click="sortBy('id')">
                                    ID
                                    <span class="text-gray-400" x-show="sortField === 'id'"
                                        x-text="sortDirection === 'asc' ? '↑' : '↓'"></span>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2 cursor-pointer" @click="sortBy('titulo')">
                                    Evento
                                    <span class="text-gray-400" x-show="sortField === 'titulo'"
                                        x-text="sortDirection === 'asc' ? '↑' : '↓'"></span>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Local
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2 cursor-pointer" @click="sortBy('data_inicio')">
                                    Data/Hora
                                    <span class="text-gray-400" x-show="sortField === 'data_inicio'"
                                        x-text="sortDirection === 'asc' ? '↑' : '↓'"></span>
                                </div>
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
                        <template x-for="event in paginatedEvents" :key="event.id">
                            <tr class="hover:bg-blue-50/50 transition-all duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900" x-text="event.id"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors"
                                            x-text="event.titulo"></span>
                                        <span class="text-xs text-gray-500 mt-1 line-clamp-2" x-text="event.descricao"
                                            x-show="event.descricao"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600" x-text="event.local"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col text-sm">
                                        <span class="text-gray-900 font-medium"
                                            x-text="formatDate(event.data_inicio)"></span>
                                        <template x-if="event.data_fim">
                                            <span class="text-gray-400 text-xs mt-1">até <span
                                                    x-text="formatDate(event.data_fim)"></span></span>
                                        </template>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getStatusClasses(event.status)"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold capitalize"
                                        x-text="getStatusText(event.status)"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="`/admin/evento/${event.id}`"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                                            title="Visualizar evento">
                                            👁️ Ver
                                        </a>
                                        <a :href="`/admin/evento/${event.id}/editar`"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1"
                                            title="Editar evento">
                                            ✏️ Editar
                                        </a>
                                        <button type="button" @click="confirmDelete(event)"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                                            title="Excluir evento">
                                            🗑️ Excluir
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <template x-if="filteredEvents.length === 0">
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <span class="text-6xl mb-4">📅</span>
                                        <p class="text-lg font-medium text-gray-500 mb-2">Nenhum evento encontrado</p>
                                        <p class="text-sm text-gray-400 mb-4" x-show="hasActiveFilters">
                                            Tente ajustar os filtros ou <button @click="clearFilters"
                                                class="text-blue-600 hover:text-blue-700 underline">limpar todos os
                                                filtros</button>
                                        </p>
                                        <a href="/admin/evento/criar"
                                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                            <span>+</span>
                                            Criar Primeiro Evento
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
                x-show="filteredEvents.length > 0">
                <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                    Mostrando <span class="font-semibold" x-text="startIndex + 1"></span> a
                    <span class="font-semibold" x-text="Math.min(endIndex, filteredEvents.length)"></span> de
                    <span class="font-semibold" x-text="filteredEvents.length"></span> eventos
                </div>

                <div class="flex items-center gap-2">
                    <button @click="previousPage" :disabled="currentPage === 1"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-white disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                        ← Anterior
                    </button>

                    <div class="flex items-center gap-1">
                        <template x-for="page in visiblePages" :key="page">
                            <button @click="currentPage = page"
                                :class="page === currentPage ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
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

                <h2 class="text-xl font-bold text-gray-900 mb-2">Excluir Evento?</h2>
                <template x-if="eventToDelete">
                    <p class="text-gray-600 mb-1">
                        <strong x-text="eventToDelete.titulo"></strong>
                    </p>
                </template>
                <p class="text-gray-500 text-sm mb-6">
                    Esta ação não pode ser desfeita. O evento será permanentemente removido.
                </p>

                <div class="flex justify-center gap-3">
                    <button @click="showModal = false"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        Cancelar
                    </button>
                    <a :href="`/admin/evento/${eventToDelete?.id}/deletar`"
                        class="px-6 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-500 shadow-lg hover:shadow-xl transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Sim, Excluir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function eventTable() {
        return {
            search: '',
            filterStatus: '',
            filterStartDate: '',
            filterEndDate: '',
            showModal: false,
            eventToDelete: null,
            currentPage: 1,
            pageSize: 10,
            sortField: 'id',
            sortDirection: 'desc',
            events: <?= json_encode($eventos, JSON_UNESCAPED_UNICODE) ?>,

            get filteredEvents() {
                let filtered = this.events.filter(e => {
                    const matchSearch = !this.search ||
                        e.titulo?.toLowerCase().includes(this.search.toLowerCase()) ||
                        e.local?.toLowerCase().includes(this.search.toLowerCase()) ||
                        e.descricao?.toLowerCase().includes(this.search.toLowerCase());

                    const matchStatus = !this.filterStatus || e.status === this.filterStatus;

                    const matchStartDate = !this.filterStartDate ||
                        new Date(e.data_inicio) >= new Date(this.filterStartDate + 'T00:00:00');

                    const matchEndDate = !this.filterEndDate ||
                        new Date(e.data_fim || e.data_inicio) <= new Date(this.filterEndDate + 'T23:59:59');

                    return matchSearch && matchStatus && matchStartDate && matchEndDate;
                });

                // Ordenação
                filtered.sort((a, b) => {
                    let aVal = a[this.sortField];
                    let bVal = b[this.sortField];

                    if (this.sortField.includes('data')) {
                        aVal = new Date(aVal);
                        bVal = new Date(bVal);
                    }

                    if (aVal < bVal) return this.sortDirection === 'asc' ? -1 : 1;
                    if (aVal > bVal) return this.sortDirection === 'asc' ? 1 : -1;
                    return 0;
                });

                return filtered;
            },

            get paginatedEvents() {
                const start = (this.currentPage - 1) * this.pageSize;
                return this.filteredEvents.slice(start, start + this.pageSize);
            },

            get totalPages() {
                return Math.ceil(this.filteredEvents.length / this.pageSize);
            },

            get startIndex() {
                return (this.currentPage - 1) * this.pageSize;
            },

            get endIndex() {
                return Math.min(this.startIndex + this.pageSize, this.filteredEvents.length);
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
                return this.search || this.filterStatus || this.filterStartDate || this.filterEndDate;
            },

            get activeFilters() {
                const filters = [];
                if (this.search) filters.push({ type: 'search', label: 'Busca', value: this.search });
                if (this.filterStatus) filters.push({ type: 'status', label: 'Status', value: this.getStatusText(this.filterStatus) });
                if (this.filterStartDate) filters.push({ type: 'startDate', label: 'De', value: this.formatDisplayDate(this.filterStartDate) });
                if (this.filterEndDate) filters.push({ type: 'endDate', label: 'Até', value: this.formatDisplayDate(this.filterEndDate) });
                return filters;
            },

            sortBy(field) {
                if (this.sortField === field) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortField = field;
                    this.sortDirection = 'desc';
                }
                this.currentPage = 1;
            },

            previousPage() {
                if (this.currentPage > 1) this.currentPage--;
            },

            nextPage() {
                if (this.currentPage < this.totalPages) this.currentPage++;
            },

            clearFilters() {
                this.search = '';
                this.filterStatus = '';
                this.filterStartDate = '';
                this.filterEndDate = '';
                this.currentPage = 1;
            },

            clearFilter(type) {
                if (type === 'search') this.search = '';
                if (type === 'status') this.filterStatus = '';
                if (type === 'startDate') this.filterStartDate = '';
                if (type === 'endDate') this.filterEndDate = '';
                this.currentPage = 1;
            },

            confirmDelete(event) {
                this.eventToDelete = event;
                this.showModal = true;
            },

            getStatusClasses(status) {
                const classes = {
                    'pendente': 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                    'em_andamento': 'bg-blue-100 text-blue-800 border border-blue-200',
                    'concluido': 'bg-green-100 text-green-800 border border-green-200',
                    'cancelado': 'bg-red-100 text-red-800 border border-red-200'
                };
                return classes[status] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getStatusText(status) {
                const texts = {
                    'pendente': 'Pendente',
                    'em_andamento': 'Em Andamento',
                    'concluido': 'Concluído',
                    'cancelado': 'Cancelado'
                };
                return texts[status] || status;
            },

            formatDate(dateString) {
                if (!dateString) return '';
                return new Date(dateString).toLocaleDateString('pt-BR');
            },

            formatTime(dateString) {
                if (!dateString) return '';
                return new Date(dateString).toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
            },

            formatDisplayDate(dateString) {
                if (!dateString) return '';
                return new Date(dateString + 'T00:00:00').toLocaleDateString('pt-BR');
            },

            init() {
                // Configurar data padrão para filtros se necessário
                const today = new Date().toISOString().split('T')[0];
                // this.filterStartDate = today;
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>