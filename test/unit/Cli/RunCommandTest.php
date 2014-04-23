<?php
namespace PhpTest\Cli;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class RunCommandTest extends TestCase
{
    public function setUp()
    {
        $this->controllerA = $a = Mockery::mock('PhpTest\Cli\ControllerInterface');
        $this->controllerB = $b = Mockery::mock('PhpTest\Cli\ControllerInterface');
        $this->controllerC = $c = Mockery::mock('PhpTest\Cli\ControllerInterface');
        $this->controllers = [$a, $b, $c];
    }

    public function testGetName()
    {
        $command = new RunCommand([]);

        $this->assertEquals('phptest', $command->getName());
    }

    public function testConfigure()
    {
        foreach ($this->controllers as $controller) {
            $controller->shouldReceive('configure')->once()->with(Mockery::type('PhpTest\Cli\RunCommand'));
        }

        $command = new RunCommand($this->controllers);
    }

    public function testExecute()
    {
        $input = Mockery::mock('Symfony\Component\Console\Input\InputInterface');
        $output = Mockery::mock('Symfony\Component\Console\Output\OutputInterface');

        $input->shouldReceive('bind')->once()->with(Mockery::type('Symfony\Component\Console\Input\InputDefinition'));
        $input->shouldReceive('isInteractive')->once()->withNoArgs()->andReturn(false);
        $input->shouldReceive('validate')->once()->withNoArgs();

        foreach ($this->controllers as $controller) {
            $controller->shouldReceive('configure')->once()->with(Mockery::type('PhpTest\Cli\RunCommand'));
            $controller->shouldReceive('execute')->once()->with($input, $output);
        }

        $command = new RunCommand($this->controllers);
        $command->run($input, $output);
    }
}
