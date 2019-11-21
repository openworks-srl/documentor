<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
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

