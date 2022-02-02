<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class RouteNotFoundException extends BaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;
    public string $debug_level = "error";
    protected $message = "La ruta indicada no existe.";


    public function getExceptionMessage()
    {
        return (array) json_decode(parent::getExceptionMessage());
    }

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
