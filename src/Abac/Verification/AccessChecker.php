<?php

namespace Abac\Verification;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\ConfigurableTrait;

class AccessChecker implements AccessCheckerInterface
{
    use ConfigurableTrait;

    /**
     * @param $rule
     * @param $user
     * @param null $resource
     * @return bool
     */
    public function check($rule, $user, $resource = null)
    {

        return true;
    }
}