<?php

namespace Abac\Assertions;

use Abac\Exceptions\InvalidArgumentException;
use Assert\Assertion;

/**
 * Class ArrayAssertion
 */
class ArrayAssertion
{
    /**
     * Check that value is in array of choices.
     *
     * @param mixed $value
     * @param array $expected
     *
     * @return bool
     */
    public static function in($value, $expected)
    {
        return Assertion::inArray($value, $expected);
    }

    /**
     * Check that value is not in array of choices.
     *
     * @param mixed $value
     * @param array $expected
     *
     * @return bool
     */
    public static function notIn($value, $expected)
    {
        return Assertion::notInArray($value, $expected);
    }

    /**
     * Check that array1 has intersection with array2.
     *
     * @param array $array1
     * @param array $array2
     *
     * @return bool
     */
    public static function intersect($array1, $array2)
    {
        if (count(array_intersect($array1, $array2)) === 0) {
            $message = sprintf('Array "%s" has no intersection with "%s".',
                json_encode($array1),
                json_encode($array2)
            );
            throw new InvalidArgumentException($message);
        }

        return true;
    }

    /**
     * Check that array1 has no intersection with array2.
     *
     * @param array $array1
     * @param array $array2
     *
     * @return bool
     */
    public static function doNotIntersect($array1, $array2)
    {
        if (count(array_intersect($array1, $array2)) > 0) {
            $message = sprintf('Array "%s" has intersection with "%s".',
                json_encode($array1),
                json_encode($array2)
            );
            throw new InvalidArgumentException($message);
        }

        return true;
    }
}
