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
    $this->router->add('validate','/login/auth', 'AuthController@authenticate', 'POST');
    $this->router->add('register', '/register', 'RegistrationController@register');
    $this->router->add('registration', '/register/new', 'RegistrationController@registration', 'POST');
} 