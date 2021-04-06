<?php
namespace website\controller;

abstract class Controller{
    protected $view;
    public function __construct(\Slim\Container $container) {
        $this->view = $container->view;
    }
    protected function render($response, $template, $args = []) {
        return $this->view->render($response, $template, $args);
    }
}
