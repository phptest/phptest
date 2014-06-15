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

use PhpTest\Result\Handler\HandlerInterface;
use PhpTest\TestInterface;
use SplObjectStorage;

class Suite implements SuiteInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var SplObjectStorage
     */
    protected $tests;

    /**
     * @param string $name
     * @param TestInterface[] $tests
     */
    public function __construct($name, array $tests = [])
    {
        $this->name = (string) $name;
        $this->tests = new SplObjectStorage();

        foreach ($tests as $test) {
            $this->add($test);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function add(TestInterface $test)
    {
        $this->tests->attach($test);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(HandlerInterface $handler)
    {
        foreach ($this->tests as $test) {
            $test->execute($handler);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}
