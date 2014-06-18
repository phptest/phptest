<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api;

use PhpTest\Loader\LoaderCollection;
use PhpTest\SuiteInterface;

interface ApiInterface
{
    /**
     * @param LoaderCollection $loaders
     * @param SuiteInterface $suite
     */
    public function load(LoaderCollection $loaders, SuiteInterface $suite);
}
