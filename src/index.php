<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('charset', 'UTF-8');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

// Define as rotas
$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', function () {
        echo "<h1 style='font-family: arial, Helvetica,sans-serif;'>API DE ROBÔS</h1>";
    });

    $r->addRoute('GET', '/welcome', 'welcome');
});

// Função chamada pela rota /welcome
function welcome() {
    echo "<h1>Welcome to the PHP application!\n</h1>";
}

// Captura a URI e o método HTTP
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Remove query strings da URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Faz o dispatch
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func_array($handler, $vars);
        break;
}
