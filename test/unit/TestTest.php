<?php
namespace PhpTest;

use Exception;
use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class TestTest extends TestCase
{
    public function testInterface()
    {
        $test = new Test('', function(){});

        $this->assertInstanceOf('PhpTest\TestInterface', $test);
        $this->assertInstanceOf('PhpTest\ArgumentBoundInterface', $test);
    }

    public function testGetName()
    {
        $test = new Test('foo', function(){});

        $this->assertEquals('foo', $test->getName());
    }

    public function testGetArguments()
    {
        $test = new Test('', function(){}, ['foo', 'bar']);

        $this->assertEquals(['foo', 'bar'], $test->getArguments());
    }

    public function testExecuteInvokesCallableWithArguments()
    {
        $fn = function ($a, $b) {
            $this->assertEquals('foo', $a);
            $this->assertEquals('bar', $b);
        };

        $test = new Test('', $fn, ['foo', 'bar']);

        $handler = Mockery::mock('PhpTest\Result\Handler\HandlerInterface');
        $handler->shouldReceive('handleSuccess')->once()->with(Mockery::type('PhpTest\Result\ResultInterface'));

        $test->execute($handler);
    }

    public function testExecuteHandlesSuccess()
    {
        $test = new Test('', function(){});

        $handler = Mockery::mock('PhpTest\Result\Handler\HandlerInterface');
        $handler->shouldReceive('handleSuccess')->once()->with(Mockery::type('PhpTest\Result\SuccessfulResult'));

        $test->execute($handler);
    }

    public function testExecuteHandlesFailure()
    {
        $test = new Test('', function () {
            throw new Exception('foo');
        });

        $handler = Mockery::mock('PhpTest\Result\Handler\HandlerInterface');
        $handler->shouldReceive('handleFailure')->once()->with(Mockery::type('PhpTest\Result\FailedResult'));

        $test->execute($handler);
    }
}
