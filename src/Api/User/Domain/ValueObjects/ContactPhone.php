<?php


namespace Src\Api\User\Domain\ValueObjects;


use Src\Shared\Domain\Exceptions\ValidationException;
use Src\Shared\Domain\ValueObject\PhoneValueObject;

final class ContactPhone extends PhoneValueObject
{
    public function __construct(string $value)
    {
        $this->validate($value);
        parent::__construct($value);
    }

    private function validate(string $value)
    {
        if($value == "")
            throw new ValidationException("El parametro [phone] no puede estar vacio");


    }

}
