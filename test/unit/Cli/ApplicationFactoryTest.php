<?php
namespace PhpTest\Cli;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class ApplicationFactoryTest extends TestCase
{
    public function testBuild()
    {
        $factory = new ApplicationFactory();

        $this->assertInstanceOf('PhpTest\Cli\Application', $factory->build());
    }

    public function testGetName()
    {
        $factory = new ApplicationFactory();

        $this->assertEquals('phptest', $factory->getName());
    }

    public function testGetVersion()
    {
        $factory = new ApplicationFactory(['version' => 'foo']);

        $this->assertEquals('foo', $factory->getVersion());
    }

    public function testGetVersionIsZero()
    {
        $factory = new ApplicationFactory();

        $this->assertEquals('0', $factory->getVersion());
    }

    public function testGetInputDefinition()
    {
        $factory = new ApplicationFactory();

        $this->assertInstanceOf('Symfony\Component\Console\Input\InputDefinition', $factory->getInputDefinition());
    }

    public function testGetCommand()
    {
        $command = Mockery::mock('Symfony\Component\Console\Command\Command');
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->shouldReceive('get')->once()->with('cli.command')->andReturn($command);

        $factory = new ApplicationFactory();

        $this->assertSame($command, $factory->getCommand($container));
    }

    public function testGetInput()
    {
        $input = Mockery::mock('Symfony\Component\Console\Input\InputInterface');
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->shouldReceive('get')->once()->with('cli.input')->andReturn($input);

        $factory = new ApplicationFactory();

        $this->assertSame($input, $factory->getInput($container));
    }

    public function testGetOutput()
    {
        $output = Mockery::mock('Symfony\Component\Console\Output\OutputInterface');
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->shouldReceive('get')->once()->with('cli.output')->andReturn($output);

        $factory = new ApplicationFactory();

        $this->assertSame($output, $factory->getOutput($container));
    }
}
