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
use PhpTest\Result\Handler\HandlerInterface;
use PhpTest\Suite;

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
     * @param HandlerInterface $handler
     */
    public function execute(LoaderCollection $loaders, HandlerInterface $handler)
    {
        $suite = $this->buildSuite();
        $this->registry->setCurrentSuite($suite);

        foreach ($loaders as $loader) {
            $loader->load();
        }

        $suite->execute($handler);
    }

    /**
     * @return Suite
     */
    protected function buildSuite()
    {
        return new Suite(__CLASS__);
    }
}
