<?php

namespace App\Models;

// a config class that uses static methods to get the vvalues of config.json
class ConfigModel
{
    public static function get($key)
    {
        $config = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config.json'), true);
        return $config[$key];
    }
}