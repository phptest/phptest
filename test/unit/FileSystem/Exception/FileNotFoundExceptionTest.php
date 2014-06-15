<?php
namespace PhpTest\FileSystem\Exception;

use Exception;
use PHPUnit_Framework_TestCase as TestCase;

class FileNotFoundExceptionTest extends TestCase
{
    public function testInterface()
    {
        $exception = new FileNotFoundException('');

        $this->assertInstanceOf('PhpTest\Exception\ExceptionInterface', $exception);
    }

    public function testParent()
    {
        $exception = new FileNotFoundException('');

        $this->assertInstanceOf('RuntimeException', $exception);
    }

    public function testGetCode()
    {
        $exception = new FileNotFoundException('foo', 100);

        $this->assertEquals(100, $exception->getCode());
    }

    public function testGetMessage()
    {
        $exception = new FileNotFoundException('/path/to/nowhere');

        $this->assertRegExp("/\"\/path\/to\/nowhere\"/", $exception->getMessage());
    }

    public function testGetPrevious()
    {
        $previous = new Exception();
        $exception = new FileNotFoundException('foo', 100, $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testGetPath()
    {
        $exception = new FileNotFoundException('foo');

        $this->assertEquals('foo', $exception->getPath());
    }
}
