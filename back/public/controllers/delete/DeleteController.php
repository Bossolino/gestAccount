<?php
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../../core/delete/delete_core.php';
class DeleteController{
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function deleteUser($request, $response, array $args) {
        $parsedBody = $request->getParsedBody();
        // if (!isset($parsedBody['ID'])) {
        //     $response->getBody()->write("ERROR missing parameters." . var_dump($parsedBody["ID"]));
        //     return $response->withStatus(400)->withHeader('Content-Type', 'text/plain');
        // }
        $ID = $parsedBody['ID'];
        $db = new MysqliDb('127.0.0.1', 'root', '', 'esercizio');
        $cancellato = deleteUser($db, $ID);
        $response->getBody()->write($cancellato);
        $response = $response->withHeader('Content-Type', 'text/html');
        return $response;
    }
}