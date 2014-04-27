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
use PhpTest\FileSystem\FileLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FileSystemController implements ControllerInterface
{
    const ARG_FILE = 'path';

    /**
     * @var FileLocator
     */
    protected $locator;

    /**
     * @param FileLocator $locator
     */
    public function __construct(FileLocator $locator)
    {
        $this->locator = $locator;
    }

    /**
     * {@inheritdoc}
     */
    public function configure(Command $command)
    {
        $command->addArgument(self::ARG_FILE, InputArgument::OPTIONAL, 'Load tests from a specific file path.');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument(self::ARG_FILE);

        if ($path) {
            $output->writeln('File: ' . $path);
            var_dump($this->locator->findFiles($path));
        }
    }
}
