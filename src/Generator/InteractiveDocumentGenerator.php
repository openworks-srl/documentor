<?php
namespace App\Generator;


abstract class InteractiveDocumentGenerator extends AbstractDocumentGenerator
{

    public abstract function getEditableObject(...$params);

    public abstract function save($object, ...$params);
}

