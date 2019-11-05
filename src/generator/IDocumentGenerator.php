<?php
namespace App\generator;

use App\Document;
use App\Constant;

abstract class IDocumentGenerator
{

    public abstract function generate(String $template, String $format, Array $options = []): Document;

    protected function getTmpName()
    {
        return "doc_" . uniqid();
    }

    protected function bunldeDocument(String $format, String $contentType = "application/octet-stream", int $lenght = null)
    {
        $name = $this->getTmpName();
        return (new Document())->setName($name)
        ->setFile(Constant::TMP_DIR . "/" . $name . ".$format")
            ->setContentType($contentType)
            ->setFormat($format)
            ->setLenght($lenght);
    }
}

