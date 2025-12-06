<?php
namespace App\Core;

class Controller
{
    private const MODULES_BASE_PATH = "/../Modules";

    /**
     * Carrega uma view com os dados fornecidos
     */
    protected function view($path, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . self::MODULES_BASE_PATH . $path . ".php";

        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            throw new \Exception("View não encontrada: {$path}");
        }
    }

    /**
     * Instancia um modelo
     */
    protected function model($model)
    {
        $modelClass = "App\\Modules\\" . $model;

        if (class_exists($modelClass)) {
            return new $modelClass();
        }

        throw new \Exception("Model {$modelClass} não encontrado");
    }
}