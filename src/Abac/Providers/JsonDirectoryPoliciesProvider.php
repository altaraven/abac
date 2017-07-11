<?php

namespace Abac\Providers;

use Abac\Base\ConfigurableTrait;
use Abac\Base\Helper;
use Abac\Base\PoliciesProviderInterface;

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
        return $this->all()[$name];
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
