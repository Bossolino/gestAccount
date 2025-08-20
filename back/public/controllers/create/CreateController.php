<?php

use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../../core/create/create_core.php';
class CreateController{
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function createUser($request, $response, array $args) {
        $parsedBody = $request->getParsedBody();
        if (!isset($parsedBody['NOME']) && !isset($parsedBody['EMAIL']) && !isset($parsedBody['ETA'])) {
            return "ERROR missing parameters";
        }
        $NOME = $parsedBody['NOME'];
        $EMAIL = $parsedBody['EMAIL'];
        $ETA = $parsedBody['ETA'];
        $db = new MysqliDb('127.0.0.1', 'root', '', 'esercizio');
        $crea = createUser($db, $NOME, $EMAIL, $ETA);
        $response->getBody()->write(json_encode($crea));
        $response = $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
}