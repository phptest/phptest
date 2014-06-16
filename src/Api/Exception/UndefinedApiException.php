<?php
/*
 * This file is part of PHPTest
 *
 * Copyright (c) 2014 Andrew Lawson <http://adlawson.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpTest\Api\Exception;

use Exception;
use PhpTest\Api\ApiManager;
use PhpTest\Exception\ExceptionInterface;
use RuntimeException;

class UndefinedApiException extends RuntimeException implements ExceptionInterface
{
    /**
     * @var ApiManger
     */
    protected $manager;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     * @param ApiManager $manager
     * @param integer $code
     * @param Exception $previous
     */
    public function __construct($name, ApiManager $manager, $code = null, Exception $previous = null)
    {
        $this->manager = $manager;
        $this->name = $name;

        $message = sprintf('No API defined with name "%s".', $name);
        $suggestions = $manager->getNames();

        if (!empty($suggestions)) {
            $imploded = implode('", "', $suggestions);
            $message .= sprintf(' Did you mean "%s"?', $imploded);
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ApiManager
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
