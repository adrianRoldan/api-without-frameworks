<?php


namespace Src\Api\User\Infrastructure;


use Src\Api\User\Domain\Entities\Contact;
use Src\Api\User\Domain\Entities\User;
use Src\Api\User\Domain\UserRepositoryContract;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\ValueObjects\UserLastName;
use Src\Api\User\Domain\ValueObjects\UserName;
use Src\Api\User\Domain\ValueObjects\UserPhone;

class InMemoryUserRepository implements UserRepositoryContract
{


    public function find(UserId $id): ?User
    {
        if($id->value() == 1)
            return new User(
                new UserName("Adrian"),
                new UserLastName("Roldan"),
                new UserPhone("639914741")
            );

        return null;
    }

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function searchContactsByUser(UserId $id): array
    {
        // TODO: Implement searchContactsByUser() method.
    }

    public function saveContacts(UserId $id, Contact ...$contacts)
    {
        // TODO: Implement saveContacts() method.
    }

    public function deleteContacts(UserId $id)
    {
        // TODO: Implement deleteContacts() method.
    }
}
