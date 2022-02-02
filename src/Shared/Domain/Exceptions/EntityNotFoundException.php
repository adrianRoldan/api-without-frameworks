<?php

namespace Src\Shared\Domain\Exceptions;

use Src\Shared\Domain\Contracts\ExceptionContract;

class EntityNotFoundException extends BaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;
    protected string $debug_level = "critical";

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
