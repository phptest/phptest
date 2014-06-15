<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Loader\ServiceContainer;

use PhpTest\ServiceContainer\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LoaderExtension extends AbstractExtension
{
    const ID_COLLECTION = 'loader.collection';

    public function load(ContainerBuilder $container)
    {
        $this->loadCollection($container);
    }

    protected function loadCollection(ContainerBuilder $container)
    {
        $container->register(self::ID_COLLECTION, 'PhpTest\Loader\LoaderCollection');
    }
}
