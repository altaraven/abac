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
     * Shortcut for check() method that will not throw exceptions
     *
     * @param array $ruleItems
     *
     * @return bool|string
     */
    public function checkSafely($ruleItems);

    /**
     * @param $user
     *
     * @return $this
     */
    public function setUser($user);

    /**
     * @param $resource
     *
     * @return $this
     */
    public function setResource($resource);
}
