<?php
namespace App\Generator;


abstract class DefaultDocumentGenerator extends AbstractDocumentGenerator
{

    public abstract function generate($input, $options = []);

    public function validateInput($input, $number)
    {
        if (count($input) < $number) {
            throw new \Exception("L'input fornito non è valido");
        }
        return true;
    }

    public function mapInput($input)
    {
        return $input;
    }
}

