<?php
namespace PhpTest\Result\Formatter;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class DotFormatterTest extends TestCase
{
    public function testInterface()
    {
        $formatter = new DotFormatter();

        $this->assertInstanceOf('PhpTest\Result\Formatter\FormatterInterface', $formatter);
    }

    public function testFormatFail()
    {
        $formatter = new DotFormatter();
        $result = Mockery::mock('PhpTest\Result\FailResult');

        $this->assertEquals('F', $formatter->formatFail($result));
    }

    public function testFormatPass()
    {
        $formatter = new DotFormatter();
        $result = Mockery::mock('PhpTest\Result\PassResult');

        $this->assertEquals('.', $formatter->formatPass($result));
    }
}
