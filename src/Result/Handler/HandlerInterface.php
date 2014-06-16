<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Result\Handler;

use PhpTest\Result\FailResult;
use PhpTest\Result\PassResult;

interface HandlerInterface
{
    /**
     * @param FailResult
     */
    public function handleFail(FailResult $result);

    /**
     * @param PassResult
     */
    public function handlePass(PassResult $result);
}
