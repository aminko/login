<?php

namespace Demo\Base;

use Demo\Base\Container;
use Demo\Router\Request;

class App {

    private $container;
    private $router;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->router = $this->container->get('router');
    }

    public function run()
    {
        $this->router->add('home', '/', 'HomeController@index');
        $this->router->add('task', '/task/4', 'TaskController@show');
        //print_r(Request::getPath());
        $routerDispatch = $this->router->dispatch(Request::getMethod(), Request::getPath());
        //print_r($routerDispatch);
        list($controller, $method) = explode('@', $routerDispatch->getController(), 2);
        $controller = "\\Demo\\Controller\\" . $controller;
        //var_dump($controller, $method);
        call_user_func_array([new $controller($this->container), $method], $routerDispatch->getParameters());
    }
}