<?php

namespace Abac;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\AttributesProviderInterface;
use Abac\Base\PoliciesProviderInterface;
use Abac\Configuration\Configuration;

class Abac
{
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

    const DEFAULT_CONFIG_PATH = '/../../config/default.configuration.php';

    /**
     * Abac constructor.
     *
     * @param PoliciesProviderInterface   $policiesProvider
     * @param AttributesProviderInterface $attributesProvider
     * @param AccessCheckerInterface      $accessChecker
     */
    public function __construct(
        PoliciesProviderInterface $policiesProvider,
        AttributesProviderInterface $attributesProvider,
        AccessCheckerInterface $accessChecker
    ) {
        $this->policiesProvider = $policiesProvider;
        $this->attributesProvider = $attributesProvider;
        $this->accessChecker = $accessChecker;
    }

    /**
     * @param string      $ruleName
     * @param object      $user
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
     * @param array $config
     * @param bool  $ignoreDefaultConfig
     *
     * @return object
     */
    public static function create($config = [], $ignoreDefaultConfig = false)
    {
        $merged = (true === $ignoreDefaultConfig) ? $config : array_merge(static::loadDefaultConfig(), $config);
        $objectsCollection = static::configureObjects($merged);

        return new static(
            $objectsCollection->get(Configuration::POLICIES_PROVIDER),
            $objectsCollection->get(Configuration::ATTRIBUTES_PROVIDER),
            $objectsCollection->get(Configuration::ACCESS_CHECKER)
        );
    }

    /**
     * @param array $merged
     *
     * @return Configuration
     */
    protected static function configureObjects($merged)
    {
        foreach ($merged as $itemName => $config) {
            $merged[$itemName] = static::instantiate($config);
        }

        return new Configuration($merged);
    }

    /**
     * @param array       $reference
     * @param null|string $className
     *
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
        return require __DIR__ . static::DEFAULT_CONFIG_PATH;
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
