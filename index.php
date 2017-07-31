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

$audio = new \Tests\Abac\Data\Object\Audio([
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

//$pattern = '/^(\w+\.)+/';
//$replacement = '';
$string = 'some.audio.create';
//$string = 'audio.create';

$matches = explode('.', $string);

//echo preg_match_all($pattern, $string, $matches);
dump($matches);


//$abac->checkAccess('audio.create', $user, $audio);

//var_dump($audio->getTitle());