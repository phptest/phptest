<?php
namespace PhpTest\Loader;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class LoaderCollectionTest extends TestCase
{
    public function testInterface()
    {
        $collection = new LoaderCollection();

        $this->assertInstanceOf('Countable', $collection);
        $this->assertInstanceOf('Traversable', $collection);
    }

    public function testConstructor()
    {
        $loader = Mockery::mock('PhpTest\Loader\LoaderInterface');

        $collection = new LoaderCollection([$loader]);

        foreach ($collection as $_loader) {
            $this->assertSame($loader, $_loader);
        }
    }

    public function testAdd()
    {
        $loader = Mockery::mock('PhpTest\Loader\LoaderInterface');

        $collection = new LoaderCollection();
        $collection->add($loader);

        foreach ($collection as $_loader) {
            $this->assertSame($loader, $_loader);
        }
    }
}
