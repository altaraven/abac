<?php

namespace Abac\Configuration;

/**
 * Class Configuration
 */
class Configuration extends \ArrayObject
{
    const POLICIES_PROVIDER = 'policiesProvider';
    const ATTRIBUTES_PROVIDER = 'attributesProvider';
    const ACCESS_CHECKER = 'accessChecker';
    const DEFAULT_CONFIG_PATH = '/../../config/default.configuration.php';

    /**
     * Shortcut for parent method
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * Shortcut for parent method
     *
     * @param string $key
     * @param string $value
     */
    public function set($key, $value)
    {
        $this->offsetSet($key, $value);
    }
}
