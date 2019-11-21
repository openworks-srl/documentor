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

final class WordTest extends BaseTestCase
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
            "test.doc.twig",
            [
                "foo" => $foo
            ]
        ], "docx");

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Word_" . "testGenerateSimpleDocument" . $doc->getName()));
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
        $doc = $this->documentor->generate([
            "testMultipart.twig",
            [
                "users" => $foo
            ]
        ], "docx", [
            "doc" => [
                "template" => "testMultipart.docx",
                "templateSamePage" => true,
                "style" => [
                    "orientation" => "landscape"
                ]
            ]
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Word_" . "testegistroPartecipazione" . $doc->getName()));
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
        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Word_" . "testManualGeneration" . $doc->getName()));
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
        ], "docx", [
            "mod" => "template"
        ]);

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Word_" . "testGenerateFromDocTemplate" . $doc->getName()));
    }
}