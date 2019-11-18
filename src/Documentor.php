<?php
namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use App\TwigEngine;
use App\Utils;
use App\Config\Settings;

class Documentor
{

    public function __construct($pathConfig)
    {
        Settings::loadConfig($pathConfig);
    }

    public function generate($input, $format, $data = [], $options = [])
    {
        if (is_string($input)) {
            $input = (new TwigEngine())->render($input, $data);
        }
        $format = Utils::getOptions($options, "debug", false) ? "debug" : $format;
        return GeneratorFactory::getGenerator($format, Utils::getOptions($options, "mod", ""))->generate($input, Utils::getOptions($options, "doc", []));
    }

    public function getInteractiveGenerator($format, $modifier = "_interactive")
    {
        return GeneratorFactory::getGenerator($format, $modifier);
    }
}

