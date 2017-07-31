<?php

namespace Abac\Exceptions;

/**
 * Class AttributeVerificationException
 */
class AttributeVerificationException extends \InvalidArgumentException
{
    private $error = [];

    /**
     * @param string   $field
     * @param string   $error
     * @param int|null $code
     */
    public function __construct($field, $error, $code = 422)
    {
        $this->error = [$field => $error];
        parent::__construct(json_encode($this->error), $code);
    }

    /**
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }
}
