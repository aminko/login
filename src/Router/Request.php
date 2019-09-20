<?php

namespace Demo\Router;

class Request
{
    public function isPost()
    {
       return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' ? true : false;
    }

    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        
        if ($position = strpos($path, '?')) {
            $path = substr($path, 0, $position); 
        }
        
        return $path;
    }

}