<?php

require(__DIR__ . '/vendor/autoload.php');

/**
 * @var \Abac\Abac $abac
 */
$abac = \Abac\Abac::create([
    'policiesProvider' => [
        'path' => __DIR__ . '/tests/Data/Json/Policies',
    ],
    'attributesProvider' => [
        'path' => __DIR__ . '/tests/Data/Json/Attributes/attributes.json',
    ],
//    'accessChecker' => [
//        'test' => 'testing...',
//    ],
]);

//$abac->_test();

$audio = new \Tests\Abac\Data\Resource\Audio([
    'title' => 'Cold as Perfection',
    'artist' => 'Fleshgod Apocalypse',
    'length' => 199,
    'album' => 'King',
    'genre' => 'Symfonic Death Metal',
]);

$user = new \Tests\Abac\Data\User\User([
    'email' => 'despected@gmail.com',
    'roles' => [
        'store-administrator',
        'content-manager',
        'pr-manager',
    ],
    'location' => 'Kharkiv',
    'isRoot' => false,
    'isActive' => true,
]);


//$res = $abac->checkAccessSafely('audio.create1', $user, $audio);
$res = $abac->checkAccessSafely('audio.create', $user, null);
dump($res); die;

//var_dump($audio->getTitle());