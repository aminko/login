<?php

namespace Demo\Service\Router;

use Demo\Service\AbstractProvider;
use Demo\Router\Router;

class RouterProvider extends AbstractProvider
{
    public $serviceName = 'router';

    public function init()
    {
        //FIXME: replace with config
        $router = new Router('http://127.0.0.1/public/');

        $this->container->set($this->serviceName, $router);
    }
}