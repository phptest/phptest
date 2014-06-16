<?php
namespace PhpTest\Api;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class ApiManagerTest extends TestCase
{
    public function testConstructor()
    {
        $api = Mockery::mock('PhpTest\Api\ApiInterface');

        $manager = new ApiManager(['foo' => $api]);

        $this->assertSame($api, $manager->get('foo'));
    }

    public function testAdd()
    {
        $api = Mockery::mock('PhpTest\Api\ApiInterface');

        $manager = new ApiManager();
        $manager->add('foo', $api);

        $this->assertSame($api, $manager->get('foo'));
    }

    public function testGetNames()
    {
        $api = Mockery::mock('PhpTest\Api\ApiInterface');

        $manager = new ApiManager(['foo' => $api]);

        $this->assertSame(['foo'], $manager->getNames());
    }
}
