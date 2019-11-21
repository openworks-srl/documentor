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

use App\TwigEngine;
use App\Utils;
use App\Config\Settings;
use mikehaertl\wkhtmlto\Pdf;

class PdfDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $template = Utils::getOptions($options, "renderTemplate", true) ? (new TwigEngine())->render($input["html"], $input["data"]) : file_get_contents($input["html"]);
        $pdf = new Pdf(array_merge(Utils::getOptions($options, "renderer", []), [
            'commandOptions' => [
                'useExec' => true
            ]
        ]));
        $pdf->addPage($template);
        $doc = $this->bunldeDocument("application/pdf");
        if (Utils::isWindows()) {
            $pdf->binary = Settings::get("WIN_WK_BINARY");
        } else {
            $pdf->binary = Settings::get("LINUX_WK_BINARY");
        }

        if (! $pdf->saveAs($doc->getFile())) {
            throw new \Exception("Si e' verificato un errore durante la scrittura del file pdf " . $doc->getFile() . " ERRORE => " . $pdf->getError());
        }
        return $doc;
    }

    public function mapInput($input)
    {
        $this->validateInput($input, 1);
        return Utils::mapArray($input, [
            "html" => 0,
            "data" => [
                1,
                []
            ]
        ]);
    }
}

