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

use Exception;
use PhpTest\Result\FailResult;
use PhpTest\Result\Handler\HandlerInterface;
use PhpTest\Result\PassResult;

class Test implements TestInterface, ArgumentBoundInterface
{
    /**
     * @var array
     */
    protected $arguments;

    /**
     * @var callable
     */
    protected $fn;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     * @param callable $fn
     * @param array $arguments
     */
    public function __construct($name, callable $fn, array $arguments = [])
    {
        $this->arguments = $arguments;
        $this->fn = $fn;
        $this->name = (string) $name;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(HandlerInterface $handler)
    {
        try {
            $result = call_user_func_array($this->fn, $this->arguments);
            $handler->handlePass(new PassResult($result, $this));
        } catch (Exception $exception) {
            $handler->handleFail(new FailResult($exception, $this));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}
