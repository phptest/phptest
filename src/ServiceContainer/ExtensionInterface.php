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

use Symfony\Component\DependencyInjection\ContainerBuilder;

interface ExtensionInterface
{
    /**
     * Initialize the extension
     *
     * Prepares the extension for loading. This method is called before any
     * extensions have been loaded and can be used to add an extension or check
     * another extension exists.
     *
     * @param ExtensionManager $manager
     */
    public function init(ExtensionManager $manager);

    /**
     * Load the extension
     *
     * This method is used to load extension services into the container.
     *
     * @param ContainerBuilder $container
     */
    public function load(ContainerBuilder $container);

    /**
     * Post processing of the container
     *
     * This method is called after all extensions have been loaded. It offers a
     * final opportunity to check over the container and check services. Typical
     * use cases include setting tagged services and validating services exist.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container);
}
