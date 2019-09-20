<?php

namespace Demo\Router;

class Router 
{
    private $routes;
    private $host;
    private $dispacher;

    public function __construct($host)
    {
        $this->routes = [];
        $this->host = $host;
    }

    public function add($key, $pattern, $controller, $method = 'GET')
    {
        $this->routes[$key] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function dispatch($method, $path)
    {
        return $this->getDispatcher()->dispatch($method, $path);
    }

    /**
     * Return dispatcher with registered routes
     *
     * @return UriDispatcher
     */
    public function getDispatcher()
    {
        if($this->dispacher == null)
        {
            $this->dispacher = new UriDispatcher();
            
            foreach($this->routes as $route)
            {
                // put new registered route to route list 
                $this->dispacher->register($route['method'], $route['pattern'], $route['controller']);
            }
        }

        return $this->dispacher;
    }
}