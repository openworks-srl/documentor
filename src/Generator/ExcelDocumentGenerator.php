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
use App\PolyFill\PhpSpreadSheetHtmlStringReaderPolyFill as HtmlReader;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $template = Utils::getOptions($options, "renderTemplate", true) ? (new TwigEngine())->render($input["html"], $input["data"]) : file_get_contents($input["html"]);
        $spreadSheet = (new HtmlReader())->loadFromString($template);
        $doc = $this->bunldeDocument();
        IOFactory::createWriter($spreadSheet, ucfirst($this->format))->save($doc->getFile());
        return $doc;
    }

    public function mapInput($input)
    {
        $this->validateInput($input, 2);
        return Utils::mapArray($input, [
            "html" => 0,
            "data" => 1
        ]);
    }
}

