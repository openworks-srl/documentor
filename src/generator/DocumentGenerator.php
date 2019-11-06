<?php
namespace App\generator;

use App\Document;
use App\Constant;

abstract class DocumentGenerator extends AbstractDocumentGenerator
{

    public abstract function generate($template, $format, $options = []);
   
}

