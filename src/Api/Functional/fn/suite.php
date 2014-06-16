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

use Closure;
use PhpTest\Api\Functional\SuiteRegistry;
use PhpTest\Suite;
use PhpTest\SuiteInterface;

/**
 * @param string $name
 * @param callable $fn
 */
function suite($name, callable $fn) {
    $registry = SuiteRegistry::getInstance();
    $parent = $registry->getCurrentSuite();

    _suite($parent, $name, function (SuiteInterface $suite) use ($fn, $registry) {
        $previous = $registry->setCurrentSuite($suite);
        $fn instanceof Closure ? $fn($suite) : call_user_func($fn, $suite);
        $registry->setCurrentSuite($previous);
    });
};

/**
 * @param SuiteInterface $suite
 * @param string $name
 * @param callable $fn
 */
function _suite(SuiteInterface $parent, $name, callable $fn) {
    $suite = new Suite($name);
    $parent->add($suite);

    $fn instanceof Closure ? $fn($suite) : call_user_func($fn, $suite);
};
