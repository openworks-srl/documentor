<?php
namespace App;

use Exception;

class GeneratorFactory
{

    const classPostfix = "DocumentGenerator";

    const classNameSpace = "App\Generator\\";

    public static function getGenerator( $format,  $modifier = null)
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
        $modifier = $modifier != null ? substr($modifier, 0, 1) == "_" ? ucfirst(substr($modifier, 1)) : ucfirst($modifier) : "";
        $class = self::classNameSpace . ucfirst($class) . $modifier . self::classPostfix;
        try {
            return new $class($format);
        } catch (Exception $e) {
            throw new \InvalidArgumentException("La tipologia di documento speicifcata non puo essere generata");
        }
       
    }
}

