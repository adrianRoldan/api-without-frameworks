<?php


namespace Src\Api\User\Domain\ValueObjects;


use Src\Shared\Domain\Exceptions\ValidationException;
use Src\Shared\Domain\ValueObject\StringValueObject;

final class UserName extends StringValueObject
{

    /**
     * UserName constructor.
     * @param string $value
     * @throws ValidationException
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @throws ValidationException
     */
    private function validate(string $value)
    {
        if($value == "")
            throw new ValidationException("El parametro [name] no puede estar vacio");


    }
}
