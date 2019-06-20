<?php
/**
 * Created by PhpStorm.
 * User: rafaelmanzano
 * Date: 2019-03-29
 * Time: 17:16
 */

namespace Project\Teachers;

use Project\Utils\SQLProyectDao;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;


class TeachersController
{
    private $dao;

    private $proyectDao;

    public function __construct(ContainerInterface $container)
    {
        $proyectDAO = new \Project\Utils\SQLProjectDao($container['db']);
        $this->dao = new TeachersDao($proyectDAO);
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
        $newUserId = $this->dao->createUser($body);
        return $response->withJson($newUserId);
    }

    function updateUser(Request $request, Response $response, array $args)
    {
        $body = $request->getParsedBody();
        $updatedUser= $this->dao->updateUser($args['id'],$body);
        return $response->withJson($updatedUser);
    }


    function deleteUser(Request $request, Response $response, array $args)
    {
        $route = $request->getAttribute('route');
        $updatedUserId = $this->dao->deleteUser($route->getArgument('id'));
        return $response->withStatus(204);
    }

}