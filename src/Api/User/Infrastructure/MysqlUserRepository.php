<?php

namespace Src\Api\User\Infrastructure;

use Src\Api\User\Domain\Entities\Contact;
use Src\Api\User\Domain\Entities\User;
use Src\Api\User\Domain\UserRepositoryContract;

use Src\Api\User\Domain\ValueObjects\ContactName;
use Src\Api\User\Domain\ValueObjects\ContactPhone;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\ValueObjects\UserLastName;
use Src\Api\User\Domain\ValueObjects\UserName;
use Src\Api\User\Domain\ValueObjects\UserPhone;
use Src\Shared\Infrastructure\Repositories\MysqlRepository;

class MysqlUserRepository extends MysqlRepository implements UserRepositoryContract
{
    private string $contacts_table = "user_contacts";
    const TABLE = "users";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }



    public function find(UserId $id): ?User
    {
        if($result = parent::findById($id->value()))
            return new User(
                new UserName($result['name']),
                new UserLastName($result['lastName']),
                new UserPhone($result['phone'])
            );

        return null;
    }


    public function save(User $user): void
    {
        $data = $user->toArray();

        $sql = "INSERT INTO $this->table (name, lastName, phone) VALUES ('{$data['name']}', '{$data['lastName']}', '{$data['phone']}')";
        $this->insert($sql);
    }


    public function searchContactsByUser(UserId $id): array
    {
        $sql = "SELECT * FROM $this->contacts_table where user_id = {$id->value()}";
        $result = $this->search($sql);

        $contacts = [];
        foreach($result as $contact)
            $contacts[] = (new Contact(
                new ContactName($contact['contactName']),
                new ContactPhone($contact['phone']),
                new UserId($contact['user_id'])));

        return $contacts;
    }

    public function saveContacts(UserId $id, Contact ...$contacts)
    {
        foreach($contacts as $contact){
            $data = $contact->toArray();
            $sql = "INSERT INTO $this->contacts_table (contactName, phone, user_id) VALUES ('{$data['contactName']}', '{$data['phone']}', '{$id->value()}')";
            $this->insert($sql);
        }
    }

    public function deleteContacts(UserId $id)
    {
        $sql = "DELETE FROM $this->contacts_table WHERE user_id = {$id->value()}";
        $this->delete($sql);
    }
}
