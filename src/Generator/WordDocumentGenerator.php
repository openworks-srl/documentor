<?php
namespace App\Generator;

use App\TwigEngine;
use App\Utils;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class WordDocumentGenerator extends DefaultDocumentGenerator
{

    public function generate($input, $options = [])
    {
        $this->validateInput($input, 2);
        $template = Utils::getOptions($options, "renderTemplate", true) ? (new TwigEngine())->render($input["html"], $input["data"]) : file_get_contents($input["html"]);
        $style = Utils::getOptions($options, "style", []);
        // Controllo se è stato passato un template
        $word = null;
        $file = Utils::getOptions($options, "template");
        if ($file == null) {
            $word = new PhpWord();
        } else {
            $word = IOFactory::load(Utils::findFile($file));
        }
        // Controllo (nel caso sia stao passato un template) se aggiungere alla stessa pagina o inizarne una nuova
        $section = null;
        if (Utils::getOptions($options, "templateSamePage", false) && $file != null) {
            $section = $word->getSection(0);
            $section->setSettings($style);
        } else {
            $section = $word->addSection($style);
        }

        Html::addHtml($section, $template);
        $doc = $this->bunldeDocument();
        IOFactory::createWriter($word, Utils::getWordWriterName($this->format))->save($doc->getFile());
        return $doc;
    }

    public function mapInput($input)
    {
        $this->validateInput($input, 2);
        return Utils::mapArray($input, [
            "html" => 0,
            "data" => 1
        ]);
    }
}

