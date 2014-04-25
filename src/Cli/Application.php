<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Cli;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Application extends BaseApplication
{
    /** @var Command */
    protected $command;

    /** @var InputDefinition */
    protected $inputDefinition;

    /** @var InputInterface */
    protected $input;

    /** @var OutputInterface */
    protected $output;

    /**
     * @param string $name
     * @param string $version
     * @param InputDefinition $definition
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function __construct(
        $name,
        $version,
        InputDefinition $definition,
        Command $command,
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->command = $command;
        $this->inputDefinition = $definition;
        $this->input = $input;
        $this->output = $output;

        parent::__construct($name, $version);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultInputDefinition()
    {
        return $this->inputDefinition;
    }

    /**
     * {@inheritdoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->add($this->command);

        parent::run($input ?: $this->input, $output ?: $this->output);
    }

    /**
     * @param InputInterface $input
     * @return string
     */
    protected function getCommandName(InputInterface $input)
    {
        return $this->command->getName();
    }
}
