<?php

namespace Abac\Providers;

use Abac\Base\AttributesProviderInterface;
use Abac\Base\ConfigurableTrait;

class JsonFileAttributesProvider implements AttributesProviderInterface
{
    use ConfigurableTrait;
    /**
     * @var string
     */
    protected $path;

    public function release()
    {

    }

    /**
     * @return array
     */
    protected function resolveFromPath()
    {
        $resourceLocation = 'file://' . realpath($this->path);
//        $schema = (object) ['$ref' => $resourceLocation];
        return ['$ref' => $resourceLocation];

//        return json_encode($schema);

    }
}