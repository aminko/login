<?php

namespace Demo\Service\Database;

use Demo\Service\AbstractProvider;
use Demo\Database\Connection;

class DatabaseProvider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'db';
    

    public function init()
    {
        $db = new Connection();

        $this->container->set($this->serviceName, $db);

    }
}