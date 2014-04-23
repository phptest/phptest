<?php
namespace PhpTest\Cli;

use Symfony\Component\Console\Command\Command;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @param Command $command
     */
    public function configure(Command $command)
    {
    }
}
