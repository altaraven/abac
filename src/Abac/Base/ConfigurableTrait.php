<?php

namespace Abac\Base;
/**
 * Trait ConfigurableTrait
 */
trait ConfigurableTrait
{
    /**
     * ConfigurableTrait constructor.
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