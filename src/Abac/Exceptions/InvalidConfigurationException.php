<?php

namespace Abac\Exceptions;

/**
 * Class InvalidConfigurationException
 */
class InvalidConfigurationException extends \InvalidArgumentException
{
    /**
     * @param string   $message
     * @param int|null $code
     */
    public function __construct($message, $code = 500)
    {
        parent::__construct($message, $code);
    }
}
