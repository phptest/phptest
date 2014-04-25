<?php
namespace PhpTest\Cli;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class CommandTest extends TestCase
{
    public function setUp()
    {
        $this->controllerA = $a = Mockery::mock('PhpTest\Cli\ControllerInterface');
        $this->controllerB = $b = Mockery::mock('PhpTest\Cli\ControllerInterface');
        $this->controllerC = $c = Mockery::mock('PhpTest\Cli\ControllerInterface');
        $this->controllers = [$a, $b, $c];
    }

    public function testInterface()
    {
        $command = new Command('foo', []);

        $this->assertInstanceOf('Symfony\Component\Console\Command\Command', $command);
    }

    public function testGetName()
    {
        $command = new Command('foo', []);

        $this->assertEquals('foo', $command->getName());
    }

    public function testConfigure()
    {
        foreach ($this->controllers as $controller) {
            $controller->shouldReceive('configure')->once()->with(Mockery::type('PhpTest\Cli\Command'));
        }

        $command = new Command('foo', $this->controllers);
    }

    public function testExecute()
    {
        $input = Mockery::mock('Symfony\Component\Console\Input\InputInterface');
        $output = Mockery::mock('Symfony\Component\Console\Output\OutputInterface');

        $input->shouldReceive('bind')->once()->with(Mockery::type('Symfony\Component\Console\Input\InputDefinition'));
        $input->shouldReceive('isInteractive')->once()->withNoArgs()->andReturn(false);
        $input->shouldReceive('validate')->once()->withNoArgs();

        foreach ($this->controllers as $controller) {
            $controller->shouldReceive('configure')->once()->with(Mockery::type('PhpTest\Cli\Command'));
            $controller->shouldReceive('execute')->once()->with($input, $output);
        }

        $command = new Command('foo', $this->controllers);
        $command->run($input, $output);
    }
}
