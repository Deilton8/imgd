<?php
namespace App\Core;

class Router
{
    private $routes = [];

    /**
     * Adiciona uma rota ao sistema
     */
    private function addRoute($method, $uri, $action)
    {
        $uri = $this->normalizeUri($uri);
        $this->routes[$method][$uri] = $action;
    }

    /**
     * Normaliza a URI removendo barras extras
     */
    private function normalizeUri($uri)
    {
        $uri = rtrim($uri, "/");
        return $uri === '' ? '/' : $uri;
    }

    /**
     * Obtém a URI atual, tratando subdiretórios
     */
    private function getCurrentUri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);

        if ($this->shouldRemoveScriptPrefix($scriptName, $uri)) {
            $uri = substr($uri, strlen($scriptName));
        }

        return $this->cleanUri($uri);
    }

    /**
     * Verifica se deve remover o prefixo do script
     */
    private function shouldRemoveScriptPrefix($scriptName, $uri)
    {
        return $scriptName !== '/' && strpos($uri, $scriptName) === 0;
    }

    /**
     * Limpa a URI final
     */
    private function cleanUri($uri)
    {
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
            $this->showBasicError($code, $message);
        }

        exit;
    }

    /**
     * Exibe erro básico como fallback
     */
    private function showBasicError($code, $message)
    {
        echo "<h1>Erro {$code}</h1>";
        echo "<p>{$message}</p>";
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
     * Processa a rota correspondente
     */
    public function dispatch()
    {
        $uri = $this->getCurrentUri();
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method])) {
            $this->showError(405, 'Método não permitido');
        }

        foreach ($this->routes[$method] as $route => $action) {
            if ($this->isMatchingRoute($route, $uri, $matches)) {
                $this->executeRoute($action, $matches, $uri);
                return;
            }
        }

        $this->showError(404, 'Página não encontrada', ['uri' => $uri]);
    }

    /**
     * Verifica se a rota corresponde à URI
     */
    private function isMatchingRoute($route, $uri, &$matches)
    {
        $pattern = $this->convertRouteToPattern($route);
        return preg_match($pattern, $uri, $matches);
    }

    /**
     * Converte rota com parâmetros para padrão regex
     */
    private function convertRouteToPattern($route)
    {
        $pattern = preg_replace("/\{[a-zA-Z_]+\}/", "([0-9a-zA-Z_-]+)", $route);
        return "#^" . $pattern . "$#";
    }

    /**
     * Executa a ação da rota
     */
    private function executeRoute($action, $params, $uri)
    {
        array_shift($params); // Remove a string completa da URI

        [$controllerName, $methodName] = explode('@', $action);
        $controllerClass = "App\\Modules\\" . $controllerName;

        $this->validateController($controllerClass);
        $this->validateMethod($controllerClass, $methodName);

        $controllerInstance = new $controllerClass();

        try {
            call_user_func_array([$controllerInstance, $methodName], $params);
        } catch (\Exception $e) {
            $this->showError(500, 'Erro interno do servidor', [
                'error' => $e->getMessage(),
                'uri' => $uri
            ]);
        }
    }

    /**
     * Valida se o controller existe
     */
    private function validateController($controllerClass)
    {
        if (!class_exists($controllerClass)) {
            $this->showError(500, "Controlador não encontrado: {$controllerClass}");
        }
    }

    /**
     * Valida se o método existe no controller
     */
    private function validateMethod($controllerClass, $methodName)
    {
        if (!method_exists($controllerClass, $methodName)) {
            $this->showError(500, "Método não encontrado: {$methodName} em {$controllerClass}");
        }
    }
}