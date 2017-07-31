<?php

namespace Abac\Exceptions;

/**
 * Class ForbiddenException
 */
class ForbiddenException extends \InvalidArgumentException
{
    private $errors = [];

    /**
     * @param array    $errors
     * @param int|null $code
     */
    public function __construct($errors, $code = 403)
    {
        $this->errors = $errors;
        parent::__construct(json_encode($errors), $code);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
