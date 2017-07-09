<?php
namespace Abac\Verification;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\ConfigurableObject;

class AccessChecker extends ConfigurableObject implements AccessCheckerInterface
{
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