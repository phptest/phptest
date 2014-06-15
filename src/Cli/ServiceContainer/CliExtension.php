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

class CliExtension extends AbstractExtension
{
    const ID_COMMAND     = 'cli.command';
    const ID_INPUT       = 'cli.input';
    const ID_OUTPUT      = 'cli.output';
    const TAG_CONTROLLER = 'cli.controller';

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function load(ContainerBuilder $container)
    {
        $this->loadCommand($container);
        $this->loadIo($container);
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

    protected function loadIo(ContainerBuilder $container)
    {
        $container->register(self::ID_INPUT, 'Symfony\Component\Console\Input\ArgvInput');
        $container->register(self::ID_OUTPUT, 'Symfony\Component\Console\Output\ConsoleOutput');
    }

    protected function processControllers(ContainerBuilder $container, ContainerHelper $helper)
    {
        $refs = $helper->findAndSortTaggedServices($container, self::TAG_CONTROLLER);
        $container->getDefinition(self::ID_COMMAND)->replaceArgument(1, $refs);
    }
}
