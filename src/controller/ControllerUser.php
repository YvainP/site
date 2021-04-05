<?php
namespace website\controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use website\model\User;

class ControllerUser {
    protected $view;

    public function __construct(\Slim\Container $container){
        $this->view = $container->view;
    }

    protected function render($response, $template, $args = []) {
        return $this->view->render($response, $template, $args);
    }
    public function login(Request $request, Response $response,$args)
    {
        $document = User::all();
        return $this->view->render($response, 'login.html.twig', ['test' => $document]);
    }
    public function register(Request $request, Response $response,$args)
    {
        return $this->view->render($response, 'registration.html.twig');
    }

    public function checkRegister(Request $request, Response $response,$args)
    {
        $pseudo = Functions::getFilteredPost($request,'pseudo');
        return $this->view->render($response, 'registration.html.twig', ['pseudo' => $pseudo]);

    }
}
