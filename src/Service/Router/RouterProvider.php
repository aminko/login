<?php

namespace Demo\Service\Router;

use Demo\Service\AbstractProvider;
use Demo\Router\Router;
use Demo\Base\Config;

class RouterProvider extends AbstractProvider
{
    public $serviceName = 'router';

    public function init()
    {
        $config = Config::file('app');
        $router = new Router($config['base_url']);

        $this->container->set($this->serviceName, $router);
    }
}