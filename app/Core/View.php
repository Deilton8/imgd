<?php
namespace App\Core;

class View
{
    private const MODULES_BASE_PATH = "/../Modules/";

    /**
     * Renderiza uma view com os dados fornecidos
     */
    public static function render($view, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . self::MODULES_BASE_PATH . $view . ".php";

        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            self::handleMissingView($view);
        }
    }

    /**
     * Lida com view não encontrada
     */
    private static function handleMissingView($view)
    {
        echo "View {$view} não encontrada.";
    }
}