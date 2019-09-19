<?php

namespace Demo\Base;

use Demo\Base\Container;

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
        $this->router->add('home', '/', 'HomeController@index');
        print_r($this->container);
    }
}