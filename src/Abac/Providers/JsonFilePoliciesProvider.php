<?php

namespace Abac\Providers;

use Abac\Base\ConfigurableTrait;
use Abac\Base\Helper;
use Abac\Base\PoliciesProviderInterface;
use Abac\Exceptions\InvalidArgumentException;

/**
 * Class JsonFilePoliciesProvider
 */
class JsonFilePoliciesProvider implements PoliciesProviderInterface
{
    use ConfigurableTrait;
    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $name
     *
     * @return array
     */
    public function one($name)
    {
        $all = $this->all();

        if (empty($all[$name])) {
            $message = sprintf(
                'No rule items found with the name "%s".',
                $name
            );
            throw new InvalidArgumentException($message);
        }

        return $all[$name];
    }

    /**
     * @return array
     */
    public function all()
    {
        return Helper::jsonFileToArray($this->path);
    }
}
