<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\ServiceContainer;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class ExtensionManager
{
    /**
     * @var ExtensionInterface[]
     */
    protected $extensions = [];

    /**
     * @param ExtensionInterface[] $extensions
     */
    public function __construct(array $extensions = [])
    {
        foreach ($extensions as $extension) {
            $this->addExtension($extension);
        }
    }

    /**
     * @param ExtensionInterface $extension
     */
    public function addExtension(ExtensionInterface $extension)
    {
        $this->extensions[] = $extension;
    }

    /**
     * @return ExtensionInterface[]
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * @param ExtensionInterface $extension
     */
    public function getOtherExtensions(ExtensionInterface $extension)
    {
        $filtered = array_filter($this->extensions, function ($ext) use ($extension) {
            return $extension !== $ext;
        });

        return array_values($filtered);
    }
}
