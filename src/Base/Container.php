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
        if($this->has($name)) {
            return $this->container[$name];
        }
    }

    public function has($name)
    {
        return isset($this->container[$name]);
    }
}