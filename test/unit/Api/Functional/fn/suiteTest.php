<?php
namespace PhpTest\Api\Functional\fn;

use Mockery;
use PhpTest\SuiteInterface;
use PHPUnit_Framework_TestCase as TestCase;

class suiteTest extends TestCase
{
    public function setUp()
    {
        $this->called = false;
        $this->parent = Mockery::mock('PhpTest\SuiteInterface');
    }

    public function bar()
    {
        $this->called = true;
    }

    public function testAddClosure()
    {
        $name = 'foo';
        $fn = function () {
            $this->called = true;
        };

        $this->parent->shouldReceive('add')->once()->with(Mockery::on(function ($suite) use ($name) {
            $assertInterface = $suite instanceof SuiteInterface;
            $assertName = $name === $suite->getName();
            return $assertInterface && $assertName;
        }));

        \PhpTest\Api\Functional\fn\_suite($this->parent, $name, $fn);

        $this->assertTrue($this->called);
    }

    public function testAddCallableArray()
    {
        $name = 'foo';
        $fn = [$this, 'bar'];

        $this->parent->shouldReceive('add')->once()->with(Mockery::on(function ($suite) use ($name) {
            $assertInterface = $suite instanceof SuiteInterface;
            $assertName = $name === $suite->getName();
            return $assertInterface && $assertName;
        }));

        \PhpTest\Api\Functional\fn\_suite($this->parent, $name, $fn);

        $this->assertTrue($this->called);
    }
}
