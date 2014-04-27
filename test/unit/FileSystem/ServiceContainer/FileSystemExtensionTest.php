<?php
namespace PhpTest\FileSystem\ServiceContainer;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;
use Symfony\Component\DependencyInjection\Definition;

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

        $container->shouldReceive('setDefinition')->once()->with('fs.controller', Mockery::on(function (Definition $def) {
            $arguments = $def->getArguments();
            $firstArg = reset($arguments);
            $locatorRef = (string) $firstArg === 'fs.locator';
            $className = $def->getClass() === 'PhpTest\FileSystem\Cli\FileSystemController';

            return $className && $locatorRef;
        }));

        $container->shouldReceive('setDefinition')->once()->with('fs.locator', Mockery::on(function (Definition $def) {
            return $def->getClass() === 'PhpTest\FileSystem\FileLocator';
        }));

        $this->extension->load($container);
    }

    public function testProcess()
    {
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $helper = Mockery::mock('PhpTest\ServiceContainer\ContainerHelper');

        $this->extension->process($container, $helper);
    }
}
