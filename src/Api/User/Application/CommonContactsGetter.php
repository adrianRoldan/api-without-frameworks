<?php


namespace Src\Api\User\Application;


use Src\Api\User\Domain\UserRepositoryContract;
use Src\Api\User\Domain\ValueObjects\UserId;

class CommonContactsGetter
{

    private UserRepositoryContract $repository;
    private ContactsSearcherByUser $contacts_searcher;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
        $this->contacts_searcher = new ContactsSearcherByUser($repository);
    }

    public function execute(UserId $userId1, UserId $userId2): array
    {
        $contacts_user1 = $this->contacts_searcher->execute($userId1);
        $contacts_user2 = $this->contacts_searcher->execute($userId2);

        return $this->intersect($contacts_user1, $contacts_user2);
    }

    private function intersect(array $contacts_user1, array $contacts_user2): array
    {
        $intersect = [];
        foreach($contacts_user1 as $contact1)
            foreach($contacts_user2 as $contact2)
                if($contact1->equals($contact2))
                    $intersect[] = $contact1;

        return $intersect;
    }
}
