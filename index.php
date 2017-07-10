<?php

require(__DIR__ . '/vendor/autoload.php');

$abac = \Abac\Abac::create([
    'policiesProvider' => [
        'class' => '\Abac\Providers\JsonDirectoryPoliciesProvider',
        'path' => 'PPPPPPPPPP_______',
    ],
]);
var_dump($abac);