<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Settings;
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

