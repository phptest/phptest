<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api\ServiceContainer;

use PhpTest\Api\Functional\ServiceContainer\FunctionalApiExtension;
use PhpTest\Cli\ServiceContainer\CliExtension;
use PhpTest\Loader\ServiceContainer\LoaderExtension;
use PhpTest\Suite\ServiceContainer\SuiteExtension;
use PhpTest\ServiceContainer\ContainerHelper;
use PhpTest\ServiceContainer\ExtensionInterface;
use PhpTest\ServiceContainer\ExtensionManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ApiExtension implements ExtensionInterface
{
    const ID_CONTROLLER = 'api.controller';
    const ID_MANAGER = 'api.manager';
    const TAG_API = 'api';

    public function init(ExtensionManager $manager)
    {
        $manager->addExtension(new FunctionalApiExtension());
    }

    public function load(ContainerBuilder $container)
    {
        $this->loadController($container);
        $this->loadManager($container);
    }

    public function process(ContainerBuilder $container, ContainerHelper $helper)
    {
        $this->processApis($container, $helper);
    }

    protected function loadController(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_CONTROLLER, 'PhpTest\Api\Cli\ApiController');
        $def->addTag(CliExtension::TAG_CONTROLLER);
        $def->setArguments([
            new Reference(self::ID_MANAGER),
            new Reference(LoaderExtension::ID_COLLECTION),
            new Reference(SuiteExtension::ID_SUITE)
        ]);
    }

    protected function loadManager(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_MANAGER, 'PhpTest\Api\ApiManager');
        $def->setArguments([[]]);
    }

    protected function processApis(ContainerBuilder $container, ContainerHelper $helper)
    {
        $refs = $helper->findNamedTaggedServices($container, self::TAG_API);
        $container->getDefinition(self::ID_MANAGER)->replaceArgument(0, $refs);
    }
}
