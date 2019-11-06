<?php
namespace App\generator;

use App\Document;
use mikehaertl\wkhtmlto\Pdf;
use App\Constant;

class DebugDocumentGenerator extends DocumentGenerator
{
    public function generate($template, $format, $options = [])
    {
        $doc = $this->bunldeDocument("application/html");
        $handle = fopen($doc->getFile(), "w");
        fwrite($handle, $template);
        fclose($handle);
        return $doc;
    }

}

