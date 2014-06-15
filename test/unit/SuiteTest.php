<?php
namespace PhpTest;

use Exception;
use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class SuiteTest extends TestCase
{
    public function setUp()
    {
        $this->handler = Mockery::mock('PhpTest\Result\Handler\HandlerInterface');
        $this->testA = $a = Mockery::mock('PhpTest\TestInterface');
        $this->testB = $b = Mockery::mock('PhpTest\TestInterface');
        $this->testC = $c = Mockery::mock('PhpTest\TestInterface');
        $this->tests = [$a, $b, $c];
    }

    public function testInterface()
    {
        $suite = new Suite('');

        $this->assertInstanceOf('PhpTest\SuiteInterface', $suite);
        $this->assertInstanceOf('PhpTest\TestInterface', $suite);
    }

    public function testGetName()
    {
        $suite = new Suite('foo');

        $this->assertEquals('foo', $suite->getName());
    }

    public function testExecuteConstructorTests()
    {
        $suite = new Suite('', $this->tests);

        foreach ($this->tests as $test) {
            $test->shouldReceive('execute')->once()->with($this->handler);
        }

        $suite->execute($this->handler);
    }

    public function testExecuteAddedTests()
    {
        $suite = new Suite('');

        foreach ($this->tests as $test) {
            $suite->add($test);
            $test->shouldReceive('execute')->once()->with($this->handler);
        }

        $suite->execute($this->handler);
    }

    public function testExecute()
    {
        $suite = new Suite('', [$this->testA, $this->testB]);
        $suite->add($this->testC);

        foreach ($this->tests as $test) {
            $test->shouldReceive('execute')->once()->with($this->handler);
        }

        $suite->execute($this->handler);
    }

    public function testExecuteOnlyExecutesEachTestOnce()
    {
        $suite = new Suite('');

        foreach ($this->tests as $test) {
            $suite->add($test);
            $suite->add($test);
            $suite->add($test);
            $test->shouldReceive('execute')->once()->with($this->handler);
        }

        $suite->execute($this->handler);
    }
}
