<?php

namespace Abac\Providers;

use Abac\Base\AttributesProviderInterface;
use Abac\Base\ConfigurableTrait;
use Abac\Base\Helper;

/**
 * Class JsonFileAttributesProvider
 * @package Abac\Providers
 */
class JsonFileAttributesProvider implements AttributesProviderInterface
{
    use ConfigurableTrait;
    /**
     * @var string
     */
    protected $path;

    /**
     * @return array
     */
    public function release()
    {
        return Helper::jsonFileToArray($this->path);
    }
}