<?php

namespace Project\Users;
use Project\Utils\SQLProyectDao;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;

class UsersController
{
    private $dao;
    private $secret = 'nano';
    private $proyectDao;

    public function __construct(ContainerInterface $container)
    {
        $proyectDAO = new \Project\Utils\SQLProjectDao($container['db']);
        $this->dao = new UsersDao($proyectDAO);
    }

    function getAll(Request $request, Response $response, array $args)
    {
        $users = $this->dao->getAll();
        return $response->withJson($users);
    }

    function getUserById(Request $request, Response $response, array $args)
    {

        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');
        $users = $this->dao->getUserById($id);

        return $response->withJson($users);
    }

    function createUser(Request $request, Response $response, array $args)
    {
        $body = $request->getParsedBody();
        $body['token'] = $this->getToken($body['id_user']);
        $newUserId = $this->dao->createUser($body);

        return $response->withJson($newUserId);
    }

    function updateUser(Request $request, Response $response, array $args)
    {
        $body = $request->getParsedBody();
        $updatedUserId = $this->dao->updateUser($body['id_user'],$body);
        return $response->withJson($updatedUserId);
    }

    function deleteUser(Request $request, Response $response, array $args)
    {
        $route = $request->getAttribute('route');
        $updatedUserId = $this->dao->deleteUser($route->getArgument('id'));
        return $response->withStatus(204);
    }


    function loginUser(Request $request, Response $response, array $args)
    {
        $body = $request->getParsedBody();
        $res = $this->dao->loginUser($body);
        if($res == null)
            return $response->withStatus(401);
        else
            return $response->withJson($res);


    }

    private function getToken($userId)
    {
        $now = new \DateTime();
        $future = new \DateTime('now +1 hour');
        $payload = [
            'iat' => $now->getTimestamp(),
            'exp' => $future->getTimestamp(),
            "jti" => base64_encode(random_bytes(16)),
            'id' => $userId
        ];
        $token = JWT::encode($payload,$this->secret,"HS256");
        return $token;

    }

}