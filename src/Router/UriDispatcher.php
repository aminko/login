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

        // \d+ is same as [0-9]+
        $this->patterns = [
            'int' => '\d+'
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
        $verifiedPattern = $this->verifyPattern($pattern);
        $this->routes[strtoupper($method)][$verifiedPattern] = $controller;
    }

    private function verifyPattern($pattern)
    {
        if(strpos($pattern, '{') === false) {
            return $pattern;
        }

        return preg_replace_callback('#\{(\w+):(\w+)\}#',
               function($matches){
                return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
               },
               $pattern);
    }

    private function routes($method)
    {
        return isset($this->routes[$method]) ? $this->routes[$method] : [];
    }

    private function checkRoute($method, $path)
    {
        foreach($this->routes($method) as $route => $controller) {
           $pattern = '#^' . $route . '$#s';

           if(preg_match($pattern, $path, $parameters)) {

               $parameters = $this->filterParameters($parameters);

               return new RouterDispatcher($controller, $parameters);
           }
            
        }
    }

    private function filterParameters($parameters)
    {
        foreach($parameters as $key => $parameter) {
            
            if(is_int($key)) {
                unset($parameters[$key]);
            }
        }

        return $parameters;
    }
}