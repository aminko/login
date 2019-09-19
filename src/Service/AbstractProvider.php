<?php

namespace Demo\Service;

use Demo\Base\Container; 

abstract class AbstractProvider 
{
    protected $container;
    
    /**
     * AbstractProvider constructor
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract function init();
}