<?php

namespace Abac\Providers;

use Abac\Base\ConfigurableTrait;
use Abac\Base\PoliciesProviderInterface;

class JsonFilePoliciesProvider implements PoliciesProviderInterface
{
    use ConfigurableTrait;

    public function __construct()
    {

    }

    /**
     * @param string $name
     */
    public function one($name)
    {

    }

    public function all()
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