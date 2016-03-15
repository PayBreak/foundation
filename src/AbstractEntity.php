<?php
/*
 * This file is part of the PayBreak\Foundation package.
 *
 * (c) PayBreak <dev@paybreak.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace PayBreak\Foundation;

use PayBreak\Foundation\Contracts\Arrayable;
use PayBreak\Foundation\Contracts\Entity;
use PayBreak\Foundation\Contracts\Jsonable;
use PayBreak\Foundation\Contracts\Makeable;
use PayBreak\Foundation\Exceptions\InvalidArgumentException;
use PayBreak\Foundation\Helpers\NameHelper;

/**
 * Abstract Entity
 *
 * To define limited getters and setters, set names of available properties in $this->properties array (snake_case).
 * Also documenting available properties getters and setters using @ method is strongly recommended.
 *
 * @package PayBreak\Foundation
 */
abstract class AbstractEntity implements Entity, Makeable, Jsonable
{
    use EntityPropertyTrait;

    const TYPE_ARRAY = 1;
    const TYPE_BOOL = 2;
    const TYPE_INT = 4;
    const TYPE_STRING = 8;
    const TYPE_FLOAT = 16;
    const TYPE_OBJECT = 32;

    private $data = [];

    protected $properties = [];

    /**
     * Make Entity
     *
     * @author WN
     * @param array $components
     * @return static
     */
    public static function make(array $components)
    {
        $entity = new static();

        foreach ($components as $k => $v) {

            if ($entity->isPropertyAllowed($k)) {

                $entity->{'set' . NameHelper::snakeToCamel($k)}($v);
            }
        }

        return $entity;
    }

    /**
     * @author WN
     * @param string $name
     * @param array $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        $action = substr($name, 0, 3);
        $property = NameHelper::camelToSnake(substr($name, 3));

        if ($this->isPropertyAllowed($property)) {

            switch ($action) {
                case 'set':
                    return $this->set($property, $arguments);
                case 'get':
                    return $this->get($property);
                case 'add':
                    return $this->add($property, $arguments);
            }
        }

        throw new \RuntimeException('Call to undefined method '.__CLASS__.'::'.$name.'()');
    }

    /**
     * To Array
     *
     * @author WN
     * @param bool $recursively If set to `true` then toArray(true) will be called on each `Arrayable` property
     * @return array
     */
    public function toArray($recursively = false)
    {
        return $this->genArray($this->data, $recursively);
    }

    /**
     * @author WN
     * @param array $data
     * @param bool $recursively
     * @return array
     */
    private function genArray(array $data, $recursively)
    {
        $rtn = [];

        foreach ($data as $k => $v) {

            if ($recursively) {

                if ($v instanceof Arrayable) {
                    $rtn[$k] = $v->toArray(true);
                    continue;
                }

                if (is_array($v)) {
                    $rtn[$k] = $this->genArray($v, $recursively);
                    continue;
                }
            }

            $rtn[$k] = $v;
        }

        return $rtn;
    }

    /**
     * @author WN
     * @param string $property
     * @return bool
     */
    private function isPropertyAllowed($property)
    {
        return (
            count($this->properties) == 0 ||
            in_array($property, $this->properties) ||
            array_key_exists($property, $this->properties)
        );
    }

    /**
     * @author WN
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * JSON representation of an object
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(true), $options);
    }

    /**
     * @author WN
     * @param string $property
     * @param array $arguments
     * @return $this
     */
    private function set($property, array $arguments)
    {
        $this->checkArguments($arguments, $property);

        if ($arguments[0] === null) {

            $this->data[$property] = null;
            return $this;
        }

        $this->data[$property] = $this->processInputValue($arguments[0], $property);

        return $this;
    }

    /**
     * @author WN
     * @param string $property
     * @param array $arguments
     * @return $this
     * @throws Exception
     */
    private function add($property, array $arguments)
    {
        $this->checkArguments($arguments, $property);

        if (!array_key_exists($property, $this->properties) ||
            !($this->isArrayOfObjects($this->properties[$property]) || $this->properties[$property] == self::TYPE_ARRAY)
        ) {
            throw new Exception('Can not use addProperty on non object array property');
        }

        if ($arguments[0] === null) {

            return $this;
        }

        if ($this->isArrayOfObjects($this->properties[$property])) {
            $this->addArrayField(
                $this->data[$property],
                $this->processObjectType($arguments[0], str_replace('[]', '', $this->properties[$property])),
                $arguments
            );
            return $this;
        }

        $this->addArrayField($this->data[$property], $arguments[0], $arguments);
        return $this;
    }

    /**
     * @author WN
     * @param string $property
     * @return mixed|null
     */
    private function get($property)
    {
        if (array_key_exists($property, $this->data)) {

            return $this->data[$property];
        }

        if (array_key_exists($property, $this->properties) && $this->isArray($this->properties[$property])) {
            return [];
        }

        return null;
    }

    /**
     * @author WN
     * @param mixed $value
     * @param string|int $property
     * @return mixed
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function processInputValue($value, $property)
    {
        if (array_key_exists($property, $this->properties)) {
            $type = $this->properties[$property];
            if ($this->isInternalType($type)) {

                return $this->processInternalType($value, $type);
            }

            if ($this->isArrayOfObjects($type) && is_array($value)) {

                return $this->processArrayOfObj($value, $type);
            }

            return $this->processObjectType($value, $type);
        }

        return $value;
    }

    /**
     * @author WN
     * @param $type
     * @return bool
     */
    private function isInternalType($type)
    {
        return is_numeric($type) && array_key_exists($type, $this->propertyInternalTypes());
    }

    /**
     * @author WN
     * @param mixed $value
     * @param int $type
     * @return int|float|bool|string|array
     * @throws InvalidArgumentException
     */
    private function processInternalType($value, $type)
    {
        if ($this->validateInternalType($value, $type)) {

            return $value;
        }

        throw new InvalidArgumentException(
            'Expected value to be type of [' . $this->propertyInternalTypes()[$type] .
            '] type [' . $this->checkType($value) . '] was given'
        );
    }

    /**
     * @author WN
     * @param $value
     * @param $type
     * @return bool|null
     */
    private function validateInternalType($value, $type)
    {
        switch ($type) {
            case self::TYPE_ARRAY:
                return is_array($value);
            case self::TYPE_INT:
                return is_int($value);
            case self::TYPE_STRING:
                return is_string($value);
            case self::TYPE_BOOL:
                return is_bool($value);
            case self::TYPE_FLOAT:
                return is_float($value);
        }
    }

    /**
     * @author WN
     * @return array
     */
    private function propertyInternalTypes()
    {
        return [
            self::TYPE_ARRAY => 'array',
            self::TYPE_INT => 'int',
            self::TYPE_STRING => 'string',
            self::TYPE_BOOL => 'bool',
            self::TYPE_FLOAT => 'float',
        ];
    }
}
