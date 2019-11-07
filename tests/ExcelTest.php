<?php
namespace Test\test;

use App\Documentor;
use PHPUnit\Framework\TestCase;

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
        $doc = (new Documentor())->generate("test.excel.twig", "ods", [
            "foo" => $foo
        ]);
        $this->assertFileExists($doc->getFile());
    }
    
    
    
    public function testGenerateManualBuildedDocument() {
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
       
        $generator = (new Documentor())->getInteractiveGenerator("xlsx");
        $obj = $generator->getEditableObject();
        $sheet = $obj->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $doc = $generator->save($obj);
        $this->assertFileExists($doc->getFile());
    }
    
    
}