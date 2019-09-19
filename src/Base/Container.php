<?php

namespace Demo\Base;

class Container {

    private $container;

   /**
    * Set dependency to container
    *
    * @param string $name
    * @param object $value
    * @return this
    */
    public function set($serviceName, $value)
    {
        $this->container[$serviceName] = $value;
        
        return $this;
    }

    /**
     * Gets dependency from container if it exists
     * Otherwise returns null   
     *
     * @param string $name
     * @return (object | null)
     */
    public function get($serviceName) 
    {
        return $this->has($serviceName);
    }

    /**
     * Check if dependency with given name exists in container
     *
     * @param string $name
     * @return (object | null)
     */
    public function has($serviceName)
    {
        return isset($this->container[$serviceName]) ? $this->container[$serviceName] : null;
    }
}