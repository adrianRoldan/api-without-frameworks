<?php

namespace Src\Api\User\Application;

use Src\Api\User\Domain\Entities\User;
use Src\Api\User\Domain\UserRepositoryContract;
use Src\Api\User\Domain\ValueObjects\UserLastName;
use Src\Api\User\Domain\ValueObjects\UserName;
use Src\Api\User\Domain\ValueObjects\UserPhone;


class UserCreator
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @param array $data
     * @throws \Src\Shared\Domain\Exceptions\ValidationException
     */
    public function execute(array $data)
    {
        //Transformamos los datos de entrada en ValueObjects de Usuario
        $name       = new UserName($data['name']);
        $lastName   = new UserLastName($data['lastName']);
        $phone      = new UserPhone($data['phone']);

        $user = User::create(
            $name,
            $lastName,
            $phone
        );

        $this->repository->save($user);
    }

}
