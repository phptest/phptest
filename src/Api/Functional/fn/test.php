<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api\Functional\fn;

use PhpTest\Api\Functional\SuiteRegistry;
use PhpTest\SuiteInterface;
use PhpTest\Test;

/**
 * @param string $name
 * @param callable $fn
 * @param array[] $args
 */
function test($name, callable $fn, array $args = []) {
    $registry = SuiteRegistry::getInstance();
    $suite = $registry->getCurrentSuite();

    _test($suite, $name, $fn, $args);
};

/**
 * @param SuiteInterface $suite
 * @param string $name
 * @param callable $fn
 * @param array[] $arguments
 */
function _test(SuiteInterface $suite, $name, callable $fn, array $args = []) {
    foreach ($args ?: [[]] as $_args) {
        $test = new Test($name, $fn, $_args);
        $suite->add($test);
    }
};
