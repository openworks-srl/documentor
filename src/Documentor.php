<?php
namespace App;
require_once __DIR__.'/../vendor/autoload.php';


use phpDocumentor\Reflection\Types\String_;
use App\TwigEngine;

class Documentor
{
    public function generate(String $template, String $format,  Array $data = [], Array $options = [], Bool $debug = false) {
        $htmlPage = (new TwigEngine())->render($template, $data);
        return GeneratorFactory::getGeneraotr($debug ? "debug" : $format)->generate($htmlPage, $format, $options);
    }
    
}

