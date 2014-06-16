<?php
namespace PhpTest\Api\Functional;

use ArrayIterator;
use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class FunctionalApiTest extends TestCase
{
    public function setUp()
    {
        $this->collection = Mockery::mock('PhpTest\Loader\LoaderCollection');
        $this->handler = Mockery::mock('PhpTest\Result\Handler\HandlerInterface');
        $this->loader = Mockery::mock('PhpTest\Loader\LoaderInterface');
        $this->registry = Mockery::mock('PhpTest\Api\Functional\SuiteRegistry');

        $this->api = new FunctionalApi($this->registry, false);
    }

    public function testExecute()
    {
        $this->loader->shouldReceive('load')->once()->withNoArgs();
        $this->collection->shouldReceive('getIterator')->once()->withNoArgs()->andReturn(new ArrayIterator([$this->loader]));
        $this->registry->shouldReceive('setCurrentSuite')->once()->with(Mockery::type('PhpTest\SuiteInterface'));

        $this->api->execute($this->collection, $this->handler);
    }
}
