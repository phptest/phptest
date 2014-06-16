<?php
namespace PhpTest\Result\Handler;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class ConsoleOutputHandlerTest extends TestCase
{
    public function setUp()
    {
        $this->formatter = Mockery::mock('PhpTest\Result\Formatter\FormatterInterface');
        $this->output = Mockery::mock('Symfony\Component\Console\Output\ConsoleOutputInterface');

        $this->handler = new ConsoleOutputHandler($this->output, $this->formatter);
    }

    public function testInterface()
    {
        $this->assertInstanceOf('PhpTest\Result\Handler\HandlerInterface', $this->handler);
    }

    public function testHandleFail()
    {
        $result = Mockery::mock('PhpTest\Result\FailResult');

        $this->formatter->shouldReceive('formatFail')->once()->with($result)->andReturn('foo');
        $this->output->shouldReceive('write')->once()->with('<fail>foo</fail>');

        $this->handler->handleFail($result);
    }

    public function testHandlePass()
    {
        $result = Mockery::mock('PhpTest\Result\PassResult');

        $this->formatter->shouldReceive('formatPass')->once()->with($result)->andReturn('foo');
        $this->output->shouldReceive('write')->once()->with('<pass>foo</pass>');

        $this->handler->handlePass($result);
    }
}
