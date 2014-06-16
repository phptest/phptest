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
use PhpTest\Result\Formatter\FormatterInterface;
use PhpTest\Result\PassResult;
use Symfony\Component\Console\Output\ConsoleOutputInterface;

class ConsoleOutputHandler implements HandlerInterface
{
    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @var ConsoleOutputInterface
     */
    protected $output;

    /**
     * @param ConsoleOutputInterface $output
     * @param FormatterInterface $formatter
     */
    public function __construct(ConsoleOutputInterface $output, FormatterInterface $formatter)
    {
        $this->output = $output;
        $this->formatter = $formatter;
    }

    /**
     * @param FailResult $result
     */
    public function handleFail(FailResult $result)
    {
        $this->output->write(sprintf('<fg=red>%s</fg=red>', $this->formatter->formatFail($result)));
    }

    /**
     * @param PassResult $result
     */
    public function handlePass(PassResult $result)
    {
        $this->output->write(sprintf('<fg=green>%s</fg=green>', $this->formatter->formatPass($result)));
    }
}
