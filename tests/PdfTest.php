<?php
namespace Test\test;

use App\Documentor;
use PHPUnit\Framework\TestCase;

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
        var_dump((new Documentor())->generate("test.pdf.twig", "pdf", [
            "foo" => $foo
        ], [
            'global' => [
                'margin-top' => 0,
                'margin-right' => 0,
                'margin-bottom' => 0,
                'margin-left' => 0
            ]
        ]));
    }
    
    
}