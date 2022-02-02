<?php


namespace Src\Api\User\Domain\Entities;


use Src\Api\User\Domain\ValueObjects\ContactName;
use Src\Api\User\Domain\ValueObjects\ContactPhone;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Shared\Domain\Contracts\EntityContract;

class Contact implements EntityContract
{
    private ContactName $name;
    private ContactPhone $phone;
    private UserId $user_id;

    public function __construct(ContactName $name, ContactPhone $phone, UserId $userId)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->user_id = $userId;
    }

    public static function create(ContactName $name, ContactPhone $phone, UserId $userId) : Contact
    {
        return new self($name, $phone, $userId);
    }

    public function name(): ContactName
    {
        return $this->name;
    }

    public function phone(): ContactPhone
    {
        return $this->phone;
    }

    public function user_id(): UserId
    {
        return $this->user_id;
    }

    //Compara dos contactos. Son iguales si comparten nombre y telefono.
    public function equals(Contact $other)
    {
        return $this->name->equals($other->name) and $this->phone->equals($other->phone);
    }


    public function toArray() : array
    {
        return [
            "contactName"   => $this->name->value(),
            "phone"         => $this->phone->value(),
            "user_id"       => $this->user_id->value(),
        ];
    }
}
