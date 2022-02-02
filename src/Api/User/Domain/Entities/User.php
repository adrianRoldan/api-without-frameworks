<?php
declare(strict_types=1);

namespace Src\Api\User\Domain\Entities;

use Src\Api\User\Domain\ValueObjects\UserLastName;
use Src\Api\User\Domain\ValueObjects\UserName;
use Src\Api\User\Domain\ValueObjects\UserPhone;
use Src\Shared\Domain\Contracts\EntityContract;

final class User implements EntityContract
{

    private UserName $name;
    private UserLastName $lastName;
    private UserPhone $phone;

    public function __construct(
        UserName $name,
        UserLastName $lastName,
        UserPhone $phone
    )
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->phone = $phone;
    }

    public static function create(UserName $name, UserLastName $lastName, UserPhone $phone) : User
    {
        return new self($name, $lastName, $phone);
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function lastName(): UserLastName
    {
        return $this->lastName;
    }

    public function phone(): UserPhone
    {
        return $this->phone;
    }

    public function toArray() : array
    {
        return [
            "name"      => $this->name->value(),
            "lastName"  => $this->lastName->value(),
            "phone"     => $this->phone->value()
        ];
    }
}
