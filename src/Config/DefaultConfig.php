<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */


$BINARY_DIR = __DIR__ . "/../../lib";
return [
    "TEMPLATE_DIR" => __DIR__ . "/../../../DocumentTemplate",
    "TMP_DIR" => sys_get_temp_dir() . "/documentor",
    "LINUX_WK_BINARY" => $BINARY_DIR . "/unix/wkhtmltopdf",
    "WIN_WK_BINARY" => $BINARY_DIR . "/win/bin/wkhtmltopdf",
    "UNIX_SOFFICE_BINARY" => "soffice",
    "WIN_SOFFICE_BINARY" => "\"C:\Program Files\LibreOffice\program\soffice.exe\""
    
];

