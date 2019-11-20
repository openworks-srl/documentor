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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Exception;

class ExcelArrayDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $data = $input["data"];
        if (array_key_exists("column", $data)) {
            $columns = $input["column"];
        } else {
            $columns = $this->findColumnName($data);
        }

        // Controllo se è necessario caricare un template
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
        $doc = $this->bunldeDocument();
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
