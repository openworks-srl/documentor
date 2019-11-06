<?php
namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use phpDocumentor\Reflection\Types\String_;
use App\TwigEngine;
use App\Utils;
use App\generator\DocumentGenerator;
use App\generator\InteractiveDocumentGenerator;

class Documentor
{

    public function generate($template, $format, $data = [], $options = [], $debug = false)
    {
        $htmlPage = (new TwigEngine())->render($template, $data);
        return GeneratorFactory::getGeneraotr($debug ? "debug" : $format, Utils::getOptions($options, "mod", ""))->generate($htmlPage, $format, Utils::getOptions($options, "global", []));
    }

    public function getInteractiveGenerator($format, $modifier = "_interactive")
    {
        return GeneratorFactory::getGeneraotr($format, $modifier);
    }
}

