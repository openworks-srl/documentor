<?php
namespace App\generator;

use App\Document;
use App\Constant;

abstract class DefaultDocumentGenerator extends AbstractDocumentGenerator
{

    public abstract function generate($template, $options = []);
   
}

