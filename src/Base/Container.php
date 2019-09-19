<?php

namespace Demo\Base;

class Container {

    private $container;

   
    public function set($name, $value)
    {
        $this->container[$name] = $value;
        
        return $this;
    }

    public function get($name) 
    {
        return $this->has($name);
    }

    public function has($name)
    {
        return isset($this->container[$name]) ? $this->container[$name] : null;
    }
}