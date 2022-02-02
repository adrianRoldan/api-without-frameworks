<?php


use PHPUnit\Framework\TestCase;
use Src\Api\User\Domain\Entities\User;
use Src\Api\User\Domain\Exceptions\UserNotFound;
use Src\Api\User\Domain\Services\UserFinder;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Domain\ValueObjects\UserLastName;
use Src\Api\User\Domain\ValueObjects\UserName;
use Src\Api\User\Domain\ValueObjects\UserPhone;
use Src\Api\User\Infrastructure\InMemoryUserRepository;

class GetUserTest extends TestCase
{

    /*
     * Test que comprueba que se obtiene el usuario esperado cuando
     */
    public function testGetUserWhenValidDataGiven()
    {
        $userFinder = new UserFinder(new InMemoryUserRepository());
        $user = $userFinder->execute(new UserId(1));


        $expected = new User(
            new UserName("Adrian"),
            new UserLastName("Roldan"),
            new UserPhone("639914741")
        );

        $this->assertEquals($expected, $user);
    }


    /**
     * Test que comprueba que si no existe el usuario se lanza la excepcion corresopondiente
     * @throws UserNotFound
     */
    public function testGetUserWhenUserNotFound()
    {
        $this->expectException(UserNotFound::class);

        $userFinder = new UserFinder(new InMemoryUserRepository());
        $user = $userFinder->execute(new UserId(2));
    }
}
