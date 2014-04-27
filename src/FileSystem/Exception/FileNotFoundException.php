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

class FileNotFoundException extends \RuntimeException
{
    /**
     * @param string $path
     * @param integer $code
     * @param Exception $previous
     */
    public function __construct($path, $code = null, Exception $previous = null)
    {
        parent::__construct(sprintf('No file found at path "%s".', $path), $code, $previous);
    }
}
