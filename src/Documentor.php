<?php
namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use App\TwigEngine;
use App\Utils;

class Documentor
{

    public function generate($input, $format, $data = [], $options = [], $debug = false)
    {
        if (is_string($input)) {
            $input = (new TwigEngine())->render($input, $data);
        }
        return GeneratorFactory::getGeneraotr($debug ? "debug" : $format, Utils::getOptions($options, "mod", ""))->generate($input, Utils::getOptions($options, "global", []));
    }

    public function getInteractiveGenerator($format, $modifier = "_interactive")
    {
        return GeneratorFactory::getGeneraotr($format, $modifier);
    }
}

