<?php
namespace App\Generator;

use App\Document;

abstract class InteractiveDocumentGenerator extends AbstractDocumentGenerator
{
    
    public abstract function getEditableObject(...$params);
    
    public abstract function save($object, ...$params);
}

