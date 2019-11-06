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

    public function generate(String $template, String $format, Array $data = [], Array $options = [], Bool $debug = false) : Document
    {
        $htmlPage = (new TwigEngine())->render($template, $data);
        return GeneratorFactory::getGeneraotr($debug ? "debug" : $format,  (String) Utils::getOptions($options, "mod", ""))->generate($htmlPage, $format, Utils::getOptions($options, "global", []));
    }

    public function getInteractiveGenerator(String $format, String $modifier = "_interactive") : InteractiveDocumentGenerator
    {
        return GeneratorFactory::getGeneraotr($format, (String) $modifier);
    }
}

