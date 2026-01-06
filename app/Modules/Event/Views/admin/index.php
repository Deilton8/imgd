<?php ob_start(); ?>

<div x-data="eventDashboard()" x-cloak
    class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header com estatísticas -->
        <div class="mb-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8">
                <div>
                    <div class="flex items-center gap-4 mb-3">
                        <div
                            class="w-14 h-14 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Gerenciar Eventos</h1>
                            <p class="text-gray-600 mt-1">Gerencie todos os eventos do sistema</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/admin/evento/criar"
                        class="group inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white px-6 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 transform group-hover:rotate-90 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Novo Evento
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
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-5 border border-yellow-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Pendentes</p>
                            <p class="text-3xl font-bold text-yellow-600 mt-1" x-text="stats.pendente"></p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-yellow-100 to-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-5 border border-blue-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Em Andamento</p>
                            <p class="text-3xl font-bold text-blue-600 mt-1" x-text="stats.em_andamento"></p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-5 border border-green-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Concluídos</p>
                            <p class="text-3xl font-bold text-green-600 mt-1" x-text="stats.concluido"></p>
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
            </div>
        </div>

        <!-- Filtros Avançados -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Busca -->
                <div class="flex-1 max-w-lg">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Busca Avançada</label>
                    <div class="relative">
                        <input type="text" x-model.debounce.300ms="search"
                            placeholder="Buscar por título, local ou descrição..."
                            class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="relative">
                            <select x-model="filterStatus"
                                class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white appearance-none cursor-pointer">
                                <option value="">Todos os status</option>
                                <option value="pendente">🟡 Pendente</option>
                                <option value="em_andamento">🔵 Em andamento</option>
                                <option value="concluido">🟢 Concluído</option>
                                <option value="cancelado">🔴 Cancelado</option>
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

                    <!-- Período -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">De</label>
                        <input type="date" x-model="filterStartDate"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Até</label>
                        <input type="date" x-model="filterEndDate"
                            class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-gray-50 hover:bg-white focus:bg-white cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Filtros Ativos e Ações -->
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="text-sm text-gray-600">
                        <span class="font-medium" x-text="filteredEvents.length"></span> eventos encontrados
                    </div>

                    <div class="flex items-center gap-2" x-show="activeFilters.length > 0">
                        <template x-for="filter in activeFilters" :key="filter.type">
                            <span
                                class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1.5 rounded-lg text-xs font-medium">
                                <span x-text="filter.label"></span>
                                <span class="font-semibold" x-text="filter.value"></span>
                                <button @click="clearFilter(filter.type)"
                                    class="text-blue-600 hover:text-blue-800 transition-colors">
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
                    <button type="button" @click="toggleViewMode" :aria-pressed="viewMode === 'grid'"
                        aria-label="Alternar modo de visualização"
                        class="p-2.5 rounded-xl border transition-colors focus:outline-none focus:ring-2 focus:ring-blue-300"
                        :class="viewMode === 'grid'
        ? 'bg-blue-50 border-blue-300 text-blue-600'
        : 'border-gray-300 text-gray-600 hover:bg-gray-50'">

                        <!-- Ícone GRID -->
                        <svg x-show="viewMode === 'grid'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z
               M14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z
               M4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z
               M14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>

                        <!-- Ícone LISTA -->
                        <svg x-show="viewMode === 'list'" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </button>

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

        <!-- Conteúdo (Grid ou Lista) -->
        <template x-if="viewMode === 'grid'">
            <!-- Vista em Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="event in paginatedEvents" :key="event.id">
                    <div
                        class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
                        <!-- Header do Card -->
                        <div class="relative">
                            <div class="absolute top-4 left-4 z-10">
                                <span :class="getStatusClasses(event.status)"
                                    class="px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full" :class="getStatusDotClass(event.status)"></span>
                                    <span x-text="getStatusText(event.status)"></span>
                                </span>
                            </div>

                            <div class="absolute top-4 right-4 z-10">
                                <span class="text-xs font-medium text-gray-500">ID: <span
                                        x-text="event.id"></span></span>
                            </div>

                            <!-- Imagem de capa ou placeholder -->
                            <div class="h-48 bg-gradient-to-br from-blue-100 to-indigo-100 relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-blue-300 group-hover:scale-110 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Conteúdo do Card -->
                        <div class="p-5">
                            <h3
                                class="text-lg font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                <a :href="`/admin/evento/${event.id}`" class="hover:underline">
                                    <span x-text="event.titulo"></span>
                                </a>
                            </h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="event.descricao"
                                x-show="event.descricao"></p>

                            <div class="space-y-3 text-sm">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate" x-text="event.local || 'Local não informado'"></span>
                                </div>

                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span x-text="formatDate(event.data_inicio)"></span>
                                    <span x-text="formatTime(event.data_inicio)"></span>
                                </div>
                            </div>

                            <!-- Ações -->
                            <div class="flex items-center justify-between pt-5 mt-5 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <a :href="`/admin/evento/${event.id}`"
                                        class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Ver
                                    </a>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a :href="`/admin/evento/${event.id}/editar`"
                                        class="inline-flex items-center gap-1 text-green-600 hover:text-green-800 text-sm font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Editar
                                    </a>

                                    <button @click="confirmDelete(event)"
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
                    </div>
                </template>
            </div>
        </template>

        <template x-if="viewMode === 'list'">
            <!-- Vista em Lista -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <button @click="sortBy('id')" class="flex items-center gap-2 hover:text-gray-900">
                                        ID
                                        <svg class="w-4 h-4" :class="{'text-blue-500': sortField === 'id'}" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path x-show="sortField !== 'id' || sortDirection === 'desc'"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                            <path x-show="sortField === 'id' && sortDirection === 'asc'"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </button>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <button @click="sortBy('titulo')"
                                        class="flex items-center gap-2 hover:text-gray-900">
                                        Evento
                                        <svg class="w-4 h-4" :class="{'text-blue-500': sortField === 'titulo'}"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path x-show="sortField !== 'titulo' || sortDirection === 'desc'"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                            <path x-show="sortField === 'titulo' && sortDirection === 'asc'"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </button>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Data/Hora
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <template x-for="event in paginatedEvents" :key="event.id">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-gray-900" x-text="event.id"></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <a :href="`/admin/evento/${event.id}`"
                                                class="text-sm font-semibold text-gray-900 hover:text-blue-600 hover:underline">
                                                <span x-text="event.titulo"></span>
                                            </a>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-1" x-text="event.local"></p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900" x-text="formatDate(event.data_inicio)"></div>
                                        <div class="text-xs text-gray-500" x-text="formatTime(event.data_inicio)"></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span :class="getStatusClasses(event.status)"
                                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold">
                                            <span class="w-2 h-2 rounded-full"
                                                :class="getStatusDotClass(event.status)"></span>
                                            <span x-text="getStatusText(event.status)"></span>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a :href="`/admin/evento/${event.id}`"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-medium transition-colors">
                                                Ver
                                            </a>
                                            <a :href="`/admin/evento/${event.id}/editar`"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-50 text-green-700 hover:bg-green-100 rounded-lg text-xs font-medium transition-colors">
                                                Editar
                                            </a>
                                            <button @click="confirmDelete(event)"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 rounded-lg text-xs font-medium transition-colors">
                                                Excluir
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </template>

        <!-- Empty State -->
        <div x-show="filteredEvents.length === 0"
            class="bg-white rounded-2xl shadow-lg border-2 border-dashed border-gray-300 p-12 text-center">
            <div class="max-w-md mx-auto">
                <div
                    class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Nenhum evento encontrado</h3>
                <p class="text-gray-500 mb-6" x-show="hasActiveFilters">
                    Tente ajustar os filtros ou limpar todos para ver todos os eventos
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
                    <a href="/admin/evento/criar"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white px-6 py-3 rounded-xl font-medium shadow-sm hover:shadow transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Criar Primeiro Evento
                    </a>
                </div>
            </div>
        </div>

        <!-- Paginação -->
        <div class="mt-8" x-show="filteredEvents.length > 0">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="text-sm text-gray-600">
                        Mostrando <span class="font-semibold" x-text="startIndex + 1"></span> a
                        <span class="font-semibold" x-text="Math.min(endIndex, filteredEvents.length)"></span> de
                        <span class="font-semibold" x-text="filteredEvents.length"></span> eventos
                    </div>

                    <div class="flex items-center gap-2">
                        <button @click="previousPage" :disabled="currentPage === 1"
                            class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Anterior
                        </button>

                        <div class="flex items-center gap-1">
                            <template x-for="page in visiblePages" :key="page">
                                <button @click="currentPage = page"
                                    :class="page === currentPage ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
                                    class="w-10 h-10 rounded-xl text-sm font-medium transition-colors"
                                    x-text="page"></button>
                            </template>
                        </div>

                        <button @click="nextPage" :disabled="currentPage === totalPages"
                            class="px-4 py-2 border border-gray-300 rounded-xl hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-2">
                            Próxima
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
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

                <h2 class="text-xl font-bold text-gray-900 mb-2">Excluir Evento</h2>
                <template x-if="eventToDelete">
                    <p class="text-gray-600 mb-1">
                        <strong class="font-semibold" x-text="eventToDelete.titulo"></strong>
                    </p>
                </template>
                <p class="text-gray-500 text-sm mb-6">
                    Esta ação é irreversível. Todas as informações e mídias associadas serão removidas permanentemente.
                </p>

                <div class="flex justify-center gap-3">
                    <button @click="showDeleteModal = false"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium">
                        Cancelar
                    </button>
                    <a :href="`/admin/evento/${eventToDelete?.id}/deletar`"
                        class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 font-medium">
                        Sim, Excluir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function eventDashboard() {
        return {
            search: '',
            filterStatus: '',
            filterStartDate: '',
            filterEndDate: '',
            showDeleteModal: false,
            eventToDelete: null,
            currentPage: 1,
            pageSize: 9,
            sortField: 'id',
            sortDirection: 'desc',
            viewMode: 'grid',
            events: <?= json_encode($eventos, JSON_UNESCAPED_UNICODE) ?>,

            get stats() {
                const stats = {
                    total: this.events.length,
                    pendente: 0,
                    em_andamento: 0,
                    concluido: 0,
                    cancelado: 0
                };

                this.events.forEach(event => {
                    if (event.status) {
                        stats[event.status] = (stats[event.status] || 0) + 1;
                    }
                });

                return stats;
            },

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

            clearAllFilters() {
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

            toggleViewMode() {
                this.viewMode = this.viewMode === 'list' ? 'grid' : 'list';
            },

            confirmDelete(event) {
                this.eventToDelete = event;
                this.showDeleteModal = true;
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

            getStatusDotClass(status) {
                const classes = {
                    'pendente': 'bg-yellow-500',
                    'em_andamento': 'bg-blue-500',
                    'concluido': 'bg-green-500',
                    'cancelado': 'bg-red-500'
                };
                return classes[status] || 'bg-gray-500';
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
                // Configurações iniciais
                this.pageSize = this.viewMode === 'grid' ? 9 : 10;
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>