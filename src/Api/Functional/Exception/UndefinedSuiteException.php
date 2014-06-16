<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api\Functional\Exception;

use Exception;
use PhpTest\Exception\ExceptionInterface;
use PhpTest\Api\Functional\SuiteRegistry;
use RuntimeException;

class UndefinedSuiteException extends RuntimeException implements ExceptionInterface
{
    /**
     * @var SuiteRegistry
     */
    protected $registry;

    /**
     * @param SuiteRegistry $registry
     * @param integer $code
     * @param Exception $previous
     */
    public function __construct(SuiteRegistry $registry, $code = null, Exception $previous = null)
    {
        $this->registry = $registry;
        $message = sprintf('The current test suite is not defined.');

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return SuiteRegistry
     */
    public function getRegistry()
    {
        return $this->registry;
    }
}
