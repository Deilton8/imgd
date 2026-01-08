<?php
ob_start();

// Preparar dados
$dadosMensagem = [
    'id' => (int) $mensagem['id'],
    'nome' => htmlspecialchars($mensagem['nome'], ENT_QUOTES, 'UTF-8'),
    'email' => htmlspecialchars($mensagem['email'], ENT_QUOTES, 'UTF-8'),
    'assunto' => htmlspecialchars($mensagem['assunto'], ENT_QUOTES, 'UTF-8'),
    'mensagem' => nl2br(htmlspecialchars($mensagem['mensagem'], ENT_QUOTES, 'UTF-8')),
    'criado_em' => $mensagem['criado_em_formatado'],
    'inicial' => strtoupper(substr($mensagem['nome'], 0, 1))
];

// Calcular tempo desde o envio
$criadoEm = DateTime::createFromFormat('Y-m-d H:i:s', $mensagem['criado_em']);
$hoje = new DateTime();
$intervalo = $hoje->diff($criadoEm);
$tempoAtras = '';

if ($intervalo->days > 0) {
    $tempoAtras = $intervalo->days . ' dia' . ($intervalo->days !== 1 ? 's' : '');
} elseif ($intervalo->h > 0) {
    $tempoAtras = $intervalo->h . ' hora' . ($intervalo->h !== 1 ? 's' : '');
} else {
    $tempoAtras = $intervalo->i . ' minuto' . ($intervalo->i !== 1 ? 's' : '');
}
$tempoAtras = 'Enviada há ' . $tempoAtras;
?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50/30 py-8 px-4 sm:px-6 lg:px-8"
    x-data="mensagemView()" x-cloak>
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-6">
                <div class="flex items-start gap-4">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-indigo-600 to-purple-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-3xl font-bold text-gray-900">Mensagem de Contato</h1>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-indigo-500 to-purple-500 text-white">
                                ID: <?= $dadosMensagem['id'] ?>
                            </span>
                        </div>
                        <p class="text-gray-600">Detalhes da mensagem recebida</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="/admin/contato"
                        class="group inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl hover:border-gray-400 hover:shadow-lg transition-all duration-300 font-medium text-gray-700">
                        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Voltar à Lista
                    </a>
                </div>
            </div>

            <!-- Status Banner -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 bg-blue-100 text-blue-800 border border-blue-200">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            <span>Mensagem Recebida</span>
                        </div>

                        <div class="text-sm text-gray-600">
                            <span class="font-medium"><?= $dadosMensagem['nome'] ?></span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-sm text-gray-500">
                            <?= $tempoAtras ?>
                        </div>
                        <div class="text-sm text-gray-500">
                            Data: <?= $dadosMensagem['criado_em'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Principal -->
        <div class="space-y-8">
            <!-- Card de Informações do Remetente -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Remetente</h2>
                </div>

                <div class="p-6">
                    <div class="flex items-start gap-6">
                        <!-- Avatar -->
                        <div
                            class="w-20 h-20 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-2xl font-bold shadow-lg flex-shrink-0">
                            <?= $dadosMensagem['inicial'] ?>
                        </div>

                        <!-- Informações -->
                        <div class="flex-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Nome Completo
                                    </h3>
                                    <p class="text-gray-900 font-medium text-lg"><?= $dadosMensagem['nome'] ?></p>
                                </div>

                                <div>
                                    <h3 class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Email
                                    </h3>
                                    <p class="text-gray-900 font-medium text-lg"><?= $dadosMensagem['email'] ?></p>
                                </div>

                                <div>
                                    <h3 class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                        ID da Mensagem
                                    </h3>
                                    <p class="font-mono text-gray-900 font-medium text-lg">#<?= $dadosMensagem['id'] ?>
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Data de Envio
                                    </h3>
                                    <p class="text-gray-900 font-medium text-lg"><?= $dadosMensagem['criado_em'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Assunto -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-cyan-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Assunto</h2>
                </div>

                <div class="p-6">
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1"><?= $dadosMensagem['assunto'] ?></h3>
                                <p class="text-gray-600 text-sm">Assunto principal da mensagem</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Mensagem -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Mensagem</h2>
                </div>

                <div class="p-6">
                    <div
                        class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200 min-h-[300px]">
                        <div class="flex items-start gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Conteúdo da Mensagem</h3>
                                <p class="text-gray-600 text-sm">Mensagem completa enviada pelo remetente</p>
                            </div>
                        </div>

                        <div class="prose max-w-none">
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                                <?= $dadosMensagem['mensagem'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Ações -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Ações</h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <a href="mailto:<?= $dadosMensagem['email'] ?>?subject=Re: <?= urlencode($dadosMensagem['assunto']) ?>"
                            class="group flex flex-col items-center justify-center p-6 bg-gradient-to-r from-indigo-50 to-blue-100 hover:from-indigo-100 hover:to-blue-200 rounded-xl border border-indigo-200 transition-all duration-300 text-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="font-semibold text-gray-900">Responder por Email</p>
                            <p class="text-xs text-gray-600 mt-1">Abrir cliente de email</p>
                        </a>

                        <button @click="copyEmail()"
                            class="group flex flex-col items-center justify-center p-6 bg-gradient-to-r from-green-50 to-emerald-100 hover:from-green-100 hover:to-emerald-200 rounded-xl border border-green-200 transition-all duration-300 text-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="font-semibold text-gray-900">Copiar Email</p>
                            <p class="text-xs text-gray-600 mt-1" x-text="copyStatus"></p>
                        </button>

                        <button @click="showDeleteModal = true"
                            class="group flex flex-col items-center justify-center p-6 bg-gradient-to-r from-red-50 to-rose-100 hover:from-red-100 hover:to-rose-200 rounded-xl border border-red-200 transition-all duration-300 text-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-red-500 to-rose-600 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                            <p class="font-semibold text-red-900">Excluir Mensagem</p>
                            <p class="text-xs text-red-600 mt-1">Remover permanentemente</p>
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

                <h2 class="text-xl font-bold text-gray-900 mb-2">Excluir Mensagem</h2>
                <p class="text-gray-600 mb-1">
                    <strong class="font-semibold"><?= $dadosMensagem['nome'] ?></strong>
                </p>
                <p class="text-gray-500 text-sm mb-6">
                    Tem certeza que deseja excluir esta mensagem? Esta ação não pode ser desfeita.
                </p>

                <div class="flex justify-center gap-3">
                    <button @click="showDeleteModal = false"
                        class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:text-gray-900 hover:shadow-lg transition-all duration-300 font-medium">
                        Cancelar
                    </button>
                    <a href="/admin/contato/<?= $dadosMensagem['id'] ?>/deletar"
                        class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 font-medium">
                        Sim, Excluir
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mensagemView() {
        return {
            showDeleteModal: false,
            copyStatus: 'Clique para copiar',

            copyEmail() {
                const email = '<?= $dadosMensagem['email'] ?>';
                navigator.clipboard.writeText(email).then(() => {
                    this.copyStatus = 'Email copiado!';
                    setTimeout(() => {
                        this.copyStatus = 'Clique para copiar';
                    }, 2000);
                }).catch(err => {
                    console.error('Erro ao copiar:', err);
                    this.copyStatus = 'Erro ao copiar';
                });
            }
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . "/../../../Shared/Views/layout.php";
?>