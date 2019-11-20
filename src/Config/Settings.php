<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Config;

final class Settings
{

    private static $instance;

    private $config;

    private function __construct($config)
    {
        $this->config = $config;
    }

    public static function loadConfig($path)
    {
        static::$instance = new Settings($path != null ? include $path : []);
        static::$instance->checkConfig();
        return static::$instance;
    }

    private function checkConfig()
    {
        $deafults = include __DIR__ . "/DefaultConfig.php";
        foreach ($deafults as $key => $value) {
            if (! array_key_exists($key, self::$instance->config) || null == self::$instance->config[$key]) {
                self::$instance->config[$key] = $value;
            }
        }
    }

    public static function get($key)
    {
        return self::$instance->config[$key];
    }
}

