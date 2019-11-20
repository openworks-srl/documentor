<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\test;

use App\Documentor;
use PHPUnit\Framework\TestCase;

final class ExcelTest extends TestCase
{
    
    private $documentor;
    CONST TEST_OUT = "C:\Progetti\documentorTest\\";
    
    
    public function __construct() {
        $this->documentor = new Documentor(__DIR__."/TestConfig.php");
    }
    
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
        $doc =  $this->documentor->generate(["test.excel.twig", [
            "foo" => $foo
        ]], "ods");
        
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Excel_"."testGenerateDocument_".$doc->getName()));
    }
    
    
    
    public function testGenerateManualBuildedDocument() {
        $generator =  $this->documentor->getInteractiveGenerator("xlsx");
        $obj = $generator->getEditableObject();
        $sheet = $obj->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $doc = $generator->save($obj);
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Excel_"."testGenerateManualBuildedDocument_".$doc->getName()));
    }
    
    
    public function testgenerateFromArrayWithColoumn() {
        $data = [
            "column" => ["Nome", "Cognome", "Et�"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc =  $this->documentor->generate($data, "xlsx", ["mod" => "array"]);
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Excel_"."testgenerateFromArrayWithColoumn_".$doc->getName()));
    }
    
    
    public function testgenerateFromArrayWithoutColoumn() {
        $data = [[
                ["Nome" => "Mattia", "Cognome" => "Bonzi","Et�" => "21"],
                ["Nome" => "Davide", "Cognome" => "manoli","Et�" => 21],
                ["Nome" => "Alessandro", "Cognome" => "Cibelli","Et�" => "35"]
        ]];
        $doc =  $this->documentor->generate($data, "xlsx", ["mod" => "array"]);
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Excel_"."testgenerateFromArrayWithoutColoumn_".$doc->getName()));
        
    }
    
    
    
    
    public function testgenerateFromArrayWithColoumnWithOffset() {
        $options = ["mod" => "array", "doc" => ["headerStartColumn" => "B", "headerStartRow" => 3, "dataStartColumn" => "B"]];
        $data = [
            "column" => ["Nome", "Cognome", "Et�"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc =  $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Excel_"."testgenerateFromArrayWithColoumnWithOffset_".$doc->getName()));
        
    }
    
    
    public function testgenerateFromArrayWithoutColoumnWithOffset() {
        $options = ["mod" => "array", "doc" => ["headerStartColumn" => "B", "headerStartRow" => 3, "dataStartColumn" => "B"]];
        $data = [[
            ["Nome" => "Mattia", "Cognome" => "Bonzi","Et�" => "21"],
            ["Nome" => "Davide", "Cognome" => "manoli","Et�" => 21],
            ["Nome" => "Alessandro", "Cognome" => "Cibelli","Et�" => "35"]
        ]];
        $doc =  $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Excel_"."testgenerateFromArrayWithoutColoumnWithOffset_".$doc->getName()));
        
    }
    
    
    
    public function testgenerateFromArrayWithColoumnWithTemplate() {
        $options = ["mod" => "array", "doc" => ["template" => "templateTest.xlsx"]];
        $data = [
            "column" => ["Nome", "Cognome", "Et�"],
            "data" => [
                ["Mattia", "Bonzi", "21"],
                ["Davide", "manoli", 21],
                ["Alessandro", "Cibelli", "35"]
            ]
        ];
        $doc =  $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->saveAs(static::TEST_OUT, "Excel_"."testgenerateFromArrayWithColoumnWithTemplate_".$doc->getName()));
        
    }
}