<?php

use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../../core/update/update_core.php';
class UpdateController{
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function updateUser($request, $response, array $args) {
        $parsedBody = $request->getParsedBody();

        $id = $parsedBody['ID'];
        $nome = $parsedBody['NOME'];
        $email = $parsedBody['EMAIL'];
        $eta = $parsedBody['ETA'];
        $db = new MysqliDb('127.0.0.1', 'root', '', 'esercizio');
        $salva = updateUser($db, $id, $nome, $email, $eta);
        $response->getBody()->write(json_encode($salva));
        $response = $response->withHeader('Content-Type', 'text/html');
        return $response;
    }
}