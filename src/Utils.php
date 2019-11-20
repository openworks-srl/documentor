<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use App\Config\Settings;
use Exception;

class Utils
{

    public static function getOptions($options, $key, $default = null)
    {
        return ! empty($options) && isset($options[$key]) ? $options[$key] : $default;
    }

    /**
     * Cerca un file, prima come path assoluta, poi nella directory dei template, se non lo trova lancia un eccezzione
     * Restitusice semrpe un path valida
     *
     * @param String $path
     * @throws Exception Se il file non viene trovato
     * @return string path valida per il file
     */
    public static function findFile($path)
    {
        if (file_exists($path)) {
            return $path;
        } else if (file_exists(Settings::get("TEMPLATE_DIR") . "/" . $path)) {
            return Settings::get("TEMPLATE_DIR") . "/" . $path;
        } else {
            throw new Exception("Il file $path non puo essere trovato");
        }
    }

    public static function getWordWriterName($str)
    {
        return $str == "odt" ? "ODText" : "Word2007";
    }

    public static function mapArray($input, $map)
    {
        foreach ($map as $key => $index) {
            $default = null;
            if (is_array($index)) {
                $default = $index[1];
                $index = $index[0];
            }

            if (! isset($input[$key])) {

                if (isset($input[$index])) {
                    $input[$key] = $input[$index];
                    unset($input[$index]);
                } else {
                    $input[$key] = $default;
                }
            }
        }
        return $input;
    }
    
    
    public static function isWindows() {
        return PHP_OS == "WINNT";
    }
    
    public static function isHtml($string) {
        return $string != strip_tags($string);
    }
    
}

