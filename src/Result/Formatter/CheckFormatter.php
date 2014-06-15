<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Result\Formatter;

use Exception;
use PhpTest\Result\FailedResult;
use PhpTest\Result\SuccessfulResult;

class CheckFormatter implements FormatterInterface
{
    /**
     * @param FailedResult $result
     */
    public function formatFailure(FailedResult $result)
    {
        return utf8_decode(2718); // ✘
    }

    /**
     * @param SuccessfulResult $result
     */
    public function formatSuccess(SuccessfulResult $result)
    {
        return utf8_decode(2714); // ✔
    }
}
