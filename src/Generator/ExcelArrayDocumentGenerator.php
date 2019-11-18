<?php
namespace App\Generator;

use App\Utils;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Exception;

class ExcelArrayDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($data, $options = [])
    {
  
        $columnsSpecified = array_key_exists("column", $data);
        if ($columnsSpecified) {
            $columns = $data["column"];
            $data = $data["data"];
        } else {
            $columns = $this->findColumnName($data);
        }

        // Controllo se è necessario caricare un template
        if (isset($options["template"])) {
            $file = $options["template"];
            if (! file_exists($file)) {
                throw new Exception("Il file $file non puo essere trovato");
            }
            try {
                $spreadsheet = IOFactory::load($file);
            } catch (Exception $e) {
                throw new Exception("Il file $file non e' leggibile oppure e' danneggiato");
            }
        } else {
            $spreadsheet = new Spreadsheet();
        }

        // inizio a costruire il documento
        $sheet = $spreadsheet->getActiveSheet();

        $column =  Utils::getOptions($options, "headerStartColumn", "A");
        $row =  Utils::getOptions($options, "headerStartRow", 1);
        // Setto gli header della tabella
        foreach ($columns as $nomeColonna) {
            $sheet->setCellValue($column . $row, utf8_encode($nomeColonna));
            $column ++;
        }
        $row =  Utils::getOptions($options, "dataStartRow", $row+1);
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
}
