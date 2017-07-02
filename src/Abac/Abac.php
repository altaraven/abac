<?php

namespace Abac;

use Abac\Base\AttributesProviderInterface;
use Abac\Base\PoliciesProviderInterface;
use Abac\Providers\JsonFileAttributesProvider;
use Abac\Providers\JsonFilePoliciesProvider;

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
     * Abac constructor
     *
     * @param PoliciesProviderInterface $policiesProvider
     * @param AttributesProviderInterface $attributesProvider
     */
    public function __construct(
        PoliciesProviderInterface $policiesProvider,
        AttributesProviderInterface $attributesProvider
    )
    {
        $this->policiesProvider = $policiesProvider;
        $this->attributesProvider = $attributesProvider;
    }

    public static function createWithBasicConfiguration()
    {
        return new static(
            new JsonFilePoliciesProvider(),
            new JsonFileAttributesProvider()
        );
    }

    /**
     * @param PoliciesProviderInterface $policiesProvider
     * @return $this
     */
    public function setPoliciesProvider(PoliciesProviderInterface $policiesProvider)
    {
        $this->policiesProvider = $policiesProvider;

        return $this;
    }

    /**
     * @param AttributesProviderInterface $attributesProvider
     * @return $this
     */
    public function setAttributesProvider(AttributesProviderInterface $attributesProvider)
    {
        $this->attributesProvider = $attributesProvider;

        return $this;
    }
}