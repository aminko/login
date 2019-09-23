<?php

// Register routes here
//$this->router->add(key, path, action);

$auth = $this->container->get('auth');

if($auth->isLoggedIn()) {
    $this->router->add('home', '/', 'HomeController@index');
    
    
    // Profile
    $this->router->add('profile', '/profile', 'ProfileController@show');
    $this->router->add('profile/edit', '/profile/edit', 'ProfileController@edit');
    $this->router->add('profile/save', '/profile/save', 'ProfileController@save', 'POST');

    // Tasks
    $this->router->add('tasks', '/tasks', 'TaskController@index');
    $this->router->add('tasks/create', '/tasks/create', 'TaskController@create');
    $this->router->add('tasks/save', '/tasks/save', 'TaskController@save', 'POST');
    $this->router->add('task', '/task/{id:int}', 'TaskController@edit', 'POST');
    $this->router->add('task/done', '/task/{id:int}/done', 'TaskController@markAsDone', 'POST');
    $this->router->add('task/alert', '/task/{id:int}/alert', 'TaskController@markAsImportant', 'POST');
    $this->router->add('task/delete', '/task/{id:int}/delete', 'TaskController@delete', 'POST');

    // Logout
    $this->router->add('logout', '/auth/logout', 'AuthController@logout', 'POST');

} elseif(!$auth->isLoggedIn()) {
    //public routes
    $this->router->add('login', '/login', 'AuthController@login');
    $this->router->add('validate','/login/auth', 'AuthController@authenticate', 'POST');
    $this->router->add('register', '/register', 'RegistrationController@register');
    $this->router->add('registration', '/register/new', 'RegistrationController@registration', 'POST');
} 