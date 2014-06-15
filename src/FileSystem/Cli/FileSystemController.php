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
use PhpTest\FileSystem\Loader\FileLoader;
use PhpTest\FileSystem\Loader\PhpFileLoader;
use PhpTest\Loader\LoaderCollection;
use SplFileInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FileSystemController implements ControllerInterface
{
    const ARG_FILE = 'file';

    /**
     * @var LoaderCollection
     */
    protected $collection;

    /**
     * @var FileLocator
     */
    protected $locator;

    /**
     * @param FileLocator $locator
     * @param LoaderCollection $collection
     */
    public function __construct(FileLocator $locator, LoaderCollection $collection)
    {
        $this->locator = $locator;
        $this->collection = $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function configure(Command $command)
    {
        $command->addArgument(self::ARG_FILE, InputArgument::OPTIONAL, 'Load tests from a specific file or path.');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument(self::ARG_FILE);
        $files = $this->locator->getFiles($path);

        foreach ($files as $file) {
            $this->collection->add($this->buildLoader($file));
        }
    }

    /**
     * @param SplFileInfo $file
     * @return LoaderInterface
     */
    protected function buildLoader(SplFileInfo $file)
    {
        if ('php' === $file->getExtension()) {
            return new PhpFileLoader($file);
        }

        return new FileLoader($file);
    }
}
