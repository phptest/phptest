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
use PhpTest\TestInterface;

interface FormatterInterface
{
    /**
     * @param Exception $exception
     * @param TestInterface $test
     */
    public function formatException(Exception $exception, TestInterface $test);

    /**
     * @param mixed $result
     * @param TestInterface $test
     */
    public function formatResult($result, TestInterface $test);
}
