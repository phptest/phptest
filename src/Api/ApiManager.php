<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api;

use PhpTest\Api\Exception\UndefinedApiException;

class ApiManager
{
    /**
     * @var ApiInterface[]
     */
    protected $apis = [];

    /**
     * @param ApiInterface[] $apis
     */
    public function __construct(array $apis = [])
    {
        foreach ($apis as $name => $api) {
            $this->add($name, $api);
        }
    }

    /**
     * @param string $name
     * @param ApiInterface $api
     */
    public function add($name, ApiInterface $api)
    {
        $this->apis[$name] = $api;
    }

    /**
     * @param string $name
     * @return ApiInterface
     */
    public function get($name)
    {
        if (!isset($this->apis[$name])) {
            throw new UndefinedApiException($name, $this);
        }

        return $this->apis[$name];
    }

    /**
     * @return string[]
     */
    public function getNames()
    {
        return array_keys($this->apis);
    }
}
