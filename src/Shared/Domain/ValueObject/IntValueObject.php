<?php


namespace Src\Shared\Domain\ValueObject;


use Src\Shared\Domain\Exceptions\ValidationException;

abstract class IntValueObject
{
    protected int $value;

    public function __construct(int|string $value)
    {
        $this->validate($value);
        $this->value = (int) $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    private function validate(int|string $value)
    {
        if(!is_numeric($value))
            throw new ValidationException("El ID introducido ($value) no tiene un formato numerico.");

        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($value, FILTER_VALIDATE_INT, $options)) {
            throw new ValidationException("El ID ($value) no es correcto. Revisa que no sea inferior a 1.");
        }
    }
}
