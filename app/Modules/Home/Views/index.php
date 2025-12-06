<?php
declare(strict_types=1);

ob_start();

try {
    // Array com a estrutura da página para melhor organização e manutenção
    $sections = [
        'banner' => 'Hero / Banner',
        'sobre' => 'Sobre',
        'countdown' => 'Countdown',
        'sermoes' => 'Sermões',
        'apostoloJeque' => 'Biografia do Apóstolo Jeque',
        'publicacoes' => 'Publicações',
        'acaoSocial' => 'Ação Social',
        'contacto' => 'Contacto',
        'mapa' => 'Mapa'
    ];

    // Diretório base dos partials
    $partialsDir = __DIR__ . '/partials/';

    // Carrega cada seção com tratamento de erro
    foreach ($sections as $partial => $sectionName) {
        $filePath = $partialsDir . $partial . '.php';

        if (file_exists($filePath)) {
            include $filePath;
        } else {
            // Log do erro (em produção, usar um sistema de logging adequado)
            error_log("Partial não encontrado: " . $filePath);

            // Exibe mensagem amigável apenas em ambiente de desenvolvimento
            if (ini_get('display_errors')) {
                echo "<!-- Section '$sectionName' temporariamente indisponível -->";
            }
        }
    }

} catch (Throwable $e) {
    // Captura qualquer exceção não tratada
    error_log("Erro ao carregar página: " . $e->getMessage());

    // Mensagem genérica para o usuário
    if (ini_get('display_errors')) {
        echo "<div class='error-message'>Ocorreu um erro ao carregar a página. Por favor, tente novamente.</div>";
    }
}

$content = ob_get_clean();

// Layout principal
$layoutPath = __DIR__ . "/../../Shared/Views/layout_public.php";
if (file_exists($layoutPath)) {
    include $layoutPath;
} else {
    die("Layout principal não encontrado.");
}
?>