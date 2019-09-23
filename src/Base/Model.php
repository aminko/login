<?php

namespace Demo\Base;

use Demo\Base\Container;

abstract class Model
{
    protected $container;
    protected $connection;
    protected $config;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->connection = $container->get('db');
        $this->config = $container->get('config');

    }

}