<?php

namespace Demo\Service\View;

use Demo\Service\AbstractProvider;
use Demo\Base\View;

class ViewProvider extends AbstractProvider
{
    public $serviceName = 'view';

    public function init()
    {
        $view = new View();

        $this->container->set($this->serviceName, $view);
    }
}