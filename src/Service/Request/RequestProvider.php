<?php

namespace Demo\Service\Request;

use Demo\Service\AbstractProvider;
use Demo\Router\Request;

class RequestProvider extends AbstractProvider
{
    public $serviceName = 'request';

    public function init()
    {
        $request = new Request();

        $this->container->set($this->serviceName, $request);
    }
}