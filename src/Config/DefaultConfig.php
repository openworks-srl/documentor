<?php
/*
 * Copyright 2019 Openworks srl
 *
 * This file is part of the openworks-srl/documentor package.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * A copy of the License is distributed with the software,
 * if you can't find it, you may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 */
$BINARY_DIR = __DIR__ . "/../../lib";
return [
    "TEMPLATE_DIR" => __DIR__ . "/../../../../../DocumentTemplate",
    "TMP_DIR" => sys_get_temp_dir() . "/documentor",
    "LINUX_WK_BINARY" => $BINARY_DIR . "/unix/wkhtmltopdf",
    "WIN_WK_BINARY" => $BINARY_DIR . "/win/bin/wkhtmltopdf",
    "UNIX_SOFFICE_BINARY" => "soffice",
    "MAC_SOFFICE_BINARY" => "/Applications/OpenOffice.app/Contents/MacOS/soffice",
    "WIN_SOFFICE_BINARY" => "\"C:\Program Files\LibreOffice\program\soffice.exe\""
];

