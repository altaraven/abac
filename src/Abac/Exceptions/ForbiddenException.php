<?php

namespace Abac\Exceptions;

/**
 * Class ForbiddenException
 */
class ForbiddenException extends \InvalidArgumentException
{
    /**
     * @param string   $message
     * @param int|null $code
     * //TODO make it pass an array of errors here as 1st argument
     */
    public function __construct($message, $code = 403)
    {
        parent::__construct($message, $code);
    }
}
