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
use PhpTest\Result\FailResult;
use PhpTest\Result\PassResult;

class DotFormatter implements FormatterInterface
{
    /**
     * @param FailResult $result
     */
    public function formatFail(FailResult $result)
    {
        return 'F';
    }

    /**
     * @param PassResult $result
     */
    public function formatPass(PassResult $result)
    {
        return '.';
    }
}
