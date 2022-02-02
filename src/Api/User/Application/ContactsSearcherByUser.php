<?php

namespace Src\Api\User\Application;


use Src\Api\User\Domain\Services\UserFinder as DomainUserFinder;
use Src\Api\User\Domain\UserRepositoryContract;
use Src\Api\User\Domain\ValueObjects\UserId;


class ContactsSearcherByUser
{
    private UserRepositoryContract $repository;
    private DomainUserFinder $userFinder;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
        $this->userFinder = new DomainUserFinder($userRepository);
    }


    public function execute(UserId $user_id): array
    {
        $this->userFinder->execute($user_id); //Buscamos al usuario. Si no existe el servicio de dominio lanza una excepción

        return $this->repository->searchContactsByUser($user_id);

    }

}
