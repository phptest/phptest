<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api\Functional;

use PhpTest\Api\Functional\Exception\UndefinedSuiteException;
use PhpTest\SuiteInterface;
use UnexpectedValueException;

class SuiteRegistry
{
    /**
     * @var SuiteRegistry
     */
    protected static $instance;

    /**
     * @var SuiteInterface
     */
    protected $current;

    /**
     * @param SuiteInterface $suite
     */
    public function __construct(SuiteInterface $suite = null)
    {
        if ($suite) {
            $this->setCurrentSuite($suite);
        }
    }

    /**
     * @return SuiteRegistry
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return SuiteInterface
     */
    public function getCurrentSuite()
    {
        if (!$this->current) {
            throw new UndefinedSuiteException($this);
        }

        return $this->current;
    }

    /**
     * @param SuiteInterface $suite
     * @return SuiteInterface The previous suite
     */
    public function setCurrentSuite(SuiteInterface $suite = null)
    {
        $previous = $this->current;
        $this->current = $suite;

        return $previous;
    }
}
