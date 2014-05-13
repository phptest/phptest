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

use Symfony\Component\Console\Command\Command as CommandInterface;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @param CommandInterface $command
     */
    public function configure(CommandInterface $command)
    {
    }
}
