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
namespace App\Generator;

use App\Utils;
use PhpOffice\PhpWord\TemplateProcessor;

class WordTemplateDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $templateProcessor = new TemplateProcessor(Utils::findFile($input["template"]));
        $templateProcessor->setValues($input["data"]);
        $doc = $this->bunldeDocument();
        $templateProcessor->saveAs($doc->getFile());
        return $doc;
    }

    public function mapInput($input)
    {
        $this->validateInput($input, 2);
        return Utils::mapArray($input, [
            "template" => 0,
            "data" => 1
        ]);
    }
}

