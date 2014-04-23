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

use PhpTest\Api\ApiExtension;
use PhpTest\FileSystem\FileSystemExtension;
use PhpTest\ServiceContainer\ContainerLoader;
use PhpTest\ServiceContainer\ExtensionManager;
use PhpTest\ServiceContainer\ServiceHelper;
use Symfony\Component\Console;
use Symfony\Component\Console\Command\HelpCommand;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Application extends Console\Application
{
    const NAME = 'phptest';

    /**
     * @var Command
     */
    protected $command;

    /**
     * @param array $package
     */
    public function __construct(array $package)
    {
        parent::__construct(self::NAME, $package['version']);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultInputDefinition()
    {
        return new InputDefinition();
    }

    /**
     * {@inheritdoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $container = $this->buildContainer();
        $this->command = $container->get(CliExtension::ID_COMMAND);
        $this->add($this->command);

        parent::run($input, $output);
    }

    /**
     * @return ContainerInterface
     */
    protected function buildContainer()
    {
        $container = new ContainerBuilder();

        $loader = new ContainerLoader($this->buildExtensionManager());
        $loader->load($container)->compile();

        return $container;
    }

    /**
     * @return ExtensionManager
     */
    protected function buildExtensionManager()
    {
        return new ExtensionManager([
            new CliExtension()
        ]);
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
