<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use Exception;

class GeneratorFactory
{

    const classPostfix = "DocumentGenerator";

    const classNameSpace = "App\Generator\\";

    public static function getGenerator($format, $modifier = null)
    {
        $class = null;
        switch (strtolower($format)) {
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

