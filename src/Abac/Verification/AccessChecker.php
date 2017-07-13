<?php

namespace Abac\Verification;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\ConfigurableTrait;
use Abac\Exceptions\InvalidConfigurationException;

/**
 * Class AccessChecker
 */
class AccessChecker implements AccessCheckerInterface
{
    use ConfigurableTrait;

    protected $user;

    protected $resource;

    protected $assertions;

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

        foreach ($item as $attribute => $assertion) {
            $okCount += (int) $this->verifyAttribute($attribute, $assertion);
        }

        if ($okCount === $count) {
            return true;
        }

        return false;
    }

    /**
     * @param string $attributeAlias
     * @param array  $assertion
     *
     * @return bool
     */
    public function verifyAttribute($attributeAlias, $assertion)
    {
        $assertionClass = $this->getAssertionClass($assertion['assertion_type']);
        $assertionMethod = $this->getAssertionMethod($assertionClass, $assertion['assertion']);

        //TODO: receive attribute value from User
        //TODO: receive attribute value from Resource
        $params = [
            $this->retrieveUserOrResourceValue($attributeAlias),
        ];

        //expected value goes as 2nd argument
        if (isset($assertion['value'])) {
            $params[] = $assertion['value'];
        }

        return call_user_func_array([$assertionClass, $assertionMethod], $params);
    }

    /**
     * @param string $attributeAlias
     *
     * @return mixed
     */
    public function retrieveUserOrResourceValue($attributeAlias)
    {
        //TODO: implement
        return '';
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    protected function getAssertionClass($name)
    {
        if (!isset($this->assertions[$name])) {
            $message = \sprintf(
                'Assertion type "%s" is not assigned to any assertion php class.',
                $name
            );

            throw new InvalidConfigurationException($message);
        }

        if (!class_exists($this->assertions[$name])) {
            $message = \sprintf(
                'Assertion class "%s" does not exist.',
                $this->assertions[$name]
            );

            throw new InvalidConfigurationException($message);
        }

        return $this->assertions[$name];
    }

    /**
     * @param string $className
     * @param string $name
     *
     * @return bool
     */
    protected function getAssertionMethod($className, $name)
    {
        if (!method_exists($className, $name)) {
            $message = \sprintf(
                'Assertion class "%s" does not have method "%s" .',
                $className,
                $name
            );

            throw new InvalidConfigurationException($message);
        }

        return $name;
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
