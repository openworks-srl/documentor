<?php
namespace App\generator;

use App\Document;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\PolyFill\PhpSpreadSheetHtmlStringReaderPolyFill as HtmlReader;
use DOMDocument;
use Exception;

class ExcelDocumentGenerator extends DocumentGenerator
{

    public function generate(String $template, String $format, array $options = []): Document
    {
        $spreadSheet = (new HtmlReader())->loadFromString($template);
        $doc = $this->bunldeDocument();
        IOFactory::createWriter($spreadSheet, ucfirst($format))->save($doc->getFile());
        return $doc;
    }
}

