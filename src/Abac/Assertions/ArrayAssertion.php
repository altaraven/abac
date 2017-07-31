<?php

namespace Abac\Assertions;

use Assert\Assertion;

/**
 * Class ArrayAssertion
 */
class ArrayAssertion
{
    /**
     * @param mixed $value
     * @param array $expected
     *
     * @return bool
     */
    public static function in($value, $expected)
    {
        return Assertion::choice($value, $expected);
    }

    /**
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
     * @param array $array1
     * @param array $array2
     *
     * @return bool
     */
    public static function intersect($array1, $array2)
    {
        return count(array_intersect($array1, $array2)) > 0;
    }

    /**
     * @param array $array1
     * @param array $array2
     *
     * @return bool
     */
    public static function doNotIntersect($array1, $array2)
    {
        return !static::intersect($array1, $array2);
    }

//    /**
//     * @param mixed $value
//     * @param mixed $expected
//     *
//     * @return bool
//     */
//    public function equal($value, $expected)
//    {
//        return ;
//    }
//
//    /**
//     * @param mixed $value
//     * @param mixed $expected
//     *
//     * @return bool
//     */
//    public function notEqual($value, $expected)
//    {
//        return ;
//    }
//
//    /**
//     * @param mixed $value
//     *
//     * @return bool
//     */
//    public function empty($value)
//    {
//        return ;
//    }
}
