<?php
/*
 * Copyright 2019 Openworks srl
 *
 * This file is part of the openworks-srl/documentor package.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * A copy of the License is distributed with the software,
 * if you can't find it, you may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 */
namespace Openworks\Documentor\Generator;

use Openworks\Documentor\TwigEngine;
use Openworks\Documentor\Utils;
use Openworks\Documentor\Config\Settings;
use mikehaertl\wkhtmlto\Pdf;

class PdfDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $template = Utils::getOptions($options, "renderTemplate", true) ? (new TwigEngine())->render($input["html"], $input["data"]) : @file_exists($input["html"]) ? file_get_contents($input["html"]) :  $input["html"];
        $pdf = new Pdf(array_merge(Utils::getOptions($options, "renderer", []), [
            'commandOptions' => [
                'useExec' => true
            ]
        ]));
        $pdf->addPage($template);
        $doc = $this->bundleDocument("application/pdf");
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

