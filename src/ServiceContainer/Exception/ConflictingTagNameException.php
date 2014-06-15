<?php

namespace PhpTest\ServiceContainer\Exception;

use Exception;
use PhpTest\Exception\ExceptionInterface;
use Symfony\Component\DependencyInjection\Exception\LogicException;

class ConflictingTagNameException extends LogicException implements ExceptionInterface
{
    /**
     * @param string $tag
     * @param integer $code
     * @param Exception $previous
     */
    public function __construct($tag, $code = 0, Exception $previous = null)
    {
        $this->tag = $tag;
        $message = sprintf('The tag name "%s" is already used by another service.', $tag);

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }
}
