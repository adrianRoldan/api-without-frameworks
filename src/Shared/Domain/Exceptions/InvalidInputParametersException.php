<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class InvalidInputParametersException extends BaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 422;

    public function getExceptionMessage()
    {
        return (array) json_decode(parent::getExceptionMessage());
    }

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
