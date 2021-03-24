<?php

require_once('../../vendor/autoload.php');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;





$settings = require_once "../configuration/settings.php";
$container = new \Slim\Container($settings);

//database connection with Eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new \Slim\App($container);

$app->get('/', function (Request $request, Response $response){
	    return $this->view->render($response, 'accueil.html.twig');
})->setName('home');

$app->get('/login', function (Request $request, Response $response){
	    return $this->view->render($response, 'login.html.twig');
})->setName('login');

$app->run();

