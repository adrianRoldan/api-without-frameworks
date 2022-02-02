<?php


namespace Src\Api\User\Domain\ValueObjects;


use Src\Shared\Domain\Exceptions\ValidationException;
use Src\Shared\Domain\ValueObject\StringValueObject;

final class ContactName extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->validate($value);
        parent::__construct($value);
    }

    private function validate(string $value)
    {
        if($value == "")
            throw new ValidationException("El parametro [contactName] no puede estar vacio");
    }

    public function equals(ContactName $other): bool
    {
        return $this->value() === $other->value();
    }

}
