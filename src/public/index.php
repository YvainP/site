<?php

require_once('../../vendor/autoload.php');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use website\controller\ControllerUser;

session_start();
$settings = require_once "../configuration/settings.php";
$container = new \Slim\Container($settings);

//database connection with Eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal('session', $_SESSION);
$capsule->bootEloquent();

$app = new \Slim\App($container);
$app->get('/', function (Request $request, Response $response){
	    return $this->view->render($response, 'accueil.html.twig');
})->setName('home');

$app->get('/login', ControllerUser::class.':pageLogin')->setName('pageLogin');

$app->post('/login', ControllerUser::class.':login')->setName('login');

$app->get('/registration', ControllerUser::class.':pageRegister')->setName('pageRegister');

$app->post('/registration', ControllerUser::class.':register')->setName('register');

$app->run();

