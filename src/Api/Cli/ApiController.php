<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api\Cli;

use PhpTest\Api\ApiManager;
use PhpTest\Cli\ControllerInterface;
use PhpTest\Loader\LoaderCollection;
use PhpTest\SuiteInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ApiController implements ControllerInterface
{
    const OPT_API = 'api';

    /**
     * @var LoaderCollection
     */
    protected $loaders;

    /**
     * @var ApiManager
     */
    protected $manager;

    /**
     * @var SuiteInterface
     */
    protected $suite;

    /**
     * @param ApiManager $manager
     * @param LoaderCollection $loaders
     * @param SuiteInterface $suite
     */
    public function __construct(ApiManager $manager, LoaderCollection $loaders, SuiteInterface $suite)
    {
        $this->loaders = $loaders;
        $this->manager = $manager;
        $this->suite   = $suite;
    }

    /**
     * {@inheritdoc}
     */
    public function configure(Command $command)
    {
        $description = 'The test suite API to load and run tests.';
        $mode = InputOption::VALUE_REQUIRED;

        $command->addOption(self::OPT_API, 'a', $mode, $description, 'functional');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $api = $this->manager->get($input->getOption(self::OPT_API));

        $api->load($this->loaders, $this->suite);
    }
}
