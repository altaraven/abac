<?php

namespace Abac\Assertions;

use Assert\Assertion;

/**
 * Class ComparisonAssertion
 */
class ComparisonAssertion
{
    /**
     * Check that a value equals another (==)
     *
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
     * Check that a value does not equal another (!=)
     *
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
     * Check that a value is identical to another (===)
     *
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function same($value, $expected)
    {
        return Assertion::same($value, $expected);
    }

    /**
     * Check that a value is not identical to another (!==)
     *
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function notSame($value, $expected)
    {
        return Assertion::notSame($value, $expected);
    }

    /**
     * Check that a value is true
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function true($value)
    {
        return Assertion::true($value);
    }

    /**
     * Check that a value is false
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function false($value)
    {
        return Assertion::false($value);
    }

    /**
     * Check that a value is null
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function null($value)
    {
        return Assertion::null($value);
    }

    /**
     * Check that a value is not null
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function notNull($value)
    {
        return Assertion::notNull($value);
    }

    /**
     * Check that a value is empty
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function noContent($value)
    {
        return Assertion::noContent($value);
    }

    /**
     * Check that a value is not empty
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function notEmpty($value)
    {
        return Assertion::notEmpty($value);
    }

    /**
     * Check that a value is greater than another
     *
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function greaterThan($value, $expected)
    {
        return Assertion::greaterThan($value, $expected);
    }

    /**
     * Check that a value is greater than or equal to another
     *
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function greaterOrEqualThan($value, $expected)
    {
        return Assertion::greaterOrEqualThan($value, $expected);
    }

    /**
     * Check that a value is less than another
     *
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function lessThan($value, $expected)
    {
        return Assertion::lessThan($value, $expected);
    }

    /**
     * Check that a value is less than or equal to another
     *
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function lessOrEqualThan($value, $expected)
    {
        return Assertion::lessOrEqualThan($value, $expected);
    }

    /**
     * Check that a value is within a range
     *
     * @param mixed $value
     * @param mixed $expected
     *
     * @return bool
     */
    public static function range($value, $expected)
    {
        return Assertion::range($value, $expected[0], $expected[1]);
    }
}
