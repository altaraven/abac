<?php

require(__DIR__ . '/vendor/autoload.php');

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
dump($abac);