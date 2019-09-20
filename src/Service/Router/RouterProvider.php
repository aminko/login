<?php

namespace Demo\Service\Router;

use Demo\Service\AbstractProvider;
use Demo\Router\Router;

class RouterProvider extends AbstractProvider
{
    public $serviceName = 'router';

    public function init()
    {
        $router = new Router(APP_HOST_URL);

        $this->container->set($this->serviceName, $router);
    }
}