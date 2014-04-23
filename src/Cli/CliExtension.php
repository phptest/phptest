<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Cli;

use PhpTest\ServiceContainer\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class CliExtension extends AbstractExtension
{
    const ID_COMMAND = 'cli.command';
    const ID_INPUT   = 'cli.input';
    const ID_OUTPUT  = 'cli.output';

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container)
    {
        $this->loadCommand($container);
        $this->loadIo($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function loadCommand(ContainerBuilder $container)
    {
        $def = new Definition('PhpTest\Cli\RunCommand', [[]]);
        $container->setDefinition(self::ID_COMMAND, $def);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function loadIo(ContainerBuilder $container)
    {
        $in = new Definition('Symfony\Component\Console\Input\ArgvInput');
        $out = new Definition('Symfony\Component\Console\Output\ConsoleOutput');
        $container->setDefinition(self::ID_INPUT, $in);
        $container->setDefinition(self::ID_OUTPUT, $out);
    }
}
