<?php
namespace App\Generator;

use App\Utils;
use App\Config\Settings;
use PhpOffice\PhpWord\IOFactory;

class PdfWordTemplateDocumentGenerator extends DefaultDocumentGenerator
{

    
    
    
    public function generate($input, $options = [])
    {
        $wordTemplateGenerator = new WordTemplateDocumentGenerator("docx");
        $pdfPrinter = new PdfPrintDocumentGenerator("pdf");
        $doc = $wordTemplateGenerator->generate($wordTemplateGenerator->mapInput($input));
        return $pdfPrinter->generate($pdfPrinter->mapInput([$doc->getFile()]));
        
    }
    

    public function mapInput($input)
    {
        $this->validateInput($input, 1);
        return Utils::mapArray($input, [
            "template" => 0,
            "data" => 1
        ]);
    }
}

