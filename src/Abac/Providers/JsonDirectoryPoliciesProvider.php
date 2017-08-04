<?php

namespace Abac\Providers;

use Abac\Base\ConfigurableTrait;
use Abac\Base\Helper;
use Abac\Base\PoliciesProviderInterface;
use Abac\Exceptions\InvalidArgumentException;

class JsonDirectoryPoliciesProvider implements PoliciesProviderInterface
{
    use ConfigurableTrait;
    /**
     * @var string
     */
    protected $path;

//    /**
//     * @var string
//     */
//    protected $data;

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
        return $this->resolveDataFromPath();
    }

    /**
     * @return array
     */
    protected function resolveDataFromPath()
    {
        $files = Helper::scandir($this->path);
        $sources = [];

        foreach ($files as $file) {
            $fileContents = Helper::jsonFileToArray($this->path . '/' . $file);
            $sources += $fileContents;
        }

        return $sources;
    }
}
