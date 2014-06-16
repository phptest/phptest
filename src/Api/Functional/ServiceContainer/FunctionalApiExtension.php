<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api\Functional\ServiceContainer;

use PhpTest\Api\ServiceContainer\ApiExtension;
use PhpTest\ServiceContainer\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FunctionalApiExtension extends AbstractExtension
{
    const ID_API = 'api.functional';
    const ID_REGISTRY = 'api.functional.suite_registry';

    public function load(ContainerBuilder $container)
    {
        $this->loadApi($container);
        $this->loadRegistry($container);
    }

    protected function loadApi(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_API, 'PhpTest\Api\Functional\FunctionalApi');
        $def->setArguments([new Reference(self::ID_REGISTRY), true]);
        $def->addTag(ApiExtension::TAG_API, ['name' => 'functional']);
        $def->addTag(ApiExtension::TAG_API, ['name' => 'fn']);
    }

    protected function loadRegistry(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_REGISTRY, 'PhpTest\Api\Functional\SuiteRegistry');
        $def->setFactoryClass('PhpTest\Api\Functional\SuiteRegistry');
        $def->setFactoryMethod('getInstance');
    }
}
