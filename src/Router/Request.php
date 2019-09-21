<?php

namespace Demo\Router;

class Request
{

    public $request = [];
    public $get = [];
    public $post = [];
    public $cookie = [];
    public $server = [];


    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->get = $_GET;
        $this->post = $_POST;
        $this->cookie = $_COOKIE;
        $this->server = $_SERVER;    
    }

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