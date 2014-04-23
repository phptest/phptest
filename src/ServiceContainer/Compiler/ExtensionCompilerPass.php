<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\ServiceContainer\Compiler;

use PhpTest\ServiceContainer\ContainerHelper;
use PhpTest\ServiceContainer\ExtensionInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ExtensionCompilerPass implements CompilerPassInterface
{
    /**
     * @var ExtensionInterface
     */
    protected $extension;

    /**
     * @var ContainerHelper
     */
    protected $helper;

    /**
     * @param ExtensionInterface $extension
     * @param ContainerHelper $helper
     */
    public function __construct(ExtensionInterface $extension, ContainerHelper $helper)
    {
        $this->helper = $helper;
        $this->extension = $extension;
    }

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $this->extension->process($container, $this->helper);
    }
}
