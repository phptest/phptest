<?php
namespace PhpTest\Result;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class PassResultTest extends TestCase
{
    public function setUp()
    {
        $this->test = Mockery::mock('PhpTest\TestInterface');
    }

    public function testInterface()
    {
        $result = new PassResult('', $this->test);

        $this->assertInstanceOf('PhpTest\Result\ResultInterface', $result);
    }

    public function testGetResult()
    {
        $result = new PassResult('foo', $this->test);

        $this->assertEquals('foo', $result->getResult());
    }

    public function testGetTest()
    {
        $result = new PassResult('foo', $this->test);

        $this->assertSame($this->test, $result->getTest());
    }
}
