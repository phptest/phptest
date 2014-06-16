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
use PhpTest\Result\Handler\HandlerInterface;
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
    protected $collection;

    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * @var ApiManager
     */
    protected $manager;

    /**
     * @param ApiManager $manager
     * @param LoaderCollection $collection
     * @param HandlerInterface $handler
     */
    public function __construct(ApiManager $manager, LoaderCollection $collection, HandlerInterface $handler)
    {
        $this->collection = $collection;
        $this->handler = $handler;
        $this->manager = $manager;
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

        $api->execute($this->collection, $this->handler);
    }
}
