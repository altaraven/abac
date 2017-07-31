<?php

namespace Abac\Assertions;

use Assert\Assertion;

/**
 * Class ComparisonAssertion
 */
class ComparisonAssertion
{
    /**
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function equal($value, $expected)
    {
        return Assertion::eq($value, $expected);
    }

    /**
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function notEqual($value, $expected)
    {
        return Assertion::notEq($value, $expected);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public static function true($value)
    {
        return Assertion::true($value);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public static function false($value)
    {
        return Assertion::false($value);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public static function null($value)
    {
        return Assertion::null($value);
    }
}
