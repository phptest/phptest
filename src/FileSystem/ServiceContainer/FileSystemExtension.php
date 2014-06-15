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
use Symfony\Component\DependencyInjection\Reference;

class FileSystemExtension extends AbstractExtension
{
    const ID_CONTROLLER = 'fs.controller';
    const ID_LOCATOR = 'fs.locator';

    public function load(ContainerBuilder $container)
    {
        $this->loadController($container);
        $this->loadFileLocator($container);
    }

    protected function loadController(ContainerBuilder $container)
    {
        $def = $container-register(self::ID_CONTROLLER, 'PhpTest\FileSystem\Cli\FileSystemController');
        $def->setArguments([new Reference(self::ID_LOCATOR)]);
        $def->addTag(CliExtension::TAG_CONTROLLER);
    }

    protected function loadFileLocator(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_LOCATOR, 'PhpTest\FileSystem\FileLocator');
        $def->setArguments([getcwd()]);
    }
}
