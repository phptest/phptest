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
use PhpTest\ServiceContainer\ContainerHelper;
use PhpTest\ServiceContainer\ExtensionManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class CliExtension extends AbstractExtension
{
    const ID_COMMAND = 'cli.command';

    /**
     * {@inheritdoc}
     */
    public function init(ExtensionManager $manager)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container)
    {
        $this->loadCommand($container);
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container, ContainerHelper $helper)
    {
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function loadCommand(ContainerBuilder $container)
    {
        $def = new Definition('PhpTest\Cli\RunCommand', [[]]);
        $container->setDefinition(self::ID_COMMAND, $def);
    }
}
