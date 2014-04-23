<?php
namespace PhpTest\ServiceContainer\Compiler;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class ExtensionCompilerPassTest extends TestCase
{
    public function setup()
    {
        $this->container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $this->extension = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');

        $this->pass = new ExtensionCompilerPass($this->extension);
    }

    public function testLoad()
    {
        $this->extension->shouldReceive('process')->once()->with($this->container);

        $this->pass->process($this->container);
    }
}
