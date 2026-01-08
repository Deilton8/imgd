<?php ob_start();
$flashMessage = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<div x-data="userDashboard()" x-cloak
    class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header com estatísticas -->
        <div class="mb-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8">
                <div>
                    <div class="flex items-center gap-4 mb-3">
                        <div
                            class="w-14 h-14 bg-gradient-to-r from-cyan-600 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-6.5a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Gerenciar Usuários</h1>
                            <p class="text-gray-600 mt-1">Gerencie todos os usuários do sistema</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/admin/usuario/criar"
                        class="group inline-flex items-center gap-2 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white px-6 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 font-semibold focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 transform group-hover:rotate-90 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Novo Usuário
                    </a>
                </div>
            </div>

            <!-- Dashboard Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div
                    class="bg-white rounded-2xl p-5 border border-blue-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1" x-text="stats.total"></p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-5 border border-green-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Ativos</p>
                            <p class="text-3xl font-bold text-green-600 mt-1" x-text="stats.ativo"></p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-5 border border-purple-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Administradores</p>
                            <p class="text-3xl font-bold text-purple-600 mt-1" x-text="stats.admin"></p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-100 to-violet-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-red-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Inativos</p>
                            <p class="text-3xl font-bold text-red-600 mt-1" x-text="stats.inativo"></p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-red-100 to-rose-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros Avançados -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Busca -->
                <div class="flex-1 max-w-lg">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Busca Avançada</label>
                    <div class="relative">
                        <input type="text" x-model.debounce.300ms="search" placeholder="Buscar por nome ou email..."
                            class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="relative">
                            <select x-model="filterRole"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                <option value="">Todos os papéis</option>
                                <option value="admin">👑 Administrador</option>
                                <option value="editor">✏️ Editor</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <div class="relative">
                            <select x-model="filterStatus"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                <option value="">Todos os status</option>
                                <option value="ativo">🟢 Ativo</option>
                                <option value="inativo">🔴 Inativo</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros Ativos e Ações -->
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="text-sm text-gray-600">
                        <span class="font-medium" x-text="filteredUsers.length"></span> usuários encontrados
                    </div>

                    <div class="flex items-center gap-2" x-show="activeFilters.length > 0">
                        <template x-for="filter in activeFilters" :key="filter.type">
                            <span
                                class="inline-flex items-center gap-2 bg-cyan-100 text-cyan-800 px-3 py-1.5 rounded-lg text-xs font-medium">
                                <span x-text="filter.label"></span>
                                <span class="font-semibold" x-text="filter.value"></span>
                                <button @click="clearFilter(filter.type)"
                                    class="text-cyan-600 hover:text-cyan-800 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        </template>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button @click="clearAllFilters" x-show="hasActiveFilters"
                        class="inline-flex items-center gap-2 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Limpar Filtros
                    </button>
                </div>
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
                class="mb-8 p-4 rounded-2xl border-l-4 <?= $flashMessage['type'] === 'error' ? 'bg-red-50 border-red-400 text-red-700' : 'bg-green-50 border-green-400 text-green-700' ?>">
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

        <!-- Vista em Tabela -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-cyan-50/50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <button @click="sortBy('nome')" class="flex items-center gap-2 hover:text-gray-900">
                                    Usuário
                                    <svg class="w-4 h-4" :class="{'text-cyan-500': sortField === 'nome'}" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path x-show="sortField !== 'nome' || sortDirection === 'desc'"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        <path x-show="sortField === 'nome' && sortDirection === 'asc'"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Contato</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <button @click="sortBy('papel')" class="flex items-center gap-2 hover:text-gray-900">
                                    Papel
                                    <svg class="w-4 h-4" :class="{'text-cyan-500': sortField === 'papel'}" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path x-show="sortField !== 'papel' || sortDirection === 'desc'"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        <path x-show="sortField === 'papel' && sortDirection === 'asc'"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <button @click="sortBy('status')" class="flex items-center gap-2 hover:text-gray-900">
                                    Status
                                    <svg class="w-4 h-4" :class="{'text-cyan-500': sortField === 'status'}" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path x-show="sortField !== 'status' || sortDirection === 'desc'"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        <path x-show="sortField === 'status' && sortDirection === 'asc'"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </button>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Cadastro</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <template x-for="user in paginatedUsers" :key="user.id">
                            <tr class="hover:bg-cyan-50/30 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-sm">
                                            <span x-text="getUserInitials(user.nome)"></span>
                                        </div>
                                        <div>
                                            <a :href="`/admin/usuario/${user.id}`"
                                                class="font-semibold text-gray-900 hover:text-cyan-600 hover:underline transition-colors block">
                                                <span x-text="user.nome"></span>
                                            </a>
                                            <span class="text-xs text-gray-500" x-text="'ID: ' + user.id"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900" x-text="user.email"></div>
                                    <div class="text-xs text-gray-500" x-text="user.telefone || 'Sem telefone'"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getRoleClasses(user.papel)"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold capitalize">
                                        <span class="w-2 h-2 rounded-full" :class="getRoleDotClass(user.papel)"></span>
                                        <span x-text="getRoleText(user.papel)"></span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getStatusClasses(user.status)"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold capitalize">
                                        <span class="w-2 h-2 rounded-full"
                                            :class="getStatusDotClass(user.status)"></span>
                                        <span x-text="getStatusText(user.status)"></span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900" x-text="formatDate(user.criado_em)"></div>
                                    <div class="text-xs text-gray-500" x-text="formatTime(user.criado_em)"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a :href="`/admin/usuario/${user.id}`"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Ver
                                        </a>
                                        <a :href="`/admin/usuario/${user.id}/editar`"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-50 text-green-700 hover:bg-green-100 rounded-lg text-xs font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Editar
                                        </a>
                                        <button @click="confirmDelete(user)" :disabled="user.id === currentUserId"
                                            :class="user.id === currentUserId ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-100'"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Excluir
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div x-show="filteredUsers.length === 0" class="px-6 py-12 text-center">
                <div class="max-w-md mx-auto">
                    <div
                        class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-6.5a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Nenhum usuário encontrado</h3>
                    <p class="text-gray-500 mb-6" x-show="hasActiveFilters">
                        Tente ajustar os filtros ou limpar todos para ver todos os usuários
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <button @click="clearAllFilters" x-show="hasActiveFilters"
                            class="inline-flex items-center gap-2 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Limpar Filtros
                        </button>
                        <a href="/admin/usuario/criar"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white px-6 py-3 rounded-xl font-medium shadow-sm hover:shadow transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Criar Primeiro Usuário
                        </a>
                    </div>
                </div>
            </div>

            <!-- Paginação -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between px-6 py-4 border-t border-gray-200 bg-gray-50/50"
                x-show="filteredUsers.length > 0">
                <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                    Mostrando <span class="font-semibold" x-text="startIndex + 1"></span> a
                    <span class="font-semibold" x-text="Math.min(endIndex, filteredUsers.length)"></span> de
                    <span class="font-semibold" x-text="filteredUsers.length"></span> usuários
                </div>

                <div class="flex items-center gap-2">
                    <button @click="previousPage" :disabled="currentPage === 1"
                        class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Anterior
                    </button>

                    <div class="flex items-center gap-1">
                        <template x-for="page in visiblePages" :key="page">
                            <button @click="currentPage = page"
                                :class="page === currentPage ? 'bg-cyan-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
                                class="w-10 h-10 rounded-xl text-sm font-medium transition-colors"
                                x-text="page"></button>
                        </template>
                    </div>

                    <button @click="nextPage" :disabled="currentPage === totalPages"
                        class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-2">
                        Próxima
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Exclusão -->
    <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;">
        <div class="absolute inset-0 bg-black bg-opacity-50" @click="showDeleteModal = false"></div>

        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
            <div class="text-center">
                <div
                    class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-gray-900 mb-2">Excluir Usuário</h2>
                <template x-if="userToDelete">
                    <div class="mb-4">
                        <div class="flex items-center justify-center gap-3">
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
                    Esta ação é irreversível. Todas as informações do usuário serão removidas permanentemente.
                </p>

                <div class="flex justify-center gap-3">
                    <button @click="showDeleteModal = false"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium">
                        Cancelar
                    </button>
                    <a :href="`/admin/usuario/${userToDelete?.id}/deletar`"
                        class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 font-medium">
                        Sim, Excluir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function userDashboard() {
        return {
            search: '',
            filterRole: '',
            filterStatus: '',
            showDeleteModal: false,
            userToDelete: null,
            currentUserId: <?= $_SESSION['usuario']['id'] ?? 0 ?>,
            currentPage: 1,
            pageSize: 10,
            sortField: 'nome',
            sortDirection: 'asc',
            users: <?= json_encode($usuarios, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,

            get stats() {
                const stats = {
                    total: this.users.length,
                    ativo: 0,
                    inativo: 0,
                    admin: 0,
                    editor: 0
                };

                this.users.forEach(user => {
                    if (user.status) stats[user.status] = (stats[user.status] || 0) + 1;
                    if (user.papel) stats[user.papel] = (stats[user.papel] || 0) + 1;
                });

                return stats;
            },

            get filteredUsers() {
                let filtered = this.users.filter(u => {
                    const matchSearch = !this.search ||
                        u.nome?.toLowerCase().includes(this.search.toLowerCase()) ||
                        u.email?.toLowerCase().includes(this.search.toLowerCase());

                    const matchRole = !this.filterRole || u.papel === this.filterRole;
                    const matchStatus = !this.filterStatus || u.status === this.filterStatus;

                    return matchSearch && matchRole && matchStatus;
                });

                // Ordenação
                filtered.sort((a, b) => {
                    let aVal = a[this.sortField];
                    let bVal = b[this.sortField];

                    if (aVal < bVal) return this.sortDirection === 'asc' ? -1 : 1;
                    if (aVal > bVal) return this.sortDirection === 'asc' ? 1 : -1;
                    return 0;
                });

                return filtered;
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

            sortBy(field) {
                if (this.sortField === field) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    this.sortField = field;
                    this.sortDirection = 'asc';
                }
                this.currentPage = 1;
            },

            previousPage() {
                if (this.currentPage > 1) this.currentPage--;
            },

            nextPage() {
                if (this.currentPage < this.totalPages) this.currentPage++;
            },

            clearAllFilters() {
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
                this.showDeleteModal = true;
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

            getRoleDotClass(role) {
                const classes = {
                    'admin': 'bg-purple-500',
                    'editor': 'bg-blue-500'
                };
                return classes[role] || 'bg-gray-500';
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

            getStatusDotClass(status) {
                const classes = {
                    'ativo': 'bg-green-500',
                    'inativo': 'bg-red-500'
                };
                return classes[status] || 'bg-gray-500';
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
            },

            init() {
                // Configurações iniciais
                this.pageSize = 10;
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../Shared/Views/layout.php";
?>