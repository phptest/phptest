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

use PhpTest\Result\HandlerInterface;

interface ArgumentBoundInterface
{
    /**
     * @return array
     */
    public function getArguments();
}
