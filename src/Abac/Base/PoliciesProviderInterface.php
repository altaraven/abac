<?php

namespace Abac\Base;
/**
 * Interface PoliciesProviderInterface
 */
interface PoliciesProviderInterface
{
    public function one($name);

    public function all();
}