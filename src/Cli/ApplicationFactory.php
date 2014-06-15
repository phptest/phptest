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

use PhpTest\Cli\ServiceContainer\CliExtension;
use PhpTest\FileSystem\ServiceContainer\FileSystemExtension;
use PhpTest\Loader\ServiceContainer\LoaderExtension;
use PhpTest\Result\ServiceContainer\ResultExtension;
use PhpTest\ServiceContainer\ContainerLoader;
use PhpTest\ServiceContainer\ExtensionManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApplicationFactory
{
    /** @var array */
    protected $package;

    /**
     * @param array $package
     */
    public function __construct(array $package = [])
    {
        $this->package = $package;
    }

    /**
     * @return Application
     */
    public function build()
    {
        $container = $this->buildContainer();

        return new Application(
            $this->getName(),
            $this->getVersion(),
            $this->getInputDefinition(),
            $this->getCommand($container),
            $this->getInput($container),
            $this->getOutput($container)
        );
    }

    /**
     * @param ContainerInterface $container
     * @return Command
     */
    public function getCommand(ContainerInterface $container)
    {
        return $container->get(CliExtension::ID_COMMAND);
    }

    /**
     * @param ContainerInterface $container
     * @return InputInterface
     */
    public function getInput(ContainerInterface $container)
    {
        return $container->get(CliExtension::ID_INPUT);
    }

    /**
     * @return InputDefinition
     */
    public function getInputDefinition()
    {
        return new InputDefinition([
            new InputOption('help', 'h', InputOption::VALUE_NONE, 'Display this help message.'),
            new InputOption('version', null, InputOption::VALUE_NONE, 'Display the current version.'),
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'phptest';
    }

    /**
     * @param ContainerInterface $container
     * @return OutputInterface
     */
    public function getOutput(ContainerInterface $container)
    {
        return $container->get(CliExtension::ID_OUTPUT);
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return isset($this->package['version']) ? $this->package['version'] : '0';
    }

    /**
     * @return ContainerInterface
     */
    protected function buildContainer()
    {
        $container = new ContainerBuilder();

        $loader = new ContainerLoader($this->buildExtensionManager());
        $loader->load($container);

        $container->compile();

        return $container;
    }

    /**
     * @return ExtensionManager
     */
    protected function buildExtensionManager()
    {
        return new ExtensionManager([
            new CliExtension($this->getName()),
            new FileSystemExtension(),
            new LoaderExtension(),
            new ResultExtension()
        ]);
    }
}
