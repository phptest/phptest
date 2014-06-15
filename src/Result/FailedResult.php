<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Result;

use Exception;
use PhpTest\TestInterface;

class FailedResult implements ResultInterface
{
    /**
     * @var Exception
     */
    protected $exception;

    /**
     * @var TestInterface
     */
    protected $test;

    /**
     * @param Exception $exception
     * @param TestInterface $test
     */
    public function __construct(Exception $exception, TestInterface $test)
    {
        $this->exception = $exception;
        $this->test = $test;
    }

    /**
     * @return Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return TestInterface
     */
    public function getTest()
    {
        return $this->test;
    }
}
