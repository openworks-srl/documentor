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
use Openworks\Documentor\PolyFill\PhpSpreadSheetHtmlStringReaderPolyFill as HtmlReader;
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

