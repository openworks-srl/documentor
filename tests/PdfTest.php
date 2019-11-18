<?php
namespace Test\test;

use PHPUnit\Framework\TestCase;
use App\Documentor;

final class PdfTest extends TestCase
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
        $doc = (new Documentor(__DIR__."/TestConfig.php"))->generate("test.pdf.twig", "pdf", [
            "foo" => $foo
        ], [
            'global' => [
                'margin-top' => 0,
                'margin-right' => 0,
                'margin-bottom' => 0,
                'margin-left' => 0
            ]
        ]);
       
       $this->assertFileExists($doc->getFile());
    }
    
    
}