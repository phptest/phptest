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
use PhpTest\Result\Formatter\FormatterInterface;
use PhpTest\Result\SuccessfulResult;
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
     * @param FailedResult $result
     */
    public function handleFailure(FailedResult $result)
    {
        $this->output->write('<error>%s</error>', $this->formatter->formatFailure($result));
    }

    /**
     * @param SuccessfulResult $result
     */
    public function handleSuccess(SuccessfulResult $result)
    {
        $this->output->write('<success>%s</success>', $this->formatter->formatSuccess($result));
    }
}
