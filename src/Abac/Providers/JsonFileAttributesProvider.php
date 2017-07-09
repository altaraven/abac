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
}