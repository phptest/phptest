<?php
namespace PhpTest\Cli;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class ApplicationTest extends TestCase
{
    public function setUp()
    {
        $this->name = 'foo';
        $this->version = 'bar';
        $this->definition = Mockery::mock('Symfony\Component\Console\Input\InputDefinition');
        $this->command = Mockery::mock('Symfony\Component\Console\Command\Command');
        $this->input = Mockery::mock('Symfony\Component\Console\Input\InputInterface');
        $this->output = Mockery::mock('Symfony\Component\Console\Output\OutputInterface');

        $this->application = new Application(
            $this->name,
            $this->version,
            $this->definition,
            $this->command,
            $this->input,
            $this->output
        );
    }

    public function testInterface()
    {
        $this->assertInstanceOf('Symfony\Component\Console\Application', $this->application);
    }

    public function testGetDefaultInputDefinition()
    {
        $this->assertEquals($this->definition, $this->application->getDefaultInputDefinition());
    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->application->getName());
    }

    public function testGetVersion()
    {
        $this->assertEquals($this->version, $this->application->getVersion());
    }
}
