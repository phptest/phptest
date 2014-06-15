<?php
namespace PhpTest\ServiceContainer\Exception;

use Exception;
use PHPUnit_Framework_TestCase as TestCase;

class ConflictingTagNameExceptionTest extends TestCase
{
    public function testInterface()
    {
        $exception = new ConflictingTagNameException('');

        $this->assertInstanceOf('PhpTest\Exception\ExceptionInterface', $exception);
    }

    public function testParent()
    {
        $exception = new ConflictingTagNameException('');

        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Exception\LogicException', $exception);
    }

    public function testGetCode()
    {
        $exception = new ConflictingTagNameException('foo', 100);

        $this->assertEquals(100, $exception->getCode());
    }

    public function testGetMessage()
    {
        $exception = new ConflictingTagNameException('foo');

        $this->assertRegExp("/\"foo\"/", $exception->getMessage());
    }

    public function testGetPrevious()
    {
        $previous = new Exception();
        $exception = new ConflictingTagNameException('foo', 100, $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testGetTag()
    {
        $exception = new ConflictingTagNameException('foo');

        $this->assertEquals('foo', $exception->getTag());
    }
}
