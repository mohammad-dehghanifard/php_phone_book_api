<?php
use App\Routers\Router as Router;
use App\Middlewares\AuthMiddleware;
use App\Controllers\PhoneController;

// use Controllers
use App\Controllers\AuthController;


// ایجاد یک نمونه از میدلور
$authMiddleware = new AuthMiddleware();
$request = (object) [
    "headers" => $_SERVER['HTTP_TOKEN'] ?? null,
    "query"   => $_GET['token'] ?? null,
    "body"    => getPostDataInput()->token ?? null
];

//$response = $authMiddleware->handle($request);
//
//if(!$response) exit();

$router = new Router();

// Define routes
$router->post('v1','/login', AuthController::class, 'login');
$router->post('v1','/register', AuthController::class, 'register');
$router->post('v1','/verify', AuthController::class, 'verify');
$router->get('v1','/phones',PhoneController::class,'getAll');
$router->get('v1','/phones/{id}',PhoneController::class,'getPhoneById');
$router->post('v1','/phone',PhoneController::class,'createPhone');
$router->put('v1','/phone/{id}',PhoneController::class,'updatePhone');
$router->delete('v1','/phone/{id}',PhoneController::class,'deletePhone');