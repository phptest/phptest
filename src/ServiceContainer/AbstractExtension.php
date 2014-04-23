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

abstract class AbstractExtension implements ExtensionInterface
{
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
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
    }
}
