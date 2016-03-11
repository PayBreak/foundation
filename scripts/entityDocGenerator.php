<?php
/*
 * php entityDocGenerator.php  --class="\PayBreak\Foundation\Decision\Risk"
 */

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use \PayBreak\Foundation\AbstractEntity;
use \PayBreak\Foundation\Helpers\NameHelper;

$names = [
    AbstractEntity::TYPE_ARRAY => 'array',
    AbstractEntity::TYPE_INT => 'int',
    AbstractEntity::TYPE_STRING => 'string',
    AbstractEntity::TYPE_BOOL => 'bool',
    AbstractEntity::TYPE_FLOAT => 'float',
];

if (count($argv) !== 2) {
    echo 'Argument not supplied!' . "\n"; die();
}

if (strpos($argv[1], '--class=') !== false) {
    $class = (string) str_replace('--class=', '', $argv[1]);

    if (!class_exists($class)) {
        echo "Class doesn't exist \n"; die();
    }

    $ref = new ReflectionClass(\PayBreak\Foundation\Decision\Risk::class);
    $property = $ref->getProperty('properties');
    $property->setAccessible(true);
    $array = $property->getValue(new $class());
} else {
    $array = [];
}


foreach ($array as $k => $v) {
    if (is_numeric($v)) {
        $v = $names[$v];
    }
    echo(' * @method $this set' . NameHelper::snakeToCamel($k) . '(' . $v . ' $' . NameHelper::snakeToCamel($k, true) . ')' . "\n");
    echo(' * @method ' . $v . '|null get' . NameHelper::snakeToCamel($k) . '()' . "\n");
}
