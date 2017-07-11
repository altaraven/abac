<?php

namespace Abac\Verification;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\ConfigurableTrait;

/**
 * Class AccessChecker
 */
class AccessChecker implements AccessCheckerInterface
{
    use ConfigurableTrait;

    protected $test;

    /**
     * @param array       $ruleItems
     * @param object      $user
     * @param object|null $resource
     *
     * @return bool
     */
    public function check($ruleItems, $user, $resource = null)
    {
        foreach ($ruleItems as $item) {
            foreach ($item['attributes'] as $attribute) {
                
            }
        }
//        return true;
    }
}
