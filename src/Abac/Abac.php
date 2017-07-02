<?php

namespace Abac;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\AttributesProviderInterface;
use Abac\Base\PoliciesProviderInterface;
use Abac\Configuration\Configuration;
use Abac\Configuration\ConfigurationInterface;
use Abac\Providers\JsonDirectoryPoliciesProvider;
use Abac\Providers\JsonFileAttributesProvider;
use Abac\Providers\JsonFilePoliciesProvider;
use Abac\Verification\AccessChecker;

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
    /**
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * Abac constructor
     *
     * @param PoliciesProviderInterface $policiesProvider
     * @param AttributesProviderInterface $attributesProvider
     * @param AccessCheckerInterface $accessChecker
     * @param array|ConfigurationInterface $configuration
     *
     * TODO: decide how to inject $configuration and assign it to objects
     */
    protected function __construct(
        PoliciesProviderInterface $policiesProvider,
        AttributesProviderInterface $attributesProvider,
        AccessCheckerInterface $accessChecker,
        $configuration = []
    )
    {
        $this->policiesProvider = $policiesProvider;
        $this->attributesProvider = $attributesProvider;
        $this->accessChecker = $accessChecker;
        $this->configuration = $configuration;
    }

    /**
     * @param array|ConfigurationInterface $configuration
     * @return static
     */
    public static function createWithBasicConfiguration($configuration = [])
    {
        if (!$configuration instanceof ConfigurationInterface) {
            $configuration = new Configuration($configuration);
        }

        $policiesPath = $configuration->get('policies.directory');

        return new static(
            new JsonDirectoryPoliciesProvider($policiesPath),
            new JsonFileAttributesProvider(),
            new AccessChecker()
        );
    }

    /**
     * @param string $ruleName
     * @param object $user
     * @param object|null $resource
     * @param array $options
     *
     * @return bool
     */
    public function checkAccess($ruleName, $user, $resource = null, $options = [])
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