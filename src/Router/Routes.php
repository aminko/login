<?php

// Register routes here
//$this->router->add(key, path, action);
$this->router->add('home', '/', 'HomeController@index');
$this->router->add('task', '/task/{id:int}', 'TaskController@show');