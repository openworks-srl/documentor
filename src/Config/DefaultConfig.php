<?php

$BINARY_DIR = __DIR__ . "/../lib";
return [
    "TEMPLATE_DIR" => __DIR__ .  "/../tmp/tmpl",
    "TMP_DIR" =>  __DIR__ . "/../tmp",
    "LINUX_WK_BINARY" => $BINARY_DIR . "/unix/wkhtmltopdf",
    "WIN_WK_BINARY" => $BINARY_DIR . "/win/bin/wkhtmltopdf"
];

