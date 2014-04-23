<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\FileSystem\Cli;

use PhpTest\Cli\ControllerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FileSystemController implements ControllerInterface
{
    const ARG_FILE      = 'file';
    const ID_CONTROLLER = 'fs.controller';

    /**
     * @param Command $command
     */
    public function configure(Command $command)
    {
        $command->addArgument(self::ARG_FILE, InputArgument::OPTIONAL, 'Load tests from a specific file path.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('File: ' . $input->getArgument(self::ARG_FILE));
    }
}
