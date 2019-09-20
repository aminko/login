<?php

namespace Demo\Base;

use Demo\Base\Container;

class Controller 
{
    protected $view;
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->view = $container->get('view');
    }
}