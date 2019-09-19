<?php

namespace Demo\Base;

use Demo\Base\Container;

class App {

    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run()
    {
        
    }
}