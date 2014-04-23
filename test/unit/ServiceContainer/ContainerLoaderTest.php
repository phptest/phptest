<?php
namespace PhpTest\ServiceContainer;

use Exception;
use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class ContainerLoaderTest extends TestCase
{
    public function setup()
    {
        $this->container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $this->manager = Mockery::mock('PhpTest\ServiceContainer\ExtensionManager');

        $this->extensionA = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
        $this->extensionB = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
        $this->extensionC = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
        $this->extensions = [$this->extensionA, $this->extensionB, $this->extensionC];

        $this->loader = new ContainerLoader($this->manager);
    }

    public function dataLoadRecursivelyInitializesExtensions()
    {
        return array_map(function ($n) {
            return [$n];
        }, range(0, 99));
    }

    public function testLoad()
    {
        $this->container->shouldReceive('addCompilerPass')->times(3)->with(Mockery::type('PhpTest\ServiceContainer\Compiler\ExtensionCompilerPass'));

        // 3 times, +1 to check we're done initializing
        $this->manager->shouldReceive('getExtensions')->times(4)->withNoArgs()->andReturn($this->extensions);

        foreach ($this->extensions as $extension) {
            $extension->shouldReceive('init')->once()->with($this->manager);
            $extension->shouldReceive('load')->once()->with($this->container);
        }

        $this->loader->load($this->container);
    }

    /**
     * @dataProvider dataLoadRecursivelyInitializesExtensions
     */
    public function testLoadRecursivelyInitializesExtensions($depth)
    {
        $extensions = $this->extensions;

        $this->container->shouldReceive('addCompilerPass')->times(count($extensions) + $depth)->with(Mockery::type('PhpTest\ServiceContainer\Compiler\ExtensionCompilerPass'));
        $this->manager->shouldReceive('getExtensions')->times($depth + 4)->withNoArgs()->andReturnUsing(function () use (&$extensions, $depth) {
            $out = $extensions;
            if (count($extensions) - count($this->extensions) < $depth) {
                $extension = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
                $extension->shouldReceive('init')->once()->with($this->manager);
                $extension->shouldReceive('load')->once()->with($this->container);
                $extensions[] = $extension;
            }
            return $out;
        });

        foreach ($this->extensions as $extension) {
            $extension->shouldReceive('init')->once()->with($this->manager);
            $extension->shouldReceive('load')->once()->with($this->container);
        }

        $this->loader->load($this->container);
    }

    public function testLoadThrowsWhenInitializeRecursToDeeply()
    {
        $extensions = $this->extensions;
        foreach ($extensions as $extension) {
            $extension->shouldReceive('init')->once()->with($this->manager);
        }

        $this->manager->shouldReceive('getExtensions')->once()->withNoArgs()->andReturn($extensions);

        for ($i=0; $i<100; $i++) {
            $extension = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
            $extension->shouldReceive('init')->times(99 === $i ? 0 : 1)->with($this->manager);
            $extensions[] = $extension;

            $this->manager->shouldReceive('getExtensions')->once()->withNoArgs()->andReturn($extensions);
        }

        try {
            $this->loader->load($this->container);
            $this->fail('Failed to throw OverflowException');
        } catch (Exception $e) {
            $this->assertInstanceOf('OverflowException', $e);
        }
    }
}
