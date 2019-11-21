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
namespace App\Generator;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Exception;

class WordInteractiveDocumentGenerator extends InteractiveDocumentGenerator
{

    public function getEditableObject(...$params)
    {
        if (isset($params[0])) {
            $file = $params[0];
            if (! file_exists($file)) {
                throw new Exception("Il file $file non puo essere trovato");
            }
            try {
                return IOFactory::load($file);
            } catch (Exception $e) {
                throw new Exception("Il file $file non e' leggibile oppure e' danneggiato");
            }
        }
        return new PhpWord();
    }

    public function save($object, ...$params)
    {
        if (! ($object instanceof PhpWord)) {
            throw new \Exception("L'oggeto passato non e' una istanza di PhpWord");
        }
        $doc = $this->bunldeDocument();
        IOFactory::createWriter($object, $this->format == "odt" ? "ODText" : "Word2007")->save($doc->getFile());
        return $doc;
    }
}

