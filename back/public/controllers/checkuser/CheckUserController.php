<?php

use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../../core/checkuser/checkUser_core.php';
class CheckUserController{
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function checkUser($request, $response, array $args) {
        $risposta = checkUser();
        $response->getBody()->write(json_encode($risposta));
        $response = $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
}