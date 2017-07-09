<?php

namespace Abac\Providers;

use Abac\Base\ConfigurableTrait;
use Abac\Base\PoliciesProviderInterface;

class JsonDirectoryPoliciesProvider implements PoliciesProviderInterface
{
    use ConfigurableTrait;
    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $name
     * @return array
     */
    public function one($name)
    {
        return $this->all()[$name];
    }

    public function all()
    {
        return $this->resolveFromPath();
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