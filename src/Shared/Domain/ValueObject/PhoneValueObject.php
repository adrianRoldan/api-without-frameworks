<?php


namespace Src\Shared\Domain\ValueObject;


abstract class PhoneValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(PhoneValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    private function validate(string $value)
    {

        /*if(is_numeric($value))
            throw new ValidationException("El parametro [phone] ha de ser numerico");*/
    }
}
