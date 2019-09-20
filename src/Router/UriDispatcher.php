<?php

namespace Demo\Router;

use Demo\Router\RouterDispatcher;

class UriDispatcher
{
    /**
     * @var array
     */
    private $methods;

    /**
     * @var array
     */
    private $routes;

    /**
     * @var array
     */
    private $patterns;

    public function __construct()
    {
        $this->methods = [
            'GET',
            'POST'
        ]; //TODO: DELETE?

        $this->routes = [
            'GET' => [],
            'POST' => []
        ];

        $this->patterns = [
            'int' => '[0-9]+'
        ];
    }

    public function addPattern($key, $pattern)
    {
        $this->patterns[$key] = $pattern;
    }


    public function dispatch($method, $path)
    {
        $routes = $this->routes(strtoupper($method));
        
        if(array_key_exists($path, $routes)) {
            return new RouterDispatcher($routes[$path]);
        }
        
        // when route is not registered
        return $this->checkRoute($method, $path);
    }

    public function register($method, $pattern, $controller)
    {
        $this->routes[strtoupper($method)][$pattern] = $controller;
    }

    private function routes($method)
    {
        return isset($this->routes[$method]) ? $this->routes[$method] : [];
    }

    private function checkRoute($method, $path)
    {
        foreach($this->routes($method) as $route => $controller) {
           $pattern = '#^' . $route . '$#s';
           if(preg_match($pattern, $path, $match)) {
               return new RouterDispatcher($controller,  $match);
           }
            
        }
    }
}