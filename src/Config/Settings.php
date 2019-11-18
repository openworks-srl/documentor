<?php
namespace App\Config;


final class Settings
{
    private static $instance;
    private $config;
    
    private function __construct($config) {
        $this->config = $config;
    }
    
    public static function loadConfig($path) {
       
        static::$instance = new Settings(include $path);
        static::$instance->checkConfig();
        return static::$instance;
        
    }
    
    private function checkConfig() {
        $deafults = include __DIR__ . "/DefaultConfig.php";
        foreach ($deafults as $key => $value) {
            if (!array_key_exists($key, self::$instance->config) || null == self::$instance->config[$key]) {
                self::$instance->config[$key] = $value;
            }
        }
    }
    
    
    public static function get($key) {
        return self::$instance->config[$key];
    }
    
    
    
}

