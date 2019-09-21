<?php

namespace Demo\Base;

use Demo\Base\Container;

class Controller 
{
    protected $view;
    protected $container;
    protected $config;
    protected $request;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->view = $container->get('view');
        $this->config = $container->get('config');
        $this->request = $container->get('request');
    }
}