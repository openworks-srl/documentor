<?php
namespace App\generator;

use App\Document;

abstract class InteractiveDocumentGenerator extends AbstractDocumentGenerator
{
    
    public abstract function getEditableObject(...$params);
    
    public abstract function save($object, ...$params) : Document;
}

