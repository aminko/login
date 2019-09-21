<?php

namespace Demo\Service\Config;

use Demo\Service\AbstractProvider;
use Demo\Base\Config;

class ConfigProvider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'config';
    

    public function init()
    {
        $config['app'] = Config::file('app');
        $config['database'] = Config::file('database');

        $this->container->set($this->serviceName, $config);

    }
}