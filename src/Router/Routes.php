<?php

// Register routes here
//$this->router->add(key, path, action);

$auth = $this->container->get('auth');

if($auth->isLoggedIn()) {
    $this->router->add('home', '/', 'HomeController@index');
    $this->router->add('task', '/task/{id:int}', 'TaskController@show');

} elseif(!$auth->isLoggedIn()) {
    //public routes
    $this->router->add('login', '/login', 'AuthController@login');
    $this->router->add('validate','/login/validate', 'AuthController@validate');
    $this->router->add('register', '/register', 'AuthController@register');
    $this->router->add('registration','/register/new', 'AuthController@registration');
} 