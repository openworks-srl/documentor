<?php
namespace App\generator;

use App\Document;
use mikehaertl\wkhtmlto\Pdf;
use App\Constant;

class PdfDocumentGenerator extends IDocumentGenerator
{
    public function generate(String $template, String $format, array $options = []): Document
    {
        $pdf = new Pdf($options);
        $pdf->addPage($template);
        $doc = $this->bunldeDocument("pdf", "application/pdf");
        if (PHP_OS == "WINNT") {
            $pdf->binary = Constant::WIN_WK_BINARY;
        } else {
            $pdf->binary = Constant::LINUX_WK_BINARY;
        }
        if (!$pdf->saveAs($doc->getFile())) {
            throw new \Exception("Si e' verificato un errore durante la scrittura del file pdf ".$doc->getName(). " ERRORE => " . $pdf->getError());
        }
        return $doc;
    }

}

