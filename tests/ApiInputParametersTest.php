<?php


use Core\Request;
use Core\Router;
use PHPUnit\Framework\TestCase;
use Src\Api\User\Domain\Services\UserFinder;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Api\User\Infrastructure\InMemoryUserRepository;
use Src\Api\User\Infrastructure\UserController;
use Src\Shared\Domain\Exceptions\InvalidInputParametersException;
use Src\Shared\Domain\Exceptions\RouteNotFoundException;
use Src\Shared\Domain\Exceptions\ValidationException;

class ApiInputParametersTest extends TestCase
{
    public function testRouterWhenInvalidRouteGiven()
    {

        $this->expectException(RouteNotFoundException::class);

        $request = new Request(
            "POST", "/user/contacts/common", [], ["userId1" => 1, "userId2" => 2]
        );

        $router = new Router($request);
        $route = $router->resolve();
    }

    public function testValidationWhenInvalidDataGiven()
    {
        $this->expectException(InvalidInputParametersException::class);
        (new UserController(new InMemoryUserRepository()))->create(["fasdjgh" => "dato incorrecto"]);
    }


    public function testValidationWhenInvalidDataGiven2()
    {
        $this->expectException(InvalidInputParametersException::class);
        (new UserController(new InMemoryUserRepository()))->createContacts([
            "userId"    => "1",
            "contacts"  => [
                "contactName" => "Adrian"
            ]
        ]);
    }

    public function testValidationWhenInvalidUserIdDataGiven()
    {
        $this->expectException(ValidationException::class);

        $userFinder = new UserFinder(new InMemoryUserRepository());
        $user = $userFinder->execute(new UserId(-1));
    }
}
