<?php

return [
    'policiesProvider' => [
        'class' => '\Abac\Providers\JsonDirectoryPoliciesProvider',
        'path' => 'lalal_1',
    ],
    'attributesProvider' => [
        'class' => '\Abac\Providers\JsonFileAttributesProvider',
        'path' => 'lalal_2',
    ],
    'accessChecker' => [
        'class' => '\Abac\Verification\AccessChecker',
        'userRuleName' => 'user',
        'assertions' => [
            'comparison' => '\Abac\Assertions\ComparisonAssertion',
            'array' => '\Abac\Assertions\ArrayAssertion',
        ]
    ],
];