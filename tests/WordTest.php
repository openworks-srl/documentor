<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\test;

use PHPUnit\Framework\TestCase;
use App\Documentor;

final class WordTest extends TestCase
{

    private $documentor;
    CONST TEST_OUT = "C:\Progetti\documentorTest\\";

    public function __construct()
    {
        $this->documentor = new Documentor(__DIR__."/TestConfig.php");
    }

    public function testGenerateSimpleDocument()
    {
        $foo = [
            [
                'name' => 'Alice'
            ],
            [
                'name' => 'Bob'
            ],
            [
                'name' => 'Eve'
            ]
        ];
        $doc = $this->documentor->generate(["test.doc.twig", [
            "foo" => $foo
        ]], "docx");

        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Word_"."testGenerateSimpleDocument".$doc->getName()));
    }

    
    
    
    public function testegistroPartecipazione()
    {
        $foo = [
            [
                'name' => 'Alice',
                'surname' => 'SurAlice',
                'eta' => '35',
                'id' => 'A1'
            ],
            [
                'name' => 'Bob',
                'surname' => 'surBob',
                'eta' => '5',
                'id' => 'A2'
            ],
            [
                'name' => 'Steve',
                'surname' => 'surSteve',
                'eta' => '445',
                'id' => 'A3'
            ]
        ];
        $doc = $this->documentor->generate(["registroPartecipazione.doc.twig" , [
            "users" => $foo
        ]], "docx", [
            "doc" => [
                "template" => "registroPartecipazioneTemplatePart1.docx",
                "templateSamePage" => true,
                "style" => [
                    "orientation" => "landscape"
                ]
            ]
        ]);

        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Word_"."testegistroPartecipazione".$doc->getName()));
        
    }

    public function testManualGeneration()
    {
        $generator = $this->documentor->getInteractiveGenerator("docx");
        $word = $generator->getEditableObject();
        $section = $word->addSection();
        $section->addText('"Great achievement is usually born of great sacrifice, ' . 'and is never the result of selfishness." ' . '(Napoleon Hill)', array(
            'name' => 'Tahoma',
            'size' => 10
        ));
        $doc = $generator->save($word);
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Word_"."testManualGeneration".$doc->getName()));
    }
    
    
    
    
    public function testGenerateFromDocTemplate()
    {
        $data = [
            "firstname" => "mario",
            "lastname" => "rossi",
            "adress" => "Via garofalo 31"
        ];
        $doc = $this->documentor->generate(["cv.docx", $data], "docx", ["mod" => "template"]);
        
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Word_"."testGenerateFromDocTemplate".$doc->getName()));
    }
}