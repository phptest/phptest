<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Cli\ServiceContainer;

use PhpTest\ServiceContainer\AbstractExtension;
use PhpTest\ServiceContainer\ContainerHelper;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CliExtension extends AbstractExtension
{
    const ID_COMMAND     = 'cli.command';
    const ID_INPUT       = 'cli.input';
    const ID_OUTPUT      = 'cli.output';
    const ID_OUTPUT_FORMATTER = 'cli.output.formatter';
    const ID_OUTPUT_FORMATTER_FAIL = 'cli.output.formatter.fail';
    const ID_OUTPUT_FORMATTER_PASS = 'cli.output.formatter.pass';
    const TAG_CONTROLLER = 'cli.controller';

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function load(ContainerBuilder $container)
    {
        $this->loadCommand($container);
        $this->loadInput($container);
        $this->loadOutput($container);
        $this->loadOutputFormatter($container);
    }

    public function process(ContainerBuilder $container, ContainerHelper $helper)
    {
        $this->processControllers($container, $helper);
    }

    protected function loadCommand(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_COMMAND, 'PhpTest\Cli\Command');
        $def->setArguments([$this->name, []]);
    }

    protected function loadInput(ContainerBuilder $container)
    {
        $container->register(self::ID_INPUT, 'Symfony\Component\Console\Input\ArgvInput');
    }

    protected function loadOutput(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_OUTPUT, 'Symfony\Component\Console\Output\ConsoleOutput');
        $def->addMethodCall('setFormatter', [new Reference(self::ID_OUTPUT_FORMATTER)]);
    }

    protected function loadOutputFormatter(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_OUTPUT_FORMATTER, 'Symfony\Component\Console\Formatter\OutputFormatter');
        $def->setPublic(false);
        $def->setArguments([true, [
            'fail' => new Reference(self::ID_OUTPUT_FORMATTER_FAIL),
            'pass' => new Reference(self::ID_OUTPUT_FORMATTER_PASS)
        ]]);

        $def = $container->register(self::ID_OUTPUT_FORMATTER_FAIL, 'Symfony\Component\Console\Formatter\OutputFormatterStyle');
        $def->setArguments(['red', null, []]);

        $def = $container->register(self::ID_OUTPUT_FORMATTER_PASS, 'Symfony\Component\Console\Formatter\OutputFormatterStyle');
        $def->setArguments(['green', null, []]);
    }

    protected function processControllers(ContainerBuilder $container, ContainerHelper $helper)
    {
        $refs = $helper->findAndSortTaggedServices($container, self::TAG_CONTROLLER);
        $container->getDefinition(self::ID_COMMAND)->replaceArgument(1, $refs);
    }
}
