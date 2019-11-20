<?php
namespace App\Generator;


use App\Utils;

/**
 *
 * @author Mattia Bonzi (mattiabonzi.it)
 *        
 */
class DebugDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $doc = $this->bunldeDocument("application/html");
        $handle = fopen($doc->getFile(), "w");
        if (Utils::isHtml($input)) {
            fwrite($handle, $input);
        } else {
            ob_start();
            echo "<H1>Input</H1>";
            var_dump($input);
            echo "<br/><H1>options</H1>";
            var_dump($options);
            echo "<br/><H1>StackTrace</H1>";
            var_dump(debug_print_backtrace());
        }
        fclose($handle);
        return $doc;
    }
}

