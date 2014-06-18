<?php
namespace PhpTest\Suite\Cli;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class SuiteControllerTest extends TestCase
{
    public function setUp()
    {
        $this->suite = Mockery::mock('PhpTest\SuiteInterface');
        $this->handler = Mockery::mock('PhpTest\Result\Handler\HandlerInterface');

        $this->controller = new SuiteController($this->suite, $this->handler);
    }

    public function testInterface()
    {
        $this->assertInstanceOf('PhpTest\Cli\ControllerInterface', $this->controller);
    }

    public function testConfigure()
    {
        $command = Mockery::mock('Symfony\Component\Console\Command\Command');

        $this->controller->configure($command);
    }

    public function testExecute()
    {
        $input = Mockery::mock('Symfony\Component\Console\Input\InputInterface');
        $output = Mockery::mock('Symfony\Component\Console\Output\OutputInterface');

        $this->suite->shouldReceive('execute')->once()->with($this->handler);

        $this->controller->execute($input, $output);
    }
}
