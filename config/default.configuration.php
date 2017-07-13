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
        'assertions' => [
            'comparison' => '\Abac\Assertions\ComparisonAssertion',
        ]
    ],

//    'policiesPathAlias' => app_path('Services') . '/abac/config/policies/',
//    'configPaths' => [
//        app_path('Services') . '/abac/config/attributes.json',
//        app_path('Services') . '/abac/config/policies/business-unit.json',
//        app_path('Services') . '/abac/config/policies/campaign.json',
//        app_path('Services') . '/abac/config/policies/dashboard.json',
//        app_path('Services') . '/abac/config/policies/policy.json',
//    ],
//    'comparisons' => app_path('Services') . '/abac/config/comparisons.json',
//    'attributeManager' => [
//        'class' => '\App\Services\abac\src\manager\AttributeManager',
//        'attributes' => [],
//        'getter_prefix' => 'get',
//        'getter_name_transformation_function' => 'ucfirst',
//    ],
//    'policyRuleManager' => [
//        'class' => '\App\Services\abac\src\manager\PolicyRuleManager',
//    ],
//    'cacheManager' => [
//        'class' => '\App\Services\abac\src\manager\CacheManager',
//        'options' => [],
//    ],
//    'comparisonManager' => [
//        'class' => '\App\Services\abac\src\manager\ComparisonManager',
//        'comparisons' => [
//            'array' => '\App\Services\abac\src\comparison\ArrayComparison',
//            'boolean' => '\App\Services\abac\src\comparison\BooleanComparison',
//            'datetime' => '\App\Services\abac\src\comparison\DatetimeComparison',
//            'numeric' => '\App\Services\abac\src\comparison\NumericComparison',
//            'object' => '\App\Services\abac\src\comparison\ObjectComparison',
//            'user' => '\App\Services\abac\src\comparison\UserComparison',
//            'string' => '\App\Services\abac\src\comparison\StringComparison',
//        ],
//        'sqlBuilders' => [
//            'user' => '\App\Services\abac\src\sqlBuilder\UserBuilder',
//        ],
//    ],
];