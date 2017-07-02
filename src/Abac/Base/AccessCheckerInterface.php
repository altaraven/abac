<?php

namespace Abac\Base;
/**
 * Interface AttributesProviderInterface
 */
interface AccessCheckerInterface
{
    public function check($rule, $user, $resource = null);
}