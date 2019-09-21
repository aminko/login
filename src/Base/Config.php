<?php

namespace Demo\Base;

use Exception;

class Config 
{
    public static function item($key, $group = 'app')
    {
        $items = self::file($group);

        return isset($items[$key]) ? $items[$key] : null;
    }

    /**
     * Set configuration from config file
     *
     * @param string $group
     * @return array $config
     */
    public static function file($group)
    {
        $path = __DIR__ . '/../Config/' . mb_strtolower($group) . '.php';

        if(file_exists($path)) {
            $config = require_once $path;

            if(is_array($config)) {
                return $config;
            } else {
                throw new Exception(sprintf('Oops. Configuration file %s must return an array', $group));
            }

        } else {
            throw new Exception(sprintf('Can\'t load configuration file %s.php', $group));
        }


    }
}