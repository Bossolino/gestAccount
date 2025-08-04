<?php

use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../../core/login/login_core.php';
class LoginController{
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function login($request, $response, array $args) {
        $parsedBody = $request->getParsedBody();
        $email = $parsedBody['EMAIL'];
        $password = $parsedBody['PASSWORD'];
        $db = new MysqliDb('127.0.0.1', 'root', '', 'esercizio');
        $utente = login($db, $email, $password);
        $response->getBody()->write(json_encode($utente));
        $response = $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
}