<?php

namespace Abac\Base;

/**
 * Interface AccessCheckerInterface
 */
interface AccessCheckerInterface
{
    /**
     * @param array $ruleItems
     *
     * @return bool
     */
    public function check($ruleItems);

    /**
     * @param $user
     * @return $this
     */
    public function setUser($user);

    /**
     * @param $resource
     * @return $this
     */
    public function setResource($resource);
}
