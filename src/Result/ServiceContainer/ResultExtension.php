<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Result\ServiceContainer;

use PhpTest\Cli\ServiceContainer\CliExtension;
use PhpTest\ServiceContainer\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ResultExtension extends AbstractExtension
{
    const ID_FORMATTER_DOT = 'result.formatter.dot';
    const ID_HANDLER = 'result.handler';

    public function load(ContainerBuilder $container)
    {
        $this->loadDotFormatter($container);
        $this->loadHandler($container);
    }

    protected function loadDotFormatter(ContainerBuilder $container)
    {
        $container->register(self::ID_FORMATTER_DOT, 'PhpTest\Result\Formatter\DotFormatter');
    }

    protected function loadHandler(ContainerBuilder $container)
    {
        $def = $container->register(self::ID_HANDLER, 'PhpTest\Result\Handler\ConsoleOutputHandler');
        $def->setArguments([
            new Reference(CliExtension::ID_OUTPUT),
            new Reference(self::ID_FORMATTER_DOT)
        ]);
    }
}
