<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('charset', 'UTF-8');
error_reporting(E_ALL);

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../model/robot.php";

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use App\Robot\Robot;

// Define as rotas
$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', function () {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'status' => 'success',
            'message' => 'Bem-vindo à API de Robôs!',
            'description' => 'Esta API permite gerenciar robôs de forma simples e eficiente.',
            'routes' => [
                [
                    'method' => 'GET',
                    'path' => '/all-robots',
                    'description' => 'Mostra todos os robôs.'
                ],
                [
                    'method' => 'POST',
                    'path' => '/robots/create',
                    'description' => 'Cria um novo robô.'
                ],
                [
                    'method' => 'GET',
                    'path' => '/robots/{id}',
                    'description' => 'Obtém detalhes de um robô específico.'
                ],
                [
                    'method' => 'PUT',
                    'path' => '/robots/{id}',
                    'description' => 'Atualiza um robô existente.'
                ],
                [
                    'method' => 'DELETE',
                    'path' => '/robots/{id}',
                    'description' => 'Remove um robô.'
                ]
                ]
        ]);
    });

    $r->addRoute('GET', '/all-robots', function () {
        header('Content-Type: application/json; charset=UTF-8');
    
        $robots = [
            new Robot(1, "Robo1", "ModelX", 2023, "Red", "SN123456"), 
            new Robot(2, "Robo2", "ModelY", 2024, "Blue", "SN654321"),
            new Robot(3, "Robo3", "ModelZ", 2022, "Green", "SN789012"),
            new Robot(4, "Robo4", "ModelA", 2021, "Yellow", "SN345678"),
            new Robot(5, "Robo5", "ModelB", 2020, "Black", "SN901234"),
            new Robot(6, "Robo6", "ModelC", 2019, "White", "SN567890"),
            new Robot(7, "Robo7", "ModelD", 2018, "Silver", "SN123789"),
            new Robot(8, "Robo8", "ModelE", 2017, "Gold", "SN456123"),
            new Robot(9, "Robo9", "ModelF", 2016, "Purple", "SN789456")
            
        ];
    
        $robotData = [];
    
        foreach ($robots as $robot) {
            $robotData[] = [
                'id' => $robot->getId(),
                'name' => $robot->getName(),
                'model' => $robot->getModel(),
                'year' => $robot->getYear(),
                'color' => $robot->getColor(),
                'serialNumber' => $robot->getSerialNumber(),
                'isOn' => $robot->isOn(),
                'batteryLevel' => $robot->getBatteryLevel()
            ];
        }
    
        echo json_encode([
            'status' => 'success',
            'message' => 'Lista de todos os robôs.',
            'data' => $robotData
        ]);
    });
       
});

// Captura a URI e o método HTTP
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Remove query strings da URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

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