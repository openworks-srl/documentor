<?php
namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Settings;

class Documentor
{

    public function __construct($pathConfig)
    {
        Settings::loadConfig($pathConfig);
    }

    public function generate($input, $format, $options = [])
    {
        $generator = GeneratorFactory::getGenerator(Utils::getOptions($options, "debug", false) ? "debug" : $format, Utils::getOptions($options, "mod", ""));
        return $generator->generate($generator->mapInput($input), Utils::getOptions($options, "doc", []));
    }

    public function getInteractiveGenerator($format, $modifier = "_interactive")
    {
        return GeneratorFactory::getGenerator($format, $modifier);
    }
}

