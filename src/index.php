<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('charset', 'UTF-8');
error_reporting(E_ALL);

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../model/robot.php";
require_once "../conn/conn.php";

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
        
        $pdo = (new Conn())->getConnection();
        $query = "SELECT * FROM robots";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $robots = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$robots) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Nenhum robô encontrado.'
        ]);
        return;
        }

        $robotObjects = [];
        foreach ($robots as $robot) {
            $robotObjects[] = new Robot(
                $robot['id'],
                $robot['name'],
                $robot['model'],
                $robot['year'],
                $robot['color'],
                $robot['serial_number']
            );
        }
    
        $robotData = [];
    
        foreach ($robotObjects as $robot) {
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
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'status' => 'success',
            'message' => 'Lista de todos os robôs.',
            'data' => $robotData
        ]);
    });
    
    $r->addRoute('POST', '/robots/create', function () {
        header('Content-Type: application/json; charset=UTF-8');
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['name'], $data['model'], $data['year'], $data['color'], $data['serialNumber'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados incompletos para criar o robô.']);
            return;
        }

        $robot = new Robot(
            null, // ID será gerado pelo banco de dados
            $data['name'],
            $data['model'],
            $data['year'],
            $data['color'],
            $data['serialNumber']
        );

        $pdo = (new Conn())->getConnection();
        $query = "INSERT INTO robots (name, model, year, color, serial_number) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([
            $robot->getName(),
            $robot->getModel(),
            $robot->getYear(),
            $robot->getColor(),
            $robot->getSerialNumber()
        ])) {
            http_response_code(201);
            echo json_encode(['status' => 'success', 'message' => 'Robô criado com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Erro ao criar o robô.']);
        }
    });

    $r->addRoute('GET', '/robots/{id:\d+}', function ($id) {
        header('Content-Type: application/json; charset=UTF-8');
        
        $pdo = (new Conn())->getConnection();
        $query = "SELECT * FROM robots WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $robot = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$robot) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Robô não encontrado.']);
            return;
        }

        $robotObject = new Robot(
            $robot['id'],
            $robot['name'],
            $robot['model'],
            $robot['year'],
            $robot['color'],
            $robot['serial_number']
        );

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'status' => 'success',
            'message' => 'Detalhes do robô.',
            'data' => [
                'id' => $robotObject->getId(),
                'name' => $robotObject->getName(),
                'model' => $robotObject->getModel(),
                'year' => $robotObject->getYear(),
                'color' => $robotObject->getColor(),
                'serialNumber' => $robotObject->getSerialNumber(),
                'isOn' => $robotObject->isOn(),
                'batteryLevel' => $robotObject->getBatteryLevel()
            ]
        ]);
    });

    $r->addRoute('PUT', '/robots/{id:\d+}', function ($id) {
        header('Content-Type: application/json; charset=UTF-8');
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['name'], $data['model'], $data['year'], $data['color'], $data['serialNumber'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados incompletos para atualizar o robô.']);
            return;
        }

        $robot = new Robot(
            $id,
            $data['name'],
            $data['model'],
            $data['year'],
            $data['color'],
            $data['serialNumber']
        );

        $pdo = (new Conn())->getConnection();
        $query = "UPDATE robots SET name = ?, model = ?, year = ?, color = ?, serial_number = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([
            $robot->getName(),
            $robot->getModel(),
            $robot->getYear(),
            $robot->getColor(),
            $robot->getSerialNumber(),
            $robot->getId()
        ])) {
            echo json_encode(['status' => 'success', 'message' => 'Robô atualizado com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o robô.']);
        }
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