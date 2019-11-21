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
namespace Openworks\Documentor\Generator;

use Openworks\Documentor\Document;
use Openworks\Documentor\Config\Settings;

/**
 * Classe "generatore" base, viene estesa da tutti i generatori
 * contiene alcune utils comuni
 *
 * @author Mattia Bonzi (mattiabonzi.it)
 *        
 */
abstract class AbstractDocumentGenerator
{

    protected $format;

    /**
     *
     * @internal
     *
     * @param
     *            String <code>$format</code> Il formato del documento da generare (l'estensione desiderata del file di output)
     */
    public function __construct($format)
    {
        $this->format = $format;
    }

    /**
     *
     * @internal Restituisce un nome temporaneo random per un documento, basata sulla funzione builtin <code>uniqid()</code>
     * @return string Nome univoco
     */
    protected function getTmpName()
    {
        return "doc_" . uniqid();
    }

    /**
     *
     * @internal Istanzia un oggetto di tipo <code>\App\Document</code> con i valori di default e assegna un nome temporaneo univoco
     * @param string $contentType
     *            Stringa di MIME per trasmisssione su HTTP, se non viene fornita indicazione e' usato <code>application/octet-stream</code>
     * @param int $lenght
     *            Dimensione (in byte) del documento
     * @return Document Classe wrapper per un documento da generare
     */
    protected function bunldeDocument($contentType = "application/octet-stream", $lenght = null)
    {
        $name = $this->getTmpName();
        return (new Document())->setName($name)
            ->setFile(Settings::get("TMP_DIR") . "/" . $name . ".$this->format")
            ->setContentType($contentType)
            ->setFormat($this->format)
            ->setLenght($lenght);
    }
}

