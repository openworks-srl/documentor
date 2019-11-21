<?php
/*
 * Copyright 2019 Openworks srl
 *
 * This file is part of the openworks-srl/documentor package.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * A copy of the License is distributed with the software,
 * if you can't find it, you may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 */
namespace Openworks\Documentor\Tests;

use PHPUnit\Framework\TestCase;
use Openworks\Documentor\Documentor;

final class PdfTest extends BaseTestCase
{

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

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Pdf_" . "testGenerateSimpleDocument_" . $doc->getName()));
    }

    public function testGenerateFromDocTemplate()
    {
        $data = [
            "firstname" => "mario",
            "lastname" => "rossi",
            "adress" => "Via garofalo 31"
        ];
        $doc = $this->documentor->generate([
            "cv.docx",
            $data
        ], "pdf", [
            "mod" => "wordTemplate"
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Pdf_" . "testGenerateFromDocTemplate_" . $doc->getName()));
    }

    public function testGenerateFromPrintWord()
    {
        $doc = $this->documentor->generate([
            "file-sample_500kB.docx"
        ], "pdf", [
            "mod" => "print"
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Pdf_" . "testGenerateFromPrintWord_" . $doc->getName()));
    }

    public function testGenerateFromPrintExcel()
    {
        $doc = $this->documentor->generate([
            "Financial_Sample.xlsx"
        ], "pdf", [
            "mod" => "print"
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Pdf_" . "testGenerateFromPrintExcel_" . $doc->getName()));
    }
}