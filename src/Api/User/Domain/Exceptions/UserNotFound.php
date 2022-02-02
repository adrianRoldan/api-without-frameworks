<?php


namespace Src\Api\User\Domain\Exceptions;


use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Shared\Domain\Contracts\ExceptionContract;
use Src\Shared\Domain\Exceptions\BaseException;

class UserNotFound extends BaseException implements ExceptionContract
{
    private const GENERATED_STATUS = 404;

    public function __construct(UserId $id)
    {
        parent::__construct("El usuario con id {$id->value()} no ha sido encontrado.", self::GENERATED_STATUS, null);
    }

    public function getGeneratedStatus()
    {
        return self::GENERATED_STATUS;
    }
}
