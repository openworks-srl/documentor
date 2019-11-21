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
namespace App\PolyFill;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use DOMDocument;
use Exception;

class PhpSpreadSheetHtmlStringReaderPolyFill extends Html
{

    public function loadFromString($content)
    {
        // Create a new DOM object
        $dom = new DOMDocument();
        // Reload the HTML file into the DOM object
        $loaded = $dom->loadHTML(mb_convert_encoding($this->securityScanner->scan($content), 'HTML-ENTITIES', 'UTF-8'));
        if ($loaded === false) {
            throw new Exception('Failed to load content as a DOM Document');
        }
        return $this->loadDocument($dom, new Spreadsheet());
    }

    /**
     * Loads PhpSpreadsheet from DOMDocument into PhpSpreadsheet instance.
     *
     * @param DOMDocument $document
     * @param Spreadsheet $spreadsheet
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     *
     * @return Spreadsheet
     */
    private function loadDocument(DOMDocument $document, Spreadsheet $spreadsheet)
    {
        while ($spreadsheet->getSheetCount() <= $this->sheetIndex) {
            $spreadsheet->createSheet();
        }
        $spreadsheet->setActiveSheetIndex($this->sheetIndex);
        // Discard white space
        $document->preserveWhiteSpace = false;
        $row = 0;
        $column = 'A';
        $content = '';
        $this->rowspan = [];
        $this->processDomElement($document, $spreadsheet->getActiveSheet(), $row, $column, $content);
        // Return
        return $spreadsheet;
    }
}

