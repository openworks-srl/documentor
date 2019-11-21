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

class BaseTestCase extends TestCase
{

    protected $documentor;

    protected $TEST_OUT;

    public function __construct()
    {
        $this->documentor = new Documentor(__DIR__ . "/TestConfig.php");
        $this->TEST_OUT = sys_get_temp_dir() . "/documentorTestOutput/";
        if (! file_exists($this->TEST_OUT)) {
            mkdir($this->TEST_OUT);
        }
    }
}

