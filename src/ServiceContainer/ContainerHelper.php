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
use Symfony\Component\DependencyInjection\Reference;

/*
 * Parts of this class are based on the Behat Service Container, which is
 * released under the following license:
 *
 *    The MIT License (MIT)
 *
 *    Copyright (c) 2011-2014 Konstantin Kudryashov <ever.zet@gmail.com>
 *
 *    For the full copyright and license information, please view the LICENSE
 *    file that was distributed with this source code.
 *
 * @link https://github.com/Behat/Behat
 */
class ContainerHelper
{
    /**
     * @param ContainerBuilder $container
     * @param string $tag
     * @return Reference[]
     */
    public function findAndSortTaggedServices(ContainerBuilder $container, $tag)
    {
        $services = [];
        $index = PHP_INT_MAX;

        foreach ($container->findTaggedServiceIds($tag) as $id => $tags) {
            $firstTags = reset($tags);
            $priority = isset($firstTags['priority']) ? $firstTags['priority'] : 0;
            $services[] = array_merge(['priority' => $priority], ['index' => $index--], ['id' => $id]);
        }

        // Deterministic sorting
        arsort($services);

        return array_map(function ($tag) {
            return new Reference($tag['id']);
        }, array_values($services));
    }
}
