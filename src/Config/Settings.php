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
namespace App\Config;

/**
 * Classe responsabile del caricamento e accesso alle configurazioni
 * E' implementata seguendo il pattern "singleton", quindi una volta inizializzata
 * mantiene in memoria tutte le configurazioni, è necessario inizializzare la classe
 * con il meotodo <code>loadConfig</code>
 *
 * @author Mattia Bonzi (mattiabonzi.it)
 *        
 */
final class Settings
{

    private static $instance;

    private $config;

    private function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Esegue l'inizializzazione della classe, caricando le configurazione da file,
     * e inserendo le configurazioni non specificate dall'utente
     *
     * @param String $path
     *            Percorso al file di cnfigurazione
     */
    public static function loadConfig($path)
    {
        static::$instance = new Settings($path != null ? include $path : []);
        static::$instance->checkConfig();
    }

    /**
     * Esegue un cntrollo di quali configurazioni sono state definite dall'utente
     * e carica i valori di default per quelle mancanti
     *
     * @internal
     */
    private function checkConfig()
    {
        $deafults = include __DIR__ . "/DefaultConfig.php";
        foreach ($deafults as $key => $value) {
            if (! array_key_exists($key, self::$instance->config) || null == self::$instance->config[$key]) {
                self::$instance->config[$key] = $value;
            }
        }
    }

    /**
     *
     * @param String|Mixed $key
     *            La chiave della configurazione
     * @throws \Exception Se la configurazoine non viene trovata
     * @return String|Mixed Il valore della configurazione
     */
    public static function get($key)
    {
        if (! isset(self::$instance->config[$key])) {
            throw new \Exception("Configurazione non trovata $key");
        }
        return self::$instance->config[$key];
    }
}

