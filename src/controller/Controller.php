<?php
namespace website\controller;
use Slim\Http\Request;
use Slim\Http\Response;
use website\model\User;

class Controller {
    protected $view;

    public function __construct(\Slim\Container $container){
        $this->view = $container->view;
    }

    protected function render($response, $template, $args = []) {
        return $this->view->render($response, $template, $args);
    }
    public function test(Request $request, Response $response,$args)
    {
        $document = User::all();
        return $this->view->render($response, 'login.html.twig', ['test' => $document]);

    }
}
