<?php

use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../../core/view/view_core.php';//sostituire il percorso
class ViewController{
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getUsers($request, $response, array $args) {
        $db = new MysqliDb('127.0.0.1', 'root', '', 'esercizio');
        $results = getUsers($db);
        // echo var_dump($results);
        $response->getBody()->write(json_encode($results));
        $response = $response->withHeader('Content-Type', 'application/json');
        return $response;
    }
}