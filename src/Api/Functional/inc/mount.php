<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require_once __DIR__ . '/fn.php';

/**
 * @param string $name
 * @param callable $fn
 */
function suite($name, callable $fn) {
    return \PhpTest\Api\Functional\fn\suite($name, $fn);
}

/**
 * @param string $name
 * @param callable $fn
 * @param array[] $args
 */
function test($name, callable $fn, array $args = []) {
    return \PhpTest\Api\Functional\fn\test($name, $fn, $args);
}
