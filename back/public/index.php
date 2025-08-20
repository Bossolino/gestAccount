<?php

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;


ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ .'/controllers/view/ViewController.php';
require __DIR__ .'/controllers/update/UpdateController.php';
require __DIR__ .'/controllers/create/CreateController.php';
require __DIR__ .'/controllers/delete/DeleteController.php';
require __DIR__ .'/controllers/login/LoginController.php';
require __DIR__ .'/controllers/checkuser/CheckUserController.php';
require __DIR__ .'/controllers/logout/LogoutController.php';



$container = new Container();
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

$app->options('/{routes:.+}', function ($request, $response,Array $args) {
    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    return $response
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    return $response
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->get('/', function ($request, $response,Array $args) {
    $response->getBody()->write('*_*');
    return $response;
});

$app->post('/View', \ViewController::class . ':getUsers' );

$app->post('/Update', \UpdateController::class . ':updateUser' );

$app->post('/Create', \CreateController::class . ':createUser' );

$app->post('/Delete', \DeleteController::class . ':deleteUser' );

$app->post('/Login', \LoginController::class . ':login' );

$app->post('/CheckUser', \CheckUserController::class . ':CheckUser' );

$app->post('/Logout', \LogoutController::class . ':logout' );

$app->addErrorMiddleware(true, true, true);

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response, $args) {
    throw new HttpNotFoundException($request);
});

$app->run();

?>