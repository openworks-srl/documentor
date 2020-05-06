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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Exception;

class ExcelArrayDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $data = $input["data"];
        if (array_key_exists("column", $input)) {
            $columns = $input["column"];
        } else {
            $columns = $this->findColumnName($data);
        }
        // Controllo se � necessario caricare un template
        $file = Utils::getOptions($options, "template");
        if ($file != null) {
            try {
                $spreadsheet = IOFactory::load(Utils::findFile($file));
            } catch (Exception $e) {
                throw new Exception("Il file $file non e' leggibile oppure e' danneggiato");
            }
        } else {
            $spreadsheet = new Spreadsheet();
        }

        // inizio a costruire il documento
        $sheet = $spreadsheet->getActiveSheet();

        $column = Utils::getOptions($options, "headerStartColumn", "A");
        $row = Utils::getOptions($options, "headerStartRow", 1);
        // Setto gli header della tabella
        foreach ($columns as $nomeColonna) {
            $sheet->setCellValue($column . $row, utf8_encode($nomeColonna));
            $column ++;
        }
        $row = Utils::getOptions($options, "dataStartRow", $row + 1);
        $column = Utils::getOptions($options, "dataStartColumn", "A");

        // ciclo i dati e li inserisco
        foreach ($data as $dato) {
            foreach ($dato as $valoreColonna) {
                $sheet->setCellValue($column . $row, utf8_encode($valoreColonna));
                $column ++;
            }
            $row ++;
            $column = Utils::getOptions($options, "dataStartColumn", "A");
        }
        $doc = $this->bundleDocument();
        IOFactory::createWriter($spreadsheet, ucfirst($this->format))->save($doc->getFile());
        return $doc;
    }

    private function findColumnName($data)
    {
        $colonne = [];
        foreach ($data as $dato) {
            foreach ($dato as $colonna => $v) {
                $colonne[] = $colonna;
            }
            return $colonne;
        }
    }

    public function mapInput($input)
    {
        $this->validateInput($input, 1);
        return Utils::mapArray($input, [
            "data" => 0,
            "column" => 1
        ]);
    }
}
