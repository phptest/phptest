<?php
namespace PhpTest\Cli\ServiceContainer;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class CliExtensionTest extends TestCase
{
    public function setUp()
    {
        $this->extension = new CliExtension();
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
        $container->shouldReceive('setDefinition')->once()->with('cli.command', $definition);
        $container->shouldReceive('setDefinition')->once()->with('cli.controller', $definition);
        $container->shouldReceive('setDefinition')->once()->with('cli.input', $definition);
        $container->shouldReceive('setDefinition')->once()->with('cli.output', $definition);

        $this->extension->load($container);
    }

    public function testProcess()
    {
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $helper = Mockery::mock('PhpTest\ServiceContainer\ContainerHelper');
        $commandDefinition = Mockery::mock('Symfony\Component\DependencyInjection\Definition');
        $references = ['foo' => 'bar'];

        $helper->shouldReceive('findAndSortTaggedServices')->once()->with($container, 'cli.controller')->andReturn($references);
        $container->shouldReceive('getDefinition')->once()->with('cli.command')->andReturn($commandDefinition);
        $commandDefinition->shouldReceive('replaceArgument')->once()->with(0, $references);

        $this->extension->process($container, $helper);
    }
}
