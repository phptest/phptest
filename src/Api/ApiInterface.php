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
use PhpTest\Result\Handler\HandlerInterface;

interface ApiInterface
{
    /**
     * @param LoaderCollection $loaders
     * @param HandlerInterface $handler
     */
    public function execute(LoaderCollection $loaders, HandlerInterface $handler);
}
