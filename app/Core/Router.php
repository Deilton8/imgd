<?php
namespace App\Core;

class Router
{
    private $routes = [];

    /**
     * Adiciona uma rota
     */
    private function addRoute($method, $uri, $action)
    {
        $uri = rtrim($uri, "/");
        if ($uri === '') {
            $uri = '/';
        }
        $this->routes[$method][$uri] = $action;
    }

    /**
     * Obtém a URI atual, tratando subdiretórios
     */
    private function getCurrentUri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);

        // Remove o prefixo do script (caso esteja em subdiretório)
        if ($scriptName !== '/' && strpos($uri, $scriptName) === 0) {
            $uri = substr($uri, strlen($scriptName));
        }

        $uri = '/' . trim($uri, '/');
        return $uri === '//' ? '/' : $uri;
    }

    /**
     * Exibe página de erro
     */
    private function showError($code, $message = '', $data = [])
    {
        http_response_code($code);

        $errorView = __DIR__ . "/../Views/errors/{$code}.php";

        if (file_exists($errorView)) {
            extract($data);
            include $errorView;
        } else {
            // Fallback básico
            echo "<h1>Erro {$code}</h1>";
            echo "<p>{$message}</p>";
        }
        exit;
    }

    /**
     * Registra rota GET
     */
    public function get($uri, $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    /**
     * Registra rota POST
     */
    public function post($uri, $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    /**
     * Dispara a rota correta
     */
    public function dispatch()
    {
        $uri = $this->getCurrentUri();
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method])) {
            $this->showError(405, 'Método não permitido');
        }

        foreach ($this->routes[$method] as $route => $action) {
            // Converte {param} em regex
            $pattern = preg_replace("/\{[a-zA-Z_]+\}/", "([0-9a-zA-Z_-]+)", $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // remove a string completa da URI

                [$controller, $methodAction] = explode('@', $action);
                $controller = "App\\Modules\\" . $controller;

                if (!class_exists($controller)) {
                    $this->showError(500, "Controlador não encontrado: {$controller}");
                }

                $instance = new $controller();

                if (!method_exists($instance, $methodAction)) {
                    $this->showError(500, "Método não encontrado: {$methodAction} em {$controller}");
                }

                try {
                    return call_user_func_array([$instance, $methodAction], $matches);
                } catch (\Exception $e) {
                    $this->showError(500, 'Erro interno do servidor', [
                        'error' => $e->getMessage(),
                        'uri' => $uri
                    ]);
                }
            }
        }

        $this->showError(404, 'Página não encontrada', ['uri' => $uri]);
    }
}