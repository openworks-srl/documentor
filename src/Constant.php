<?php
namespace App;


use phpDocumentor\Reflection\Types\Self_;

class Constant
{
    
    #DIR
    const TEMPLATE_DIR = __DIR__ . "/../tmp/tmpl";
    const TMP_DIR = __DIR__ . "/../tmp";
    const BINARY_DIR = __DIR__ . "/../lib";
    #LIB
    const LINUX_WK_BINARY = self::BINARY_DIR . "/unix/wkhtmltopdf";
    const WIN_WK_BINARY = self::BINARY_DIR . "/win/bin/wkhtmltopdf";
}

