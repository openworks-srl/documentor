<?php
namespace App\generator;

use App\Constant;
use App\Document;

abstract class AbstractDocumentGenerator
{
    
    protected $format;
    
    
    public function __construct($format) {
        $this->format = $format;
    }
    
    
    protected function getTmpName()
    {
        return "doc_" . uniqid();
    }
    
    protected function bunldeDocument($contentType = "application/octet-stream", $lenght = null)
    {
        $name = $this->getTmpName();
        return (new Document())->setName($name)
        ->setFile(Constant::TMP_DIR . "/" . $name . ".$this->format")
        ->setContentType($contentType)
        ->setFormat($this->format)
        ->setLenght($lenght);
    }
}

