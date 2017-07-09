<?php

namespace Abac\Base;

/**
 * Class ConfigurableObject
 * @package Abac\Base
 */
class ConfigurableObject
{
    /**
     * ConfigurableObject constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (!empty($config)) {
            foreach ($config as $name => $value) {
                $this->$name = $value;
            }
        }
    }
}