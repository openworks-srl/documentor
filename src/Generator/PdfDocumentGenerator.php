<?php
namespace App\Generator;

use App\Document;
use mikehaertl\wkhtmlto\Pdf;
use App\Config\Settings;


class PdfDocumentGenerator extends DefaultDocumentGenerator
{
    public function generate( $template,  $options = [])
    {
        $pdf = new Pdf(array_merge($options, ['commandOptions' => ['useExec' => true]]));
        $pdf->addPage($template);
        $doc = $this->bunldeDocument("application/pdf");
        if (PHP_OS == "WINNT") {
            $pdf->binary = Settings::get("WIN_WK_BINARY");
        } else {
            $pdf->binary = Settings::get("LINUX_WK_BINARY");
        }
        
        if (!$pdf->saveAs($doc->getFile())) {
            throw new \Exception("Si e' verificato un errore durante la scrittura del file pdf ".$doc->getName(). " ERRORE => " . $pdf->getError());
        }
        return $doc;
    }

}

