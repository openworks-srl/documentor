<?php
namespace App\Generator;

use App\Document;

use DOMDocument;
use Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use App\Utils;

class WordDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($template, $options = [])
    {
        $word = new PhpWord();
        $section = $word->addSection(Utils::getOptions($options, "style", []));
        Html::addHtml($section, $template);
        $doc = $this->bunldeDocument();
        IOFactory::createWriter($word, $this->format == "odt" ? "ODText" : "Word2007")->save($doc->getFile());
        return $doc;
    }
}

