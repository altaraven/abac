<?php

namespace Abac\Base;

/**
 * Class Helper
 */
class Helper
{
    /**
     * Scans directory and returns a pretty array of its files
     *
     * @param string $path
     *
     * @return array
     */
    public static function scandir($path)
    {
        return array_values(array_diff(scandir($path), ['..', '.']));
    }

    /**
     * @param string $pathToFile
     * @param bool   $arrayToString
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public static function jsonFileToArray($pathToFile, $arrayToString = false)
    {
        if (!file_exists($pathToFile)) {
            throw new \Exception(sprintf('Not found source file [%s]', $pathToFile));
        }
        $json = file_get_contents($pathToFile);
        $array = json_decode($json, true);

        if (0 < $errorCode = json_last_error()) {
            throw new \Exception(sprintf('Wrong format file [%s]', $pathToFile));
        }

        //Convert array value to JSON string
        if ($arrayToString) {
            foreach ($array as &$item) {
                foreach ($item as $key => $value) {
                    if (is_array($value)) {
                        $item[$key] = json_encode($value);
                    }
                }
            }
        }

        return $array;
    }
}
