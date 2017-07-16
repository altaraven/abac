<?php

namespace Tests\Abac\Data\User;

use Abac\Base\ConfigurableTrait;

/**
 * Class User
 */
class User
{
    use ConfigurableTrait;

    /**
     * @var string
     */
    private $email;

    /**
     * @var array
     */
    private $roles = [
        'store-administrator',
        'content-manager',
        'pr-manager',
    ];

    /**
     * @var string
     */
    private $location;

    /**
     * @var bool
     */
    private $isRoot;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return bool
     */
    public function getIsRoot()
    {
        return $this->isRoot;
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
