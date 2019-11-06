<?php
namespace App;

use App\generator\DocumentGenerator;
use App\generator\AbstractDocumentGenerator;

class GeneratorFactory
{

    const classPostfix = "DocumentGenerator";

    const classNameSpace = "App\\generator\\";

    public static function getGeneraotr(String $format, String $modifier = null): AbstractDocumentGenerator
    {
        $class = null;
        switch ($format) {
            case "doc":
            case "docx":
            case "odt":
                $class = "word";
                break;

            case "csv":
            case "ods":
            case "xls":
            case "xlsx":
                $class = "excel";
                break;

            case "pdf":
                $class = "pdf";
                break;

            case "debug":
                $class = "debug";
                break;

            default:
                throw new \InvalidArgumentException("La tipologia di documento speicifcata non puo essere generata");
                break;
        }

        $class = self::classNameSpace . ucfirst($class) . ($modifier != null ? ucfirst(substr($modifier, 1)) : "") . self::classPostfix;
        return new $class($format);
    }
}

