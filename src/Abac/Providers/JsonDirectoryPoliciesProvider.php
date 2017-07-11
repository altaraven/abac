<?php

namespace Abac\Providers;

use Abac\Base\ConfigurableTrait;
use Abac\Base\PoliciesProviderInterface;

class JsonDirectoryPoliciesProvider implements PoliciesProviderInterface
{
    use ConfigurableTrait;
    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $name
     * @return array
     */
    public function one($name)
    {
        return $this->all()[$name];
    }

    public function all()
    {
        return $this->resolveFromPath();
    }

    public function initEnterprisePolicies(Enterprise $enterprise, $environment = 'prod')
    {
//        $enterprise->unsetConnection();
//        $db = $enterprise->getConnection($environment);

        $files = static::scandir($this->path);
        $sources = [];

        foreach ($files as $file) {
            $fileContents = static::resolveJsonFromPath($this->path . $file);
            $sources += isset($fileContents['rules']) ? $fileContents['rules'] : $fileContents;
        }

        $rows = [];
        foreach ($sources as $action => $rule) {

            $rows[] = [
                'action' => $action,
                'action_label' => $this->actionToLabel($action),
                'rule' => Json::encode($rule),
            ];
        }
    }

    public static function resolveJsonFromPath($path)
    {
        $resourceLocation = 'file://' . realpath($path);
        $schema = (object) ['$ref' => $resourceLocation];

//        return json_encode($schema);
        return $schema;
    }

    /**
     * Scans directory and returns a pretty array of its files
     *
     * @param string $path
     * @return array
     */
    public static function scandir($path)
    {
        return array_values(array_diff(scandir($path), ['..', '.']));
    }
}