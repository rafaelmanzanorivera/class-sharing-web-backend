<?php

use Project\Users\UsersController;
use Project\Teachers\TeachersController;
use Project\Students\StudentsController;
use Slim\Http\Request;
use Slim\Http\Response;
$authentication = $app->getContainer()->get("authentication");
// Routes
$app->get('/users', UsersController::class . ':getAll');
$app->get('/users/{id}', UsersController::class . ':getUserById');
$app->post('/user', UsersController::class . ':createUser');
$app->put('/user/{id}', UsersController::class . ':updateUser');//->add($authentication);
$app->delete('/users/{id}', UsersController::class . ':deleteUser')->add($authentication);
$app->post('/user/login', UsersController::class . ':loginUser');



$app->get('/teachers', TeachersController::class . ':getAll');
$app->get('/teachers/{id}', TeachersController::class . ':getUserById');
$app->post('/teacher', TeachersController::class . ':createUser');
$app->put('/teacher/{id}', TeachersController::class . ':updateUser');
$app->delete('/teachers/{id}', TeachersController::class . ':deleteUser');


$app->get('/students', StudentsController::class . ':getAll');
$app->get('/students/{id}', StudentsController::class . ':getUserById');
$app->post('/student', StudentsController::class . ':createUser');
$app->put('/student/{id}', StudentsController::class . ':updateUser');
$app->delete('/students/{id}', StudentsController::class . ':deleteUser');



$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

