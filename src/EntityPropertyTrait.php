<?php

namespace PayBreak\Foundation;

use PayBreak\Foundation\Contracts\Makeable;
use PayBreak\Foundation\Exceptions\InvalidArgumentException;

/**
 * Entity Property Trait
 *
 * @author WN
 * @package PayBreak\Foundation
 */
trait EntityPropertyTrait
{
    /**
     * @author WN
     * @param array $arguments
     * @param string $property
     */
    private function checkArguments(array $arguments, $property)
    {
        if (count($arguments) == 0) {
            throw new \RuntimeException('Missing argument on method ' . __CLASS__ . '::set_' . $property . '() call');
        }
    }

    /**
     * @param mixed $value
     * @param string $class
     * @return object mixed
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function processObjectType($value, $class)
    {
        $this->classExists($class);

        if (is_array($value) && is_subclass_of($class, Makeable::class)) {

            return $class::make($value);
        }

        if (is_a($value, $class)) {

            return $value;
        }

        throw new InvalidArgumentException(
            'Expected value to be object of [' . $class . '] type ' . $this->checkType($value) . '] was given'
        );
    }

    /**
     * @author WN
     * @param string $class
     * @return bool
     * @throws Exception
     */
    private function classExists($class)
    {
        if (class_exists($class)) {
            return true;
        }
        throw new Exception('Non existing class');
    }

    /**
     * @author WN
     * @param mixed $value
     * @return string
     */
    private function checkType($value)
    {
        if (is_object($value)) {

            return get_class($value);
        }

        return gettype($value);
    }

    /**
     * @author WN
     * @param $type
     * @return bool
     */
    private function isArrayOfObjects($type)
    {
        return strpos($type, '[]') !== false;
    }

    /**
     * @author WN
     * @param $type
     * @return string
     */
    private function getClassNameFromType($type)
    {
        return (string) str_replace('[]', '', $type);
    }
}
