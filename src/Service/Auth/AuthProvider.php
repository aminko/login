<?php

namespace Demo\Service\Auth;

use Demo\Service\AbstractProvider;
use \Delight\Auth\Auth;

class AuthProvider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'auth';
    

    public function init()
    {
        if($this->container->get('db') === null) {
            throw new \Exception('Service provider requires access to database connection.');
        }
        
        $auth = new Auth($this->container->get('db')->getConnection());
        $this->container->set($this->serviceName, $auth);

    }
}