<?php

namespace Demo\Base;

use Demo\Base\View;
use Demo\Base\Container;

class Controller 
{

    protected $view;
    protected $container;

    public function __construct(Container $container)
    {
        $this->view = new View();
        $this->container = $container;
    }
}