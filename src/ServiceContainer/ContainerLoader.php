<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\ServiceContainer;

use OverflowException;
use PhpTest\ServiceContainer\Compiler\ExtensionCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContainerLoader
{
    /**
     * @var ContainerHelper
     */
    protected $helper;

    /**
     * @var ExtensionManager
     */
    protected $manager;

    /**
     * @param ExtensionManager $manager
     * @param ContainerHelper $helper
     */
    public function __construct(ExtensionManager $manager, ContainerHelper $helper = null)
    {
        $this->manager = $manager;
        $this->helper = $helper ?: new ContainerHelper();
    }

    /**
     * @param ContainerBuilder $container
     * @param ContainerHelper $helper
     * @return ContainerBuilder
     */
    public function load(ContainerBuilder $container)
    {
        $this->initExtensions();
        $this->registerCompilerPasses($container);
        $this->loadExtensions($container);

        return $container;
    }

    /**
     * @throws OverflowException If adding extensions recurs more than 100 levels
     */
    protected function initExtensions()
    {
        $initialized = [];
        $depth = 0;

        while (($exts = $this->manager->getExtensions()) !== $initialized) {
            if (100 < ++$depth) {
                throw new OverflowException('Can\'t initialize extensions more than 100 levels deep.');
            }

            foreach ($exts as $extension) {
                if (!in_array($extension, $initialized, true)) {
                    $extension->init($this->manager);
                    $initialized[] = $extension;
                }
            }
        }
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function loadExtensions(ContainerBuilder $container)
    {
        foreach ($this->manager->getExtensions() as $extension) {
            $extension->load($container);
        }
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function registerCompilerPasses(ContainerBuilder $container)
    {
        foreach ($this->manager->getExtensions() as $extension) {
            $pass = new ExtensionCompilerPass($extension, $this->helper);
            $container->addCompilerPass($pass);
        }
    }
}
