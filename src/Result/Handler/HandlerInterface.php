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

use Exception;
use PhpTest\Result\FailedResult;
use PhpTest\Result\SuccessfulResult;

interface HandlerInterface
{
    /**
     * @param FailedResult
     */
    public function handleFailure(FailedResult $result);

    /**
     * @param SuccessfulResult
     */
    public function handleSuccess(SuccessfulResult $result);
}
