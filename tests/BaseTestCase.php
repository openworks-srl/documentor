<?php
/*
 * This file is part of the openworks-srl/documentor package.
 *
 * (c) Openworks srl <www.openworks.it>
 *
 * For the full license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Documentor;

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

