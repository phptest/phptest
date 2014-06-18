<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Suite\Cli;

use PhpTest\Cli\AbstractController;
use PhpTest\Result\Handler\HandlerInterface;
use PhpTest\SuiteInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SuiteController extends AbstractController
{
    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @var SuiteInterface
     */
    protected $suite;

    /**
     * @param SuiteInterface $suite
     */
    public function __construct(SuiteInterface $suite, HandlerInterface $handler)
    {
        $this->handler = $handler;
        $this->suite = $suite;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->suite->execute($this->handler);
    }
}
