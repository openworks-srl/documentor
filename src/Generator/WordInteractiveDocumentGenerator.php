<?php
namespace App\Generator;

use App\Document;


use Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

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
                return IOFactory::load($file);
            } catch (Exception $e) {
                throw new Exception("Il file $file non e' leggibile oppure e' danneggiato");
            }
        }
       return new PhpWord();
    }
    
    public function save($object, ...$params)
    {
        if (!($object instanceof PhpWord)) {
            throw new \Exception("L'oggeto passato non e' una istanza di PhpWord");
        }
        $doc = $this->bunldeDocument();
        IOFactory::createWriter($object, ucfirst($this->format))->save($doc->getFile());
        return $doc;
    }

}

