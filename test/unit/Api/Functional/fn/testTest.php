<?php
namespace PhpTest\Api\Functional\fn;

use Mockery;
use PhpTest\TestInterface;
use PHPUnit_Framework_TestCase as TestCase;

class testTest extends TestCase
{
    public function setUp()
    {
        $this->suite = Mockery::mock('PhpTest\SuiteInterface');
    }

    public function testAddClosure()
    {
        $name = 'foo';
        $fn = function(){};

        $this->suite->shouldReceive('add')->once()->with(Mockery::on(function ($test) use ($name) {
            $assertInterface = $test instanceof TestInterface;
            $assertName = $name === $test->getName();
            return $assertInterface && $assertName;
        }));

        \PhpTest\Api\Functional\fn\_test($this->suite, $name, $fn);
    }

    public function testAddCallableArray()
    {
        $name = 'foo';
        $fn = [Mockery::mock('stdClass'), 'bar'];

        $this->suite->shouldReceive('add')->once()->with(Mockery::on(function ($test) use ($name) {
            $assertInterface = $test instanceof TestInterface;
            $assertName = $name === $test->getName();
            return $assertInterface && $assertName;
        }));

        \PhpTest\Api\Functional\fn\_test($this->suite, $name, $fn);
    }
}
