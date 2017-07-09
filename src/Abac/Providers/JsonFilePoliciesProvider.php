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
}