<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\FileSystem\Exception;

use Exception;
use PhpTest\Exception\ExceptionInterface;
use RuntimeException;

class FileNotFoundException extends RuntimeException implements ExceptionInterface
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @param string $path
     * @param integer $code
     * @param Exception $previous
     */
    public function __construct($path, $code = null, Exception $previous = null)
    {
        $this->path = $path;
        $message = sprintf('No file found at path "%s".', $path);

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
