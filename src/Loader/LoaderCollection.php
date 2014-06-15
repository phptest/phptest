<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Loader;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class LoaderCollection implements Countable, IteratorAggregate
{
    /**
     * @var LoaderInterface[]
     */
    protected $loaders;

    /**
     * @param LoaderInterface[] $loaders
     */
    public function __construct(array $loaders = [])
    {
        foreach ($loaders as $loader) {
            $this->add($loader);
        }
    }

    /**
     * @param LoaderInterface $loader
     */
    public function add(LoaderInterface $loader)
    {
        $this->loaders[] = $loader;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->loaders);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->loaders);
    }
}
