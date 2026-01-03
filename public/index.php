<?php
// Configuração de erro
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Inicialização do sistema
require_once __DIR__ . "/../app/Core/Config.php";
require_once __DIR__ . "/../app/Core/Router.php";

// Autoloader
spl_autoload_register(function ($className) {
    $appNamespace = "App\\";
    $baseDirectory = __DIR__ . "/../app/";

    if (strncmp($appNamespace, $className, strlen($appNamespace)) !== 0) {
        return;
    }

    $relativeClass = substr($className, strlen($appNamespace));
    $filePath = $baseDirectory . str_replace("\\", "/", $relativeClass) . ".php";

    if (file_exists($filePath)) {
        require $filePath;
    }
});

use App\Core\Router;

$router = new Router();

// Definição de rotas
defineRoutes($router);

// Executa o roteamento
$router->dispatch();

/**
 * Define todas as rotas do sistema
 */
function defineRoutes(Router $router)
{
    defineStaticRoutes($router);
    defineUserRoutes($router);
    defineAuthRoutes($router);
    defineDashboardRoutes($router);
    defineMediaRoutes($router);
    defineEventRoutes($router);
    definePublicationRoutes($router);
    defineSermonRoutes($router);
}

/**
 * Rotas estáticas (públicas)
 */
function defineStaticRoutes(Router $router)
{
    $router->get('/', 'Home\\Controllers\\HomeController@index');
    $router->get('/sobre-imgd', 'Static\\Controllers\\StaticController@imgd');
    $router->get('/declaracao-de-fe', 'Static\\Controllers\\StaticController@declaracaoFe');
    $router->get('/apostolo-jeque', 'Static\\Controllers\\StaticController@apostoloJeque');
    $router->get('/acao-social', 'Static\\Controllers\\StaticController@acaoSocial');
}

/**
 * Rotas de usuários (admin)
 */
function defineUserRoutes(Router $router)
{
    // Listagem e CRUD
    $router->get('/admin/usuarios', 'User\\Controllers\\UserController@index');
    $router->get('/admin/usuario/criar', 'User\\Controllers\\UserController@create');
    $router->post('/admin/usuario/criar', 'User\\Controllers\\UserController@create');
    $router->get('/admin/usuario/{id}', 'User\\Controllers\\UserController@profile');
    $router->get('/admin/usuario/{id}/editar', 'User\\Controllers\\UserController@edit');
    $router->post('/admin/usuario/{id}/editar', 'User\\Controllers\\UserController@edit');
    $router->get('/admin/usuario/{id}/deletar', 'User\\Controllers\\UserController@delete');

    // Status
    $router->get('/admin/usuario/{id}/mudar-status', 'User\\Controllers\\UserController@toggleStatus');
}

/**
 * Rotas de autenticação
 */
function defineAuthRoutes(Router $router)
{
    $router->get('/admin/login', 'Auth\\Controllers\\AuthController@login');
    $router->post('/admin/login', 'Auth\\Controllers\\AuthController@login');
    $router->get('/admin/logout', 'Auth\\Controllers\\AuthController@logout');
    $router->get('/admin/esqueci-senha', 'Auth\\Controllers\\AuthController@forgotPassword');
    $router->post('/admin/esqueci-senha', 'Auth\\Controllers\\AuthController@forgotPassword');
    $router->get('/admin/resetar-senha', 'Auth\\Controllers\\AuthController@resetPassword');
    $router->post('/admin/resetar-senha', 'Auth\\Controllers\\AuthController@resetPassword');
}

/**
 * Rotas do dashboard
 */
function defineDashboardRoutes(Router $router)
{
    $router->get('/admin', 'Dashboard\\Controllers\\DashboardController@index');
}

/**
 * Rotas de mídia
 */
function defineMediaRoutes(Router $router)
{
    $router->get('/admin/midia', 'Media\\Controllers\\MediaController@index');
    $router->post('/admin/midia/criar', 'Media\\Controllers\\MediaController@create');
    $router->get('/admin/midia/{id}/deletar', 'Media\\Controllers\\MediaController@delete');
}

/**
 * Rotas de eventos
 */
function defineEventRoutes(Router $router)
{
    // Admin
    $router->get('/admin/eventos', 'Event\\Controllers\\EventController@index');
    $router->get('/admin/evento/criar', 'Event\\Controllers\\EventController@create');
    $router->post('/admin/evento/criar', 'Event\\Controllers\\EventController@create');
    $router->get('/admin/evento/{id}', 'Event\\Controllers\\EventController@show');
    $router->get('/admin/evento/{id}/editar', 'Event\\Controllers\\EventController@edit');
    $router->post('/admin/evento/{id}/editar', 'Event\\Controllers\\EventController@edit');
    $router->get('/admin/evento/{id}/deletar', 'Event\\Controllers\\EventController@delete');

    // Público
    $router->get('/eventos', 'Event\\Controllers\\PublicEventController@index');
    $router->get('/evento/{slug}', 'Event\\Controllers\\PublicEventController@show');
}

/**
 * Rotas de publicações
 */
function definePublicationRoutes(Router $router)
{
    // Admin
    $router->get('/admin/publicacoes', 'Publication\\Controllers\\PublicationController@index');
    $router->get('/admin/publicacao/criar', 'Publication\\Controllers\\PublicationController@create');
    $router->post('/admin/publicacao/criar', 'Publication\\Controllers\\PublicationController@create');
    $router->get('/admin/publicacao/{id}', 'Publication\\Controllers\\PublicationController@show');
    $router->get('/admin/publicacao/{id}/editar', 'Publication\\Controllers\\PublicationController@edit');
    $router->post('/admin/publicacao/{id}/editar', 'Publication\\Controllers\\PublicationController@edit');
    $router->get('/admin/publicacao/{id}/deletar', 'Publication\\Controllers\\PublicationController@delete');

    // Público
    $router->get('/blog', 'Publication\\Controllers\\PublicPublicationController@index');
    $router->get('/blog/{slug}', 'Publication\\Controllers\\PublicPublicationController@show');
}

/**
 * Rotas de sermões
 */
function defineSermonRoutes(Router $router)
{
    // Admin
    $router->get('/admin/sermoes', 'Sermon\\Controllers\\SermonController@index');
    $router->get('/admin/sermao/criar', 'Sermon\\Controllers\\SermonController@create');
    $router->post('/admin/sermao/criar', 'Sermon\\Controllers\\SermonController@create');
    $router->get('/admin/sermao/{id}', 'Sermon\\Controllers\\SermonController@show');
    $router->get('/admin/sermao/{id}/editar', 'Sermon\\Controllers\\SermonController@edit');
    $router->post('/admin/sermao/{id}/editar', 'Sermon\\Controllers\\SermonController@edit');
    $router->get('/admin/sermao/{id}/deletar', 'Sermon\\Controllers\\SermonController@delete');

    // Público
    $router->get('/sermoes', 'Sermon\\Controllers\\PublicSermonController@index');
    $router->get('/sermao/{slug}', 'Sermon\\Controllers\\PublicSermonController@show');
}