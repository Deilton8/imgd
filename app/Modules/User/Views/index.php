<?php
ob_start();
// Adicionar no início do arquivo
$flashMessage = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<div x-data="userTable()" x-cloak class="min-h-screen bg-gray-50/30 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                        <span
                            class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white">
                            👥
                        </span>
                        Gerenciar Usuários
                    </h1>
                    <p class="text-gray-600 mt-2 text-lg">Gerencie os usuários e permissões do sistema</p>
                </div>

                <a href="/admin/usuario/criar"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white px-6 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 font-semibold focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">
                    <span class="text-lg">+</span>
                    Novo Usuário
                </a>
            </div>
        </div>

        <!-- Notificação Flash -->
        <?php if ($flashMessage): ?>
            <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2"
                class="mb-6 p-4 rounded-2xl border-l-4 <?= $flashMessage['type'] === 'error' ? 'bg-red-50 border-red-400 text-red-700' : 'bg-green-50 border-green-400 text-green-700' ?>">
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

        <!-- 🔍 Filtros e Estatísticas -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                <!-- Busca -->
                <div class="flex-1 max-w-md">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="text-cyan-500">🔍</span>
                        Buscar Usuários
                    </label>
                    <div class="relative">
                        <input type="text" x-model.debounce.300ms="search" placeholder="Digite nome ou email..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-300 bg-white hover:bg-cyan-50 focus:bg-white placeholder-gray-400">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Papel -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Papel</label>
                        <select x-model="filterRole"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-300 bg-white hover:bg-cyan-50 focus:bg-white appearance-none cursor-pointer">
                            <option value="">Todos os papéis</option>
                            <option value="admin">👑 Administrador</option>
                            <option value="editor">✏️ Editor</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select x-model="filterStatus"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-300 bg-white hover:bg-cyan-50 focus:bg-white appearance-none cursor-pointer">
                            <option value="">Todos os status</option>
                            <option value="ativo">🟢 Ativo</option>
                            <option value="inativo">🔴 Inativo</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Estatísticas e Ações -->
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500">Total:</span>
                        <span class="font-semibold text-gray-900" x-text="filteredUsers.length"></span>
                        <span class="text-gray-400">usuários</span>
                    </div>

                    <div class="hidden sm:flex items-center gap-4" x-show="hasActiveFilters">
                        <template x-for="filter in activeFilters" :key="filter.label">
                            <span
                                class="inline-flex items-center gap-1 bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-xs font-medium">
                                <span x-text="filter.label"></span>: <span x-text="filter.value"></span>
                                <button @click="clearFilter(filter.type)"
                                    class="hover:text-cyan-600 transition">×</button>
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
                    <thead class="bg-gradient-to-r from-gray-50 to-cyan-50/30">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Usuário
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Contato
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Papel
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Status
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Cadastro
                            </th>
                            <th
                                class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <template x-for="user in paginatedUsers" :key="user.id">
                            <tr class="hover:bg-cyan-50/50 transition-all duration-200 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            <span x-text="getUserInitials(user.nome)"></span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-semibold text-gray-900 group-hover:text-cyan-600 transition-colors"
                                                x-text="user.nome"></span>
                                            <span class="text-xs text-gray-500" x-text="'ID: ' + user.id"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-900" x-text="user.email"></span>
                                        <span class="text-xs text-gray-500"
                                            x-text="user.telefone || 'Sem telefone'"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getRoleClasses(user.papel)"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold capitalize"
                                        x-text="getRoleText(user.papel)"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getStatusClasses(user.status)"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold capitalize"
                                        x-text="getStatusText(user.status)"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col text-sm">
                                        <span class="text-gray-900 font-medium"
                                            x-text="formatDate(user.criado_em)"></span>
                                        <span class="text-gray-500 text-xs" x-text="formatTime(user.criado_em)"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="`/admin/usuario/${user.id}`"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                                            title="Visualizar usuário">
                                            👁️ Ver
                                        </a>
                                        <a :href="`/admin/usuario/${user.id}/editar`"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1"
                                            title="Editar usuário">
                                            ✏️ Editar
                                        </a>
                                        <button type="button" @click="confirmDelete(user)"
                                            :disabled="user.id === currentUserId" :class="user.id === currentUserId ? 
                                                'bg-gray-100 text-gray-400 cursor-not-allowed' : 
                                                'bg-red-100 text-red-700 hover:bg-red-200'"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg transition-all duration-300 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                                            :title="user.id === currentUserId ? 'Você não pode excluir sua própria conta' : 'Excluir usuário'">
                                            🗑️ Excluir
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <template x-if="filteredUsers.length === 0">
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <span class="text-6xl mb-4">👥</span>
                                        <p class="text-lg font-medium text-gray-500 mb-2">Nenhum usuário encontrado</p>
                                        <p class="text-sm text-gray-400 mb-4" x-show="hasActiveFilters">
                                            Tente ajustar os filtros ou <button @click="clearFilters"
                                                class="text-cyan-600 hover:text-cyan-700 underline">limpar todos os
                                                filtros</button>
                                        </p>
                                        <a href="/admin/usuario/criar"
                                            class="inline-flex items-center gap-2 bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg transition-colors">
                                            <span>+</span>
                                            Criar Primeiro Usuário
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
                x-show="filteredUsers.length > 0">
                <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                    Mostrando <span class="font-semibold" x-text="startIndex + 1"></span> a
                    <span class="font-semibold" x-text="Math.min(endIndex, filteredUsers.length)"></span> de
                    <span class="font-semibold" x-text="filteredUsers.length"></span> usuários
                </div>

                <div class="flex items-center gap-2">
                    <button @click="previousPage" :disabled="currentPage === 1"
                        class="px-3 py-1.5 border border-gray-300 rounded-lg hover:bg-white disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                        ← Anterior
                    </button>

                    <div class="flex items-center gap-1">
                        <template x-for="page in visiblePages" :key="page">
                            <button @click="currentPage = page"
                                :class="page === currentPage ? 'bg-cyan-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
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

                <h2 class="text-xl font-bold text-gray-900 mb-2">Excluir Usuário?</h2>
                <template x-if="userToDelete">
                    <div class="mb-4">
                        <div class="flex items-center justify-center gap-3 mb-2">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                <span x-text="getUserInitials(userToDelete.nome)"></span>
                            </div>
                            <div class="text-left">
                                <p class="font-semibold text-gray-800" x-text="userToDelete.nome"></p>
                                <p class="text-sm text-gray-600" x-text="userToDelete.email"></p>
                            </div>
                        </div>
                    </div>
                </template>
                <p class="text-gray-500 text-sm mb-6">
                    Esta ação não pode ser desfeita. O usuário será permanentemente removido do sistema.
                </p>

                <div class="flex justify-center gap-3">
                    <button @click="showModal = false"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        Cancelar
                    </button>
                    <a :href="`/admin/usuario/${userToDelete?.id}/deletar`"
                        class="px-6 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-500 shadow-lg hover:shadow-xl transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Sim, Excluir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function userTable() {
        return {
            search: '<?= htmlspecialchars($search ?? '') ?>',
            filterRole: '<?= htmlspecialchars($role ?? '') ?>',
            filterStatus: '<?= htmlspecialchars($status ?? '') ?>',
            showModal: false,
            userToDelete: null,
            currentUserId: <?= $_SESSION['usuario']['id'] ?? 0 ?>,
            currentPage: 1,
            pageSize: 10,
            users: <?= json_encode($usuarios, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,

            get filteredUsers() {
                return this.users.filter(u => {
                    const matchSearch = !this.search ||
                        u.nome?.toLowerCase().includes(this.search.toLowerCase()) ||
                        u.email?.toLowerCase().includes(this.search.toLowerCase());
                    const matchRole = !this.filterRole || u.papel === this.filterRole;
                    const matchStatus = !this.filterStatus || u.status === this.filterStatus;
                    return matchSearch && matchRole && matchStatus;
                });
            },

            get paginatedUsers() {
                const start = (this.currentPage - 1) * this.pageSize;
                return this.filteredUsers.slice(start, start + this.pageSize);
            },

            get totalPages() {
                return Math.ceil(this.filteredUsers.length / this.pageSize);
            },

            get startIndex() {
                return (this.currentPage - 1) * this.pageSize;
            },

            get endIndex() {
                return Math.min(this.startIndex + this.pageSize, this.filteredUsers.length);
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
                return this.search || this.filterRole || this.filterStatus;
            },

            get activeFilters() {
                const filters = [];
                if (this.search) filters.push({ type: 'search', label: 'Busca', value: this.search });
                if (this.filterRole) filters.push({ type: 'role', label: 'Papel', value: this.getRoleText(this.filterRole) });
                if (this.filterStatus) filters.push({ type: 'status', label: 'Status', value: this.getStatusText(this.filterStatus) });
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
                this.filterRole = '';
                this.filterStatus = '';
                this.currentPage = 1;
            },

            clearFilter(type) {
                if (type === 'search') this.search = '';
                if (type === 'role') this.filterRole = '';
                if (type === 'status') this.filterStatus = '';
                this.currentPage = 1;
            },

            confirmDelete(user) {
                if (user.id === this.currentUserId) {
                    alert('Você não pode excluir sua própria conta.');
                    return;
                }
                this.userToDelete = user;
                this.showModal = true;
            },

            getUserInitials(name) {
                if (!name) return '?';
                return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
            },

            getRoleClasses(role) {
                const classes = {
                    'admin': 'bg-purple-100 text-purple-800 border border-purple-200',
                    'editor': 'bg-blue-100 text-blue-800 border border-blue-200'
                };
                return classes[role] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getRoleText(role) {
                const texts = {
                    'admin': 'Administrador',
                    'editor': 'Editor'
                };
                return texts[role] || role;
            },

            getStatusClasses(status) {
                const classes = {
                    'ativo': 'bg-green-100 text-green-800 border border-green-200',
                    'inativo': 'bg-red-100 text-red-800 border border-red-200'
                };
                return classes[status] || 'bg-gray-100 text-gray-800 border border-gray-200';
            },

            getStatusText(status) {
                const texts = {
                    'ativo': 'Ativo',
                    'inativo': 'Inativo'
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
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout.php";
?>