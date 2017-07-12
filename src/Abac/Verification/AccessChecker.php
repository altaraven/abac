<?php

namespace Abac\Verification;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\ConfigurableTrait;

/**
 * Class AccessChecker
 */
class AccessChecker implements AccessCheckerInterface
{
    //    use ConfigurableTrait;

    protected $user;

    protected $resource;

    /**
     * {@inheritdoc}
     */
    public function check($ruleItems)
    {
        foreach ($ruleItems as $item) {
            if (true === $this->verifyRuleItem($item)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $item
     *
     * @return bool
     */
    public function verifyRuleItem($item)
    {
        $count = count($item);
        $okCount = 0;

        foreach ($item as $attribute) {
            $okCount += (int) $this->verifyAttribute($attribute);
        }

        if ($okCount === $count) {
            return true;
        }

        return false;
    }

    /**
     * @param array $attribute
     *
     * @return bool
     */
    public function verifyAttribute($attribute)
    {
        $comparison = $this->getComparison($attribute['comparison_type']);



        return $comparison->compare();
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function getComparison($name)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }
}
