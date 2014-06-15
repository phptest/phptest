<?php
namespace PhpTest\Result;

use Exception;
use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class FailedResultTest extends TestCase
{
    public function setUp()
    {
        $this->exception = new Exception('');
        $this->test = Mockery::mock('PhpTest\TestInterface');
    }

    public function testInterface()
    {
        $result = new FailedResult($this->exception, $this->test);

        $this->assertInstanceOf('PhpTest\Result\ResultInterface', $result);
    }

    public function testGetException()
    {
        $result = new FailedResult($this->exception, $this->test);

        $this->assertSame($this->exception, $result->getException());
    }

    public function testGetTest()
    {
        $result = new FailedResult($this->exception, $this->test);

        $this->assertSame($this->test, $result->getTest());
    }
}
