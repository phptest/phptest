<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest;

use IteratorAggregate;

interface SuiteInterface extends TestInterface
{
    /**
     * @param TestInterface $test
     */
    public function add(TestInterface $test);
}
