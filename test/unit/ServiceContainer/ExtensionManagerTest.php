<?php
namespace PhpTest\ServiceContainer;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class ExtensionManagerTest extends TestCase
{
    public function setup()
    {
        $this->extensionA = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
        $this->extensionB = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
        $this->extensionC = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
        $this->extensions = [$this->extensionA, $this->extensionB, $this->extensionC];
    }

    public function testConstructor()
    {
        $manager = new ExtensionManager($this->extensions);

        $this->assertEquals($this->extensions, $manager->getExtensions());
    }

    public function testAddExtension()
    {
        $manager = new ExtensionManager();
        $manager->addExtension($this->extensionA);

        $this->assertEquals([$this->extensionA], $manager->getExtensions());
    }

    public function testAddAnotherExtension()
    {
        $extensionD = Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface');
        $manager = new ExtensionManager($this->extensions);
        $manager->addExtension($extensionD);

        $this->assertEquals(array_merge($this->extensions, [$extensionD]), $manager->getExtensions());
    }

    public function testGetOtherExtensions()
    {
        $manager = new ExtensionManager($this->extensions);

        $this->assertEquals([$this->extensionA, $this->extensionC], $manager->getOtherExtensions($this->extensionB));
    }

    public function testGetMissingOtherExtensions()
    {
        $manager = new ExtensionManager($this->extensions);

        $this->assertEquals($this->extensions, $manager->getOtherExtensions(Mockery::mock('PhpTest\ServiceContainer\ExtensionInterface')));
    }
}
