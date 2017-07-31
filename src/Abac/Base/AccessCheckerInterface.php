<?php

namespace Abac\Base;

/**
 * Interface AccessCheckerInterface
 */
interface AccessCheckerInterface
{
    /**
     * @param string $ruleName
     * @param array $ruleItems
     *
     * @return bool
     */
    public function check($ruleName, $ruleItems);

    /**
     * Shortcut for check() method that will not throw exceptions
     *
     * @param string $ruleName
     * @param array $ruleItems
     *
     * @return bool|string
     */
    public function checkSafely($ruleName, $ruleItems);

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
