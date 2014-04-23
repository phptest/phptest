<?php
namespace PhpTest\ServiceContainer;

use Mockery;
use PHPUnit_Framework_TestCase as TestCase;

class ContainerHelperTest extends TestCase
{
    public function setup()
    {
        $this->container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder');

        $this->helper = new ContainerHelper();
    }

    public function dataFindAndSortTaggedServices()
    {
        return [
            [
                'foo',
                ['foo' => [[]], 'bar' => [['priority' => 0]], 'baz' => [['priority' => 255]], 'bam' => [['priority' => -255]]],
                ['baz', 'foo', 'bar', 'bam']
            ],
            [
                'bar',
                ['foo' => [[]], 'bar' => [['order' => 0]], 'baz' => [['order' => 255]], 'bam' => [['order' => -255]]],
                ['foo', 'bar', 'baz', 'bam']
            ]
        ];
    }

    /**
     * @dataProvider dataFindAndSortTaggedServices
     */
    public function testFindAndSortTaggedServices($tag, $services, $expected)
    {
        $this->container->shouldReceive('findTaggedServiceIds')->once()->with($tag)->andReturn($services);

        $ref = $this->helper->findAndSortTaggedServices($this->container, $tag);
        $ids = array_map(function ($r) { return (string) $r; }, $ref);

        $this->assertEquals($expected, $ids);
    }
}
