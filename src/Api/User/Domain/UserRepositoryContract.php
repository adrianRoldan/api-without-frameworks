<?php

namespace Src\Api\User\Domain;


use Src\Api\User\Domain\Entities\Contact;
use Src\Api\User\Domain\Entities\User;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Shared\Domain\Contracts\BaseRepositoryContract;

interface UserRepositoryContract extends BaseRepositoryContract
{
    public function find(UserId $id): ?User;

    public function save(User $user): void;

    public function searchContactsByUser(UserId $id): array;

    public function saveContacts(UserId $id, Contact ...$contacts);

    public function deleteContacts(UserId $id);
}
