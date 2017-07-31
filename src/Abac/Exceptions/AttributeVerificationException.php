<?php

namespace Abac\Exceptions;

/**
 * Class AttributeVerificationException
 */
class AttributeVerificationException extends \InvalidArgumentException
{
    /**
     * @param string   $message
     * @param int|null $code
     */
    public function __construct($message, $code = 422)
    {
        parent::__construct($message, $code);
    }
}
