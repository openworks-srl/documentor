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
namespace Openworks\Documentor;


use Openworks\Documentor\Config\Settings;
use Exception;

/**
 * Classe principale, utilizzata come facade per la generazione dei documenti
 * Unico entry point
 *
 * @author Mattia Bonzi (mattiabonzi.it)
 *        
 */
class Documentor
{

    public function __construct($pathConfig = null)
    {
        Settings::loadConfig($pathConfig);
        $this->init();
    }

    /**
     *
     * @param Array|Mixed $input
     *            Array
     * @param String $format
     * @param Array $options
     * @return Document
     */
    public function generate($input, $format, $options = [])
    {
        $generator = GeneratorFactory::getGenerator(Utils::getOptions($options, "debug", false) ? "debug" : $format, Utils::getOptions($options, "mod", ""));
        return $generator->generate($generator->mapInput($input), Utils::getOptions($options, "doc", []));
    }

    public function getInteractiveGenerator($format, $modifier = "_interactive")
    {
        return GeneratorFactory::getGenerator($format, $modifier);
    }

    private function init()
    {
        if (! file_exists(Settings::get("TMP_DIR"))) {
            try {
                mkdir(Settings::get("TMP_DIR"), 0777, true);
            } catch (Exception $e) {
                throw new Exception("Impossibile trovare e/o creare la directry temporanea specificata");
            }
        }

        if (! file_exists(Settings::get("TEMPLATE_DIR"))) {
            throw new Exception("Impossibile trovare la directry template specificata");
        }
    }
}

