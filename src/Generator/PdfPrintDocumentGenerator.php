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

use Openworks\Documentor\Utils;
use Openworks\Documentor\Config\Settings;
use PhpOffice\PhpWord\IOFactory;

class PdfPrintDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $binaryName = (Utils::isWindows() ? "WIN" : "UNIX") . "_SOFFICE_BINARY";
        $tmpname = $this->getTmpName();
        $tmpDir = Settings::get("TMP_DIR") . "/" . $tmpname;
        $fileInfo = pathinfo($input["file"]);
        $exportType = $fileInfo["extension"] == "docx" || $fileInfo["extension"] == "doc" || $fileInfo["extension"] == "odt" ? "writer_pdf_Export" : "calc_pdf_Export";
        mkdir($tmpDir);
        $command = Settings::get($binaryName) . " --headless --convert-to pdf:$exportType --outdir $tmpDir " . Utils::findFile($input["file"]);
        exec($command);
        $oldName = $tmpDir . "/" . $fileInfo['filename'] . ".pdf";
        $newName = $tmpDir . ".pdf";
        rename($oldName, $newName);
        if (! Utils::isWindows()) {
            unlink($tmpDir);
        }
        return $this->bunldeDocument()->setFile($newName);
    }

    public function mapInput($input)
    {
        $this->validateInput($input, 1);
        return Utils::mapArray($input, [
            "file" => 0
        ]);
    }
}

