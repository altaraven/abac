<?php

namespace Abac\Exceptions;

/**
 * Class AttributeReadException
 */
class AttributeReadException extends \InvalidArgumentException
{
    /**
     * @param string   $message
     * @param int|null $code
     */
    public function __construct($message, $code = 400)
    {
        parent::__construct($message, $code);
    }
}
