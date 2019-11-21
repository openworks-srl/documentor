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

use Openworks\Documentor\Documentor;
use PHPUnit\Framework\TestCase;

final class ExcelTest extends BaseTestCase
{

    public function testGenerateDocument()
    {
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
        $doc = $this->documentor->generate([
            "test.excel.twig",
            [
                "foo" => $foo
            ]
        ], "ods");

        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Excel_" . "testGenerateDocument_" . $doc->getName()));
    }

    public function testGenerateManualBuildedDocument()
    {
        $generator = $this->documentor->getInteractiveGenerator("xlsx");
        $obj = $generator->getEditableObject();
        $sheet = $obj->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $doc = $generator->save($obj);
        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Excel_" . "testGenerateManualBuildedDocument_" . $doc->getName()));
    }

    public function testgenerateFromArrayWithColoumn()
    {
        $data = [
            "column" => [
                "Nome",
                "Cognome",
                "Età"
            ],
            "data" => [
                [
                    "Mattia",
                    "Bonzi",
                    "21"
                ],
                [
                    "Francesco",
                    "Turro",
                    21
                ],
                [
                    "Alessandro",
                    "Cittarelli",
                    "35"
                ]
            ]
        ];
        $doc = $this->documentor->generate($data, "xlsx", [
            "mod" => "array"
        ]);
        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Excel_" . "testgenerateFromArrayWithColoumn_" . $doc->getName()));
    }

    public function testgenerateFromArrayWithoutColoumn()
    {
        $data = [
            [
                [
                    "Nome" => "Mattia",
                    "Cognome" => "Bonzi",
                    "Età" => "21"
                ],
                [
                    "Nome" => "Francesco",
                    "Cognome" => "Turro",
                    "Età" => 21
                ],
                [
                    "Nome" => "Alessandro",
                    "Cognome" => "Cittarelli",
                    "Età" => "35"
                ]
            ]
        ];
        $doc = $this->documentor->generate($data, "xlsx", [
            "mod" => "array"
        ]);
        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Excel_" . "testgenerateFromArrayWithoutColoumn_" . $doc->getName()));
    }

    public function testgenerateFromArrayWithColoumnWithOffset()
    {
        $options = [
            "mod" => "array",
            "doc" => [
                "headerStartColumn" => "B",
                "headerStartRow" => 3,
                "dataStartColumn" => "B"
            ]
        ];
        $data = [
            "column" => [
                "Nome",
                "Cognome",
                "Età"
            ],
            "data" => [
                [
                    "Mattia",
                    "Bonzi",
                    "21"
                ],
                [
                    "Francesco",
                    "Turro",
                    21
                ],
                [
                    "Alessandro",
                    "Cittarelli",
                    "35"
                ]
            ]
        ];
        $doc = $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Excel_" . "testgenerateFromArrayWithColoumnWithOffset_" . $doc->getName()));
    }

    public function testgenerateFromArrayWithoutColoumnWithOffset()
    {
        $options = [
            "mod" => "array",
            "doc" => [
                "headerStartColumn" => "B",
                "headerStartRow" => 3,
                "dataStartColumn" => "B"
            ]
        ];
        $data = [
            [
                [
                    "Nome" => "Mattia",
                    "Cognome" => "Bonzi",
                    "Età" => "21"
                ],
                [
                    "Nome" => "Francesco",
                    "Cognome" => "Turro",
                    "Età" => 21
                ],
                [
                    "Nome" => "Alessandro",
                    "Cognome" => "Cittarelli",
                    "Età" => "35"
                ]
            ]
        ];
        $doc = $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Excel_" . "testgenerateFromArrayWithoutColoumnWithOffset_" . $doc->getName()));
    }

    public function testgenerateFromArrayWithColoumnWithTemplate()
    {
        $options = [
            "mod" => "array",
            "doc" => [
                "template" => "templateTest.xlsx"
            ]
        ];
        $data = [
            "column" => [
                "Nome",
                "Cognome",
                "Età"
            ],
            "data" => [
                [
                    "Mattia",
                    "Bonzi",
                    "21"
                ],
                [
                    "Francesco",
                    "Turro",
                    21
                ],
                [
                    "Alessandro",
                    "Cittarelli",
                    "35"
                ]
            ]
        ];
        $doc = $this->documentor->generate($data, "xlsx", $options);
        $this->assertFileExists($doc->saveAs($this->TEST_OUT, "Excel_" . "testgenerateFromArrayWithColoumnWithTemplate_" . $doc->getName()));
    }
}