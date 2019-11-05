<?php
namespace App\generator;

use App\Document;
use mikehaertl\wkhtmlto\Pdf;
use App\Constant;

class DebugDocumentGenerator extends IDocumentGenerator
{
    public function generate(String $template, String $format, array $options = []): Document
    {
        $doc = $this->bunldeDocument("html", "application/html");
        $handle = fopen($doc->getFile(), "w");
        fwrite($handle, $template);
        fclose($handle);
        return $doc;
    }

}

