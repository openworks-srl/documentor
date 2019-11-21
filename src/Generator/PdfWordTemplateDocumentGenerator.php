<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */
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
        $pdf = $pdfPrinter->generate($pdfPrinter->mapInput([
            $doc->getFile()
        ]));
        unlink($doc->getFile());
        return $pdf;
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

