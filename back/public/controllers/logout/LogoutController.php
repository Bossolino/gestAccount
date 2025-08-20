<?php

use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../../core/logout/logout_core.php';
class LogoutController{
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function logout($request, $response, array $args) {
        $risposta = logout();
        $response->getBody()->write(json_encode($risposta));
        $response = $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
}