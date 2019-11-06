<?php
namespace App\PolyFill;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Html;
use DOMDocument;
use Exception;

class PhpSpreadSheetHtmlStringReaderPolyFill extends Html
{
    
    public function loadFromString($content): Spreadsheet
    {
        //    Create a new DOM object
        $dom = new DOMDocument();
        //    Reload the HTML file into the DOM object
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
    private function loadDocument(DOMDocument $document, Spreadsheet $spreadsheet): Spreadsheet
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

