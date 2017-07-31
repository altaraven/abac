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
    const DEFAULT_CONFIG_PATH = '/../../../config/default.configuration.php';

    /**
     * @param array $config
     *
     * @return static
     */
    public static function init($config = [])
    {
        $merged = static::merge(static::loadDefaultConfig(), $config);

        foreach ($merged as $itemName => $config) {
            $merged[$itemName] = static::instantiate($config);
        }

        return new static($merged);
    }

    /**
     * Shortcut for parent method
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return parent::offsetGet($key);
    }

    /**
     * Shortcut for parent method
     *
     * @param string $key
     * @param string $value
     */
    public function set($key, $value)
    {
        parent::offsetSet($key, $value);
    }

    /**
     * @param array       $reference
     * @param null|string $className
     *
     * @return bool
     */
    protected static function instantiate($reference, $className = null)
    {
        if (is_array($reference)) {
            $class = isset($reference['class']) ? $reference['class'] : $className;
            unset($reference['class']);

            //TODO: use class_exists to check
            return new $class($reference);
        }

        return false;
    }

    /**
     * @return array
     */
    protected static function loadDefaultConfig()
    {
        return require __DIR__ . static::DEFAULT_CONFIG_PATH;
    }

    /**
     * @param array $a array to be merged to
     * @param array $b array to be merged from. You can specify additional arrays via third argument,
     *                 fourth argument etc.
     *
     * @return array the merged array (the original arrays are not changed.)
     */
    protected static function merge($a, $b)
    {
        $args = func_get_args();
        $res = array_shift($args);
        while (!empty($args)) {
            $next = array_shift($args);
            foreach ($next as $k => $v) {
                if (is_int($k)) {
                    if (isset($res[$k])) {
                        $res[] = $v;
                    } else {
                        $res[$k] = $v;
                    }
                } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                    $res[$k] = self::merge($res[$k], $v);
                } else {
                    $res[$k] = $v;
                }
            }
        }

        return $res;
    }
}
