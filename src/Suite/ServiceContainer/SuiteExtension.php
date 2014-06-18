<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Suite\ServiceContainer;

use PhpTest\Cli\ServiceContainer\CliExtension;
use PhpTest\Result\ServiceContainer\ResultExtension;
use PhpTest\ServiceContainer\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SuiteExtension extends AbstractExtension
{
    const ID_CONTROLLER = 'suite.controller';
    const ID_SUITE = 'suite';

    public function load(ContainerBuilder $container)
    {
        $this->loadController($container);
        $this->loadSuite($container);
    }

    protected function loadController(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_CONTROLLER, 'PhpTest\Suite\Cli\SuiteController');
        $def->addTag(CliExtension::TAG_CONTROLLER);
        $def->setArguments([
            new Reference(self::ID_SUITE),
            new Reference(ResultExtension::ID_HANDLER)
        ]);
    }

    protected function loadSuite(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_SUITE, 'PhpTest\Suite');
        $def->setArguments([uniqid()]);
    }
}
