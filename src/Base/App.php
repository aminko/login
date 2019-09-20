<?php

namespace Demo\Base;

use Demo\Base\Container;
use Demo\Router\Request;
use Demo\Router\RouterDispatcher;

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
        try{
            require_once __DIR__ . '/../Router/Routes.php';
           
            $routerDispatch = $this->router->dispatch(Request::getMethod(), Request::getPath());
    
            if($routerDispatch === null) {
                $routerDispatch = new RouterDispatcher('ErrorController@notFound');
            }
            //print_r($routerDispatch);
            list($controller, $method) = explode('@', $routerDispatch->getController(), 2);
            $controller = "\\Demo\\Controller\\" . $controller;
            //var_dump($controller, $method);
            call_user_func_array([new $controller($this->container), $method], $routerDispatch->getParameters());
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}