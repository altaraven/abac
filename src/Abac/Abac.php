<?php

namespace Abac;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\AttributesProviderInterface;
use Abac\Base\ConfigurableTrait;
use Abac\Base\PoliciesProviderInterface;
use Abac\Configuration\Configuration;
use Abac\Configuration\ConfigurationInterface;
use Abac\Providers\JsonDirectoryPoliciesProvider;
use Abac\Providers\JsonFileAttributesProvider;
use Abac\Verification\AccessChecker;

class Abac
{
    use ConfigurableTrait;
    /**
     * @var PoliciesProviderInterface
     */
    protected $policiesProvider;

    /**
     * @var AttributesProviderInterface
     */
    protected $attributesProvider;

    /**
     * @var AccessCheckerInterface
     */
    protected $accessChecker;
    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * @param array $config
     * @return static
     */
    public static function create($config = [])
    {
        $merged = array_merge(static::loadDefaultConfig(), $config);

        $configuredObjects = [];
        foreach ($merged as $item => $config) {
            $configuredObjects[] = static::instantiate($config);
            $setter = 'set' . ucfirst($item);
            //setters VS static functions
        }

        return new static($configuredObjects);
    }

    /**
     * @param array $reference
     * @param null|string $className
     * @return bool
     */
    public static function instantiate($reference, $className = null)
    {
        if (is_array($reference)) {
            $class = isset($reference['class']) ? $reference['class'] : $className;
            unset($reference['class']);
            //class_uses
            return new $class($reference);
        }

        return false;
    }

    /**
     * @return array
     */
    protected static function loadDefaultConfig()
    {
        return require(__DIR__ . '/../../config/default.configuration.php');
    }

    /**
     * @param string $ruleName
     * @param object $user
     * @param object|null $resource
     *
     * @return bool
     */
    public function checkAccess($ruleName, $user, $resource = null/*, $options = []*/)
    {
        $rule = $this->policiesProvider->one($ruleName);

        return $this->accessChecker->check($rule, $user, $resource);
    }

    /**
     * @param PoliciesProviderInterface $policiesProvider
     *
     * @return $this
     */
    public function setPoliciesProvider(PoliciesProviderInterface $policiesProvider)
    {
        $this->policiesProvider = $policiesProvider;

        return $this;
    }

    /**
     * @param AttributesProviderInterface $attributesProvider
     *
     * @return $this
     */
    public function setAttributesProvider(AttributesProviderInterface $attributesProvider)
    {
        $this->attributesProvider = $attributesProvider;

        return $this;
    }

    /**
     * @param AccessCheckerInterface $accessChecker
     *
     * @return $this
     */
    public function setAccessChecker(AccessCheckerInterface $accessChecker)
    {
        $this->accessChecker = $accessChecker;

        return $this;
    }
}