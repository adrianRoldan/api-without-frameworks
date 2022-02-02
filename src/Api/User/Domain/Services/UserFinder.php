<?php


namespace Src\Api\User\Domain\Services;


use Src\Api\User\Domain\Entities\User;
use Src\Api\User\Domain\Exceptions\UserNotFound;
use Src\Api\User\Domain\UserRepositoryContract;
use Src\Api\User\Domain\ValueObjects\UserId;

class UserFinder
{

    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    public function execute(UserId $user_id): User
    {
        $user = $this->repository->find($user_id);

        if ($user === null)
            throw new UserNotFound($user_id);


        return $user;
    }
}
