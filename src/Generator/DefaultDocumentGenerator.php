<?php
namespace App\Generator;

use App\Document;


abstract class DefaultDocumentGenerator extends AbstractDocumentGenerator
{

    public abstract function generate($template, $options = []);
   
}

