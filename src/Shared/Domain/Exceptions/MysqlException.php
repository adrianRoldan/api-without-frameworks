<?php


namespace Src\Shared\Domain\Exceptions;


use Src\Shared\Domain\Contracts\ExceptionContract;

class MysqlException extends BaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 500;
    protected string $debug_level = "critical";

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
