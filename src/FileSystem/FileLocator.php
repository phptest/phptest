<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\FileSystem;

use PhpTest\FileSystem\Exception\FileNotFoundException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class FileLocator
{
    /**
     * @var string
     */
    protected $rootDir;

    /**
     * @param string $rootDir
     */
    public function __construct($rootDir)
    {
        $this->rootDir = realpath($rootDir);
    }

    /**
     * @param string $path
     * @return SplFileInfo[]
     */
    public function getFiles($path)
    {
        return iterator_to_array(
            $this->getFileIterator($this->getAbsolutePath($path)),
            false
        );
    }

    /**
     * @param string $path
     * @return string
     */
    protected function getAbsolutePath($path)
    {
        $rootPath = $this->rootDir . DIRECTORY_SEPARATOR . $path;

        if (is_file($path) || is_dir($path)) {
            $absolutePath = $path;
        } elseif (is_file($rootPath) || is_dir($rootPath)) {
            $absolutePath = $rootPath;
        } else {
            throw new FileNotFoundException($path);
        }

        return $absolutePath;
    }

    /**
     * @param string $path
     * @return Iterator
     */
    protected function getFileIterator($path)
    {
        return new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $path,
                RecursiveDirectoryIterator::SKIP_DOTS |
                RecursiveDirectoryIterator::FOLLOW_SYMLINKS
            )
        );
    }
}
