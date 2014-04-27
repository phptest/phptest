<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\FileSystem\ServiceContainer;

use PhpTest\Cli\ServiceContainer\CliExtension;
use PhpTest\ServiceContainer\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class FileSystemExtension extends AbstractExtension
{
    const ID_CONTROLLER = 'fs.controller';
    const ID_LOCATOR = 'fs.locator';

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container)
    {
        $this->loadController($container);
        $this->loadFileLocator($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function loadController(ContainerBuilder $container)
    {
        $locator = new Reference(self::ID_LOCATOR);

        $def = new Definition('PhpTest\FileSystem\Cli\FileSystemController', [$locator]);
        $def->addTag(CliExtension::TAG_CONTROLLER);

        $container->setDefinition(self::ID_CONTROLLER, $def);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function loadFileLocator(ContainerBuilder $container)
    {
        $def = new Definition('PhpTest\FileSystem\FileLocator', [getcwd()]);
        $container->setDefinition(self::ID_LOCATOR, $def);
    }
}
