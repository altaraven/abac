<?php

namespace Abac\Providers;

use Abac\Base\AttributesProviderInterface;
use Abac\Base\ConfigurableObject;

class JsonFileAttributesProvider extends ConfigurableObject implements AttributesProviderInterface
{
    /**
     * @var string
     */
    protected $path;

    public function release()
    {

    }
}