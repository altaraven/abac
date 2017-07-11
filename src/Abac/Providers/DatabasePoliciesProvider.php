<?php

namespace Abac\Providers;

use Abac\Base\ConfigurableTrait;
use Abac\Base\PoliciesProviderInterface;

/**
 * Class DatabasePoliciesProvider
 * @package Abac\Providers
 */
class DatabasePoliciesProvider implements PoliciesProviderInterface
{
    use ConfigurableTrait;

    public function one($name)
    {

    }

    public function all()
    {

    }
}