<?php

require(__DIR__ . '/vendor/autoload.php');

/**
 * @var \Abac\Abac $abac
 */
$abac = \Abac\Abac::create([
    'policiesProvider' => [
        'path' => __DIR__ . '/tests/Json/Policies',
    ],
    'attributesProvider' => [
        'path' => __DIR__ . '/tests/Json/Attributes/attributes.json',
    ],
    'accessChecker' => [
        'test' => 'testing...',
    ],
]);
//dump($abac);
$abac->_test();