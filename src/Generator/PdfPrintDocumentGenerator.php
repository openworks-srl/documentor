<?php
namespace App\Generator;

use App\Utils;
use App\Config\Settings;
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
        $oldName = $tmpDir . "/".$fileInfo['filename'].".pdf";
        $newName = $tmpDir.".pdf";
        rename($oldName, $newName);
        if (!Utils::isWindows()) {
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

