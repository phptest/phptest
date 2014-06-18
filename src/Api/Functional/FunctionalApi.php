<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api\Functional;

use PhpTest\Api\ApiInterface;
use PhpTest\Loader\LoaderCollection;
use PhpTest\SuiteInterface;

class FunctionalApi implements ApiInterface
{
    /**
     * @var SuiteRegistry
     */
    protected $registry;

    /**
     * @param SuiteRegistry $registry
     * @param boolean $mount
     */
    public function __construct(SuiteRegistry $registry, $mount = true)
    {
        $this->registry = $registry;

        if ($mount) {
            require_once __DIR__ . '/inc/mount.php';
        }
    }

    /**
     * @param LoaderCollection $loaders
     * @param SuiteInterface $suite
     */
    public function load(LoaderCollection $loaders, SuiteInterface $suite)
    {
        $this->registry->setCurrentSuite($suite);

        foreach ($loaders as $loader) {
            $loader->load();
        }
    }
}
