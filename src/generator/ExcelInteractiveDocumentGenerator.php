<?php
namespace App\generator;

use App\Document;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Exception;

class ExcelInteractiveDocumentGenerator extends InteractiveDocumentGenerator
{
 

    public function getEditableObject(...$params)
    {
        if (isset($params[0])) {
            $file = $params[0];
            if (!file_exists($file)) {
                throw new Exception("Il file $file non puo essere trovato");
            }
            try {
               return \PhpOffice\PhpSpreadsheet\IOFactory::load('template.xlsx');
            } catch (Exception $e) {
                throw new Exception("Il file $file non e' leggibile oppure e' danneggiato");
            }
        }
       return new Spreadsheet();
    }
    
    public function save($object, ...$params)
    {
        if (!($object instanceof Spreadsheet)) {
            throw new \Exception("L'oggeto passato non e' una istanza di Spreadsheet");
        }
        $doc = $this->bunldeDocument();
        IOFactory::createWriter($object, ucfirst($this->format))->save($doc->getFile());
        return $doc;
    }

}

