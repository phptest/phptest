<?php
namespace PhpTest\FileSystem\ServiceContainer;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class FileSystemExtensionTest extends TestCase
{
    public function setUp()
    {
        $this->extension = new FileSystemExtension();
    }

    public function testInit()
    {
        $manager = Mockery::mock('PhpTest\ServiceContainer\ExtensionManager');

        $this->extension->init($manager);
    }

    public function testLoad()
    {
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder');

        $definition = Mockery::type('Symfony\Component\DependencyInjection\Definition');
        $container->shouldReceive('setDefinition')->once()->with('fs.controller', $definition);

        $this->extension->load($container);
    }

    public function testProcess()
    {
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $helper = Mockery::mock('PhpTest\ServiceContainer\ContainerHelper');

        $this->extension->process($container, $helper);
    }
}
