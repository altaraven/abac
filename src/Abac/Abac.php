<?php

namespace Abac;

use Abac\Base\AccessCheckerInterface;
use Abac\Base\AttributesProviderInterface;
use Abac\Base\PoliciesProviderInterface;
use Abac\Configuration\Configuration;
use Abac\Exceptions\ForbiddenException;
use Abac\Exceptions\InvalidArgumentException;
use Assert\Assert;
use Assert\Assertion;

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
     * @param array $config
     *
     * @return object
     */
    public static function create($config = []/*, $ignoreDefaultConfig = false*/)
    {
        $configuration = Configuration::init($config);

        return new static(
            $configuration->get(Configuration::POLICIES_PROVIDER),
            $configuration->get(Configuration::ATTRIBUTES_PROVIDER),
            $configuration->get(Configuration::ACCESS_CHECKER)
        );
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
        if (!is_string($ruleName)) {
            throw new InvalidArgumentException('Rule name must be a string.');
        }
        if (!is_object($user)) {
            throw new InvalidArgumentException('User must be an object.');
        }

        //TODO: attributesProvider IS NOT used at all!!!
        $ruleItems = $this->policiesProvider->one($ruleName);

        return $this->accessChecker
            ->setUser($user)
            ->setResource($resource)
            ->check($ruleName, $ruleItems);
    }

    /**
     * @param string      $ruleName
     * @param object      $user
     * @param object|null $resource
     *
     * @return bool
     */
    public function checkAccessSafely($ruleName, $user, $resource = null)
    {
        try {
            $this->checkAccess($ruleName, $user, $resource);
        } catch (ForbiddenException $e) {
            return $e->getErrors();
        }

        return true;
    }

    public function _test()
    {
        //        Assert::that('')->eq('')->integer();
//        Assertion::alnum( '');
//
//        Assert::lazy()
//            ->that(10, 'foo')->string()
//            ->that(null, 'bar')->notEmpty()
//            ->that('string', 'baz')->isArray()
//            ->verifyNow();

        $rules = $this->policiesProvider->one('audio.create');
        dump($rules);
        die;
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
