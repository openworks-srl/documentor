<?php
namespace Test\test;

use PHPUnit\Framework\TestCase;
use App\Documentor;

final class PdfTest extends TestCase
{

    private $documentor;

    public function __construct()
    {
        $this->documentor = new Documentor(__DIR__ . "/TestConfig.php");
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
        $doc = $this->documentor->generate([
            "test.pdf.twig",
            [
                "foo" => $foo
            ]
        ], "pdf", [
            'global' => [
                'margin-top' => 0,
                'margin-right' => 0,
                'margin-bottom' => 0,
                'margin-left' => 0
            ]
        ]);

        $this->assertFileExists($doc->getFile());
    }
    
    
    
    public function testGenerateFromDocTemplate()
    {
        $data = [
            "firstname" => "mario",
            "lastname" => "rossi",
            "adress" => "Via garofalo 31"
        ];
        $doc = $this->documentor->generate(["cv.docx", $data], "pdf", ["mod" => "wordTemplate"]);
        
        $this->assertFileExists($doc->getFile());
    }
    
    
    public function testGenerateFromDocTemplate2()
    {
        $data = [
            "firstname" => "mario",
            "lastname" => "rossi",
            "adress" => "Via garofalo 31"
        ];
        $doc = $this->documentor->generate(["testdocpdf.docx", $data], "pdf", ["mod" => "wordTemplate"]);
        
        $this->assertFileExists($doc->getFile());
    }
    
    
    public function testGenerateFromPrintWord()
    {
        $doc = $this->documentor->generate(["Ordinamaneto_automatico_corsi.docx"], "pdf", ["mod" => "print"]);
        
        $this->assertFileExists($doc->getFile());
    }
    
    public function testGenerateFromPrintExcel()
    {
        $doc = $this->documentor->generate(["templateTest.xlsx"], "pdf", ["mod" => "print"]);
        
        $this->assertFileExists($doc->getFile());
    }
    
  
    
    
    
}