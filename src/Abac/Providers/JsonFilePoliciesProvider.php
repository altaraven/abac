<?php

namespace Abac\Providers;

use Abac\Base\ConfigurableTrait;
use Abac\Base\Helper;
use Abac\Base\PoliciesProviderInterface;

/**
 * Class JsonFilePoliciesProvider
 */
class JsonFilePoliciesProvider implements PoliciesProviderInterface
{
    use ConfigurableTrait;
    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $name
     *
     * @return array
     */
    public function one($name)
    {
        return $this->all()[$name];
    }

    /**
     * @return array
     */
    public function all()
    {
        return Helper::jsonFileToArray($this->path);
    }
}
