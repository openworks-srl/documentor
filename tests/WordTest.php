<?php
namespace Test\test;

use PHPUnit\Framework\TestCase;
use App\Documentor;

final class WordTest extends TestCase
{
    
    public function testGenerateSimpleDocument() {
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
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate("test.doc.twig", "docx", [
            "foo" => $foo
        ]);
       
       $this->assertFileExists($doc->getFile());
    }
    
    
    
    public function testegistroPartecipazione() {
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
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate("registroPartecipazione.doc.twig", "docx", [
            "users" => $foo
        ], ["doc" => ["style" => ["orientation" => "landscape"]]]);
        
        $this->assertFileExists($doc->getFile());
    }
    
    
}