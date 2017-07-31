<?php

namespace Abac\Verification;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\ConfigurableTrait;
use Abac\Exceptions\AttributeVerificationException;
use Abac\Exceptions\ForbiddenException;
use Abac\Exceptions\InvalidConfigurationException;

/**
 * Class AccessChecker
 */
class AccessChecker implements AccessCheckerInterface
{
    use ConfigurableTrait;

    protected $user;

    protected $resource;

    protected $userRuleName = 'user';

    protected $fieldDelimiter = '.';

    protected $assertions;

    protected $useGetter = true;

    protected $getterPrefix = 'get';

    protected $exceptions = [];

    /**
     * {@inheritdoc}
     */
    public function check($ruleItems)
    {
        $errors = [];
        foreach ($ruleItems as $item) {
            $result = $this->verifyRuleItem($item);
            if (true === $result) {
                return true;
            } else {
                $errors[] = $result;
            }
        }

        throw new ForbiddenException(json_encode($errors));
    }

    /**
     * {@inheritdoc}
     */
    public function checkSafely($ruleItems)
    {
        try {
            $this->check($ruleItems);
        } catch (ForbiddenException $e) {
            return $e->getMessage();
        }

        return true;
    }

    /**
     * @param array $item
     *
     * @return bool|array
     */
    protected function verifyRuleItem($item)
    {
        $count = count($item);
        $okCount = 0;
        $errors = [];

        foreach ($item as $attribute => $assertion) {
            try {
                $okCount += (int)$this->verifyAttribute($attribute, $assertion);
            } catch (AttributeVerificationException $e) {
                $errors[] = $e->getMessage();
            }
        }

        if ($okCount === $count) {
            return true;
        }

//        return false;
        return $errors;
    }

    /**
     * @param string $attributeAlias
     * @param array  $assertion
     * @throws \Exception
     *
     * @return bool
     */
    protected function verifyAttribute($attributeAlias, $assertion)
    {
        $assertionClass = $this->getAssertionClass($assertion['assertion_type']);
        $assertionMethod = $this->getAssertionMethod($assertionClass, $assertion['assertion']);

        $params = [
            $this->retrieveUserOrResourceValue($attributeAlias),
        ];

        //expected value goes as 2nd argument
        if (isset($assertion['value'])) {
            $params[] = $assertion['value'];
        }

        try {
            return call_user_func_array([$assertionClass, $assertionMethod], $params);
        } catch (\Exception $e) {
            throw new AttributeVerificationException($e->getMessage());
        }
    }

    /**
     * @param string $attributeAlias
     *
     * @return mixed
     */
    protected function retrieveUserOrResourceValue($attributeAlias)
    {
        //user prefix with delimiter
        $userRuleName = $this->userRuleName . $this->fieldDelimiter;

        if (0 === strpos($attributeAlias, $userRuleName)) {
            //evaluate User.*
            $targetObject = $this->user;
        } else {
            $targetObject = $this->resource;
        }

        return $this->retrieveValue($targetObject, str_replace($userRuleName, '', $attributeAlias));
    }

    /**
     * @param object $object
     * @param string $fieldName
     *
     * @return mixed
     */
    protected function retrieveValue($object, $fieldName)
    {
        if ($this->useGetter) {
            $getter = $this->getterPrefix . ucfirst($fieldName);

            return $object->$getter();
        }

        return $object->$fieldName;
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
