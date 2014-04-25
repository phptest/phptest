<?php
namespace PhpTest\Cli\ServiceContainer;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;
use Symfony\Component\DependencyInjection\Definition;

class CliExtensionTest extends TestCase
{
    public function setUp()
    {
        $this->commandName = 'foo';
        $this->extension = new CliExtension($this->commandName);
    }

    public function testInit()
    {
        $manager = Mockery::mock('PhpTest\ServiceContainer\ExtensionManager');

        $this->extension->init($manager);
    }

    public function testLoad()
    {
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder');

        $container->shouldReceive('setDefinition')->once()->with('cli.command', Mockery::on(function (Definition $def) {
            $arguments = $def->getArguments() === [$this->commandName, []];
            $className = $def->getClass() === 'PhpTest\Cli\Command';
            return $arguments && $className;
        }));

        $container->shouldReceive('setDefinition')->once()->with('cli.input', Mockery::on(function (Definition $def) {
            return $def->getClass() === 'Symfony\Component\Console\Input\ArgvInput';
        }));

        $container->shouldReceive('setDefinition')->once()->with('cli.output', Mockery::on(function (Definition $def) {
            return $def->getClass() === 'Symfony\Component\Console\Output\ConsoleOutput';
        }));

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
        $commandDefinition->shouldReceive('replaceArgument')->once()->with(1, $references);

        $this->extension->process($container, $helper);
    }
}
