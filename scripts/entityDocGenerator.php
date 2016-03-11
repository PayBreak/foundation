<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use \PayBreak\Foundation\Decision\Risk;
use \PayBreak\Foundation\Helpers\NameHelper;

$names = [
    Risk::TYPE_ARRAY => 'array',
    Risk::TYPE_INT => 'int',
    Risk::TYPE_STRING => 'string',
    Risk::TYPE_BOOL => 'bool',
    Risk::TYPE_FLOAT => 'float',
];

$array = [
    'risk' => Risk::TYPE_FLOAT,
    'meta' => Risk::TYPE_ARRAY,
    'adviser_name' => Risk::TYPE_STRING,
    'adviser_code' => Risk::TYPE_STRING,
];

foreach ($array as $k => $v) {
    if (is_numeric($v)) {
        $v = $names[$v];
    }
    echo(' * @method $this set' . NameHelper::snakeToCamel($k) . '(' . $v . ' $' . NameHelper::snakeToCamel($k, true) . ')' . "\n");
    echo(' * @method ' . $v . '|null get' . NameHelper::snakeToCamel($k) . '()' . "\n");
}
