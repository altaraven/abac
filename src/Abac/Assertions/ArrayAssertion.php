<?php

namespace Abac\Assertions;

use Assert\Assertion;

/**
 * Class ArrayAssertion
 */
class ArrayAssertion
{
    /**
     * @param array $value
     * @param int|float|string $expected
     *
     * @return bool
     */
    public function in($value, $expected)
    {
        return Assertion::choice($expected, $value);
    }

    /**
     * @param array $value
     * @param int|float|string $expected
     *
     * @return bool
     */
    public function notIn($value, $expected)
    {
        return Assertion::notInArray($expected, $value);
    }

    /**
     * @param array $array1
     * @param array $array2
     *
     * @return bool
     */
    public function intersect($array1, $array2)
    {
        return count(array_intersect($array1, $array2)) > 0;
    }

    /**
     * @param array $array1
     * @param array $array2
     *
     * @return bool
     */
    public function doNotIntersect($array1, $array2)
    {
        return !$this->intersect($array1, $array2);
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
