<?php

namespace Src\Shared\Domain\Exceptions;

use Exception;
use Throwable;

abstract class BaseException extends Exception
{
    protected string $debug_level = "error";

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if(!empty($message) or (!empty($message) and !empty($code)))
            parent::__construct($message, $this->getGeneratedStatus(), $previous);
    }

    public function getExceptionMessage()
    {
        return parent::getMessage();
    }

    abstract public function getGeneratedStatus();
}
