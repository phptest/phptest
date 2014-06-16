<?php
namespace PhpTest\Result;

use Exception;
use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class FailResultTest extends TestCase
{
    public function setUp()
    {
        $this->exception = new Exception('');
        $this->test = Mockery::mock('PhpTest\TestInterface');
    }

    public function testInterface()
    {
        $result = new FailResult($this->exception, $this->test);

        $this->assertInstanceOf('PhpTest\Result\ResultInterface', $result);
    }

    public function testGetException()
    {
        $result = new FailResult($this->exception, $this->test);

        $this->assertSame($this->exception, $result->getException());
    }

    public function testGetTest()
    {
        $result = new FailResult($this->exception, $this->test);

        $this->assertSame($this->test, $result->getTest());
    }
}
