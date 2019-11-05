<?php
namespace App;

use App\generator\IDocumentGenerator;

class GeneratorFactory
{
    
    const classPostfix = "DocumentGenerator";
    const classNameSpace = "App\\generator\\";
    
    public static function getGeneraotr(String $format) : IDocumentGenerator {
        $class = null;
        switch ($format) {
          case "doc":
          case "docx":
          case "odt":
          $class = "word";
          break;
          
          
          case "xls":
          case "xlsx":
              $class = "exel";
              break;
              
              
          case "pdf":
              $class = "pdf";
              break;
              
          case "debug":
              $class = "debug";
              break;
          
          default:
              throw new \InvalidArgumentException("La tipologia di docukento speicifcata non puo essere generata");
          break;
      }
      
      $class = self::classNameSpace.ucfirst($class).self::classPostfix;
      return new $class();
    }
}

