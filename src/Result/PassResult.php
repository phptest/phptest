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

use PhpTest\TestInterface;

class PassResult implements ResultInterface
{
    /**
     * @var mixed
     */
    protected $result;

    /**
     * @var TestInterface
     */
    protected $test;

    /**
     * @param mixed $result
     * @param TestInterface $test
     */
    public function __construct($result, TestInterface $test)
    {
        $this->result = $result;
        $this->test = $test;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return TestInterface
     */
    public function getTest()
    {
        return $this->test;
    }
}
