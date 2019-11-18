<?php
namespace Test\test;

use PHPUnit\Framework\TestCase;
use App\Documentor;

final class ExcelTest extends TestCase
{
    
    public function testGenerateDocument() {
        $foo = [
            [
                'name' => 'Alice',
                'surname' => 'In The Wontherland'
            ],
            [
                'name' => 'Bob',
                'surname' => 'Marley'
            ],
            [
                'name' => 'Steve',
                'surname' => 'Jobs'
                
            ]
        ];
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate("test.excel.twig", "ods", [
            "foo" => $foo
        ]);
        $this->assertFileExists($doc->getFile());
    }
    
    
    
    public function testGenerateManualBuildedDocument() {
        $generator = (new Documentor(__DIR__."/TestConfig.php"))->getInteractiveGenerator("xlsx");
        $obj = $generator->getEditableObject();
        $sheet = $obj->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $doc = $generator->save($obj);
        $this->assertFileExists($doc->getFile());
    }
    
    
    public function testgenerateFromArrayWithColoumn() {
        $data = [
            "column" => ["Nome", "Cognome", "Età"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate($data, "xlsx", [], ["mod" => "array"]);
        $this->assertFileExists($doc->getFile());
    }
    
    
    public function testgenerateFromArrayWithoutColoumn() {
        $data = [
                ["Nome" => "Mattia", "Cognome" => "Bonzi","Età" => "21"],
                ["Nome" => "Davide", "Cognome" => "manoli","Età" => 21],
                ["Nome" => "Alessandro", "Cognome" => "Cibelli","Età" => "35"]
        ];
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate($data, "xlsx", [], ["mod" => "array"]);
        $this->assertFileExists($doc->getFile());
    }
    
    
    
    
    public function testgenerateFromArrayWithColoumnWithOffset() {
        $options = ["mod" => "array", "doc" => ["headerStartColumn" => "B", "headerStartRow" => 3, "dataStartColumn" => "B"]];
        $data = [
            "column" => ["Nome", "Cognome", "Età"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate($data, "xlsx", [], $options);
        $this->assertFileExists($doc->getFile());
    }
    
    
    public function testgenerateFromArrayWithoutColoumnWithOffset() {
        $options = ["mod" => "array", "doc" => ["headerStartColumn" => "B", "headerStartRow" => 3, "dataStartColumn" => "B"]];
        $data = [
            ["Nome" => "Mattia", "Cognome" => "Bonzi","Età" => "21"],
            ["Nome" => "Davide", "Cognome" => "manoli","Età" => 21],
            ["Nome" => "Alessandro", "Cognome" => "Cibelli","Età" => "35"]
        ];
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate($data, "xlsx", [], $options);
        $this->assertFileExists($doc->getFile());
    }
    
    
    
    public function testgenerateFromArrayWithColoumnWithTemplate() {
        $options = ["mod" => "array", "doc" => ["template" => __DIR__ . "/../tmp/tmpl/templateTest.xlsx"]];
        $data = [
            "column" => ["Nome", "Cognome", "Età"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate($data, "xlsx", [], $options);
        $this->assertFileExists($doc->getFile());
    }
}