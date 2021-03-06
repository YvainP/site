<?php

use Slim\Http\Environment;
use Slim\Http\Uri;

use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use website\controller\fctAuth;
use website\controller\Functions;

return [
    'view' => function ($c) {
	    $view = new Twig('../views', [
		    'debug' => true
	    ]);

            // Instantiate and add Slim specific extension
            $router = $c->get('router');
            $uri = Uri::createFromEnvironment(new Environment($_SERVER));
            $view->addExtension(new TwigExtension($router, $uri));

            //fonctions à rendre disponible dans les templates twig
            $view->getEnvironment()->addFunction(new \Twig\TwigFunction("isConnected", fctAuth::class."::isConnected"));                                      $view->getEnvironment()->addFunction(new \Twig\TwigFunction("currentRoute", Functions::class."::currentRoute"));                                                 


            return $view;
    },
   'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'testDB',
            'username' => 'Kalalah',
            'password' => 'Shiku',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]
    ],
];
