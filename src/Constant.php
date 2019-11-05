<?php
namespace App;


use phpDocumentor\Reflection\Types\Self_;

class Constant
{
    
    #DIR
    public const TEMPLATE_DIR = __DIR__ . "/../tmp/tmpl";
    public const TMP_DIR = __DIR__ . "/../tmp";
    public const BINARY_DIR = __DIR__ . "/../lib";
   
    #LIB
    public const LINUX_WK_BINARY = self::BINARY_DIR . "/unix/wkhtmltopdf";
    public const WIN_WK_BINARY = self::BINARY_DIR . "/win/bin/wkhtmltopdf";
    
}

