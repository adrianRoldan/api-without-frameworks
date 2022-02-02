<?php


namespace Src\Api\User\Infrastructure;

use Core\Response;
use Src\Api\User\Application\CommonContactsGetter;
use Src\Api\User\Application\ContactsCreator;
use Src\Api\User\Application\ContactsSearcherByUser;
use Src\Api\User\Application\ContactsUpdator;
use Src\Api\User\Application\UserCreator;
use Src\Api\User\Domain\UserRepositoryContract;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Shared\Domain\Exceptions\InvalidInputParametersException;

class UserController
{

    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
    }


    /**
     * Endpoint para crear un usuario
     * @param array $request
     * @throws InvalidInputParametersException
     * @throws \Src\Shared\Domain\Exceptions\ValidationException
     */
    public function create(array $request)
    {
        if(!isset($request['name']) or !isset($request['lastName']) or !isset($request['phone']))
            throw new InvalidInputParametersException("Los parametros de entrada [name], [lastName] y [phone] son obligatorios");

        $user_creator = new UserCreator($this->repository);
        $user_creator->execute($request);

        Response::json("Usuario creado correctamente");
    }


    /**
     * Endpoint para obtener los contactos de un usuario
     * @param array $request
     * @throws InvalidInputParametersException
     */
    public function contacts(array $request)
    {
        if(!isset($request['userId']))
            throw new InvalidInputParametersException("El parametro de entrada [userId] es obligatorio");

        $contacts_searcher = new ContactsSearcherByUser($this->repository);
        $contacts = $contacts_searcher->execute(new UserId($request['userId']));

        Response::jsonOfObjectsArray($contacts);
    }


    /**
     * Endpoint para Guardar los contactos de la agenda un usuario
     * @param array $request
     * @throws InvalidInputParametersException
     */
    public function createContacts(array $request)
    {
        if(!isset($request['userId']) or !isset($request['contacts']))
            throw new InvalidInputParametersException("Los parametros de entrada [userId] y [contacts] son obligatorios");

        $contacts_creator = new ContactsCreator($this->repository);
        $contacts_creator->execute($request);

        Response::json("Contactos creados correctamente para el usuario {$request['userId']}");
    }


    /**
     * Endpoint para Actualizar los contactos de la agenda un usuario
     * @param array $request
     * @throws InvalidInputParametersException
     */
    public function updateContacts(array $request)
    {
        if(!isset($request['userId']) or !isset($request['contacts']))
            throw new InvalidInputParametersException("Los parametros de entrada [userId] y [contacts] son obligatorios");

        $contacts_creator = new ContactsUpdator($this->repository);
        $contacts_creator->execute($request);

        Response::json("Contactos actualizados correctamente para el usuario {$request['userId']}");
    }


    /**
     * Endpoint para obtener los contactos comunes registrados entre dos usuarios.
     * @param array $request
     * @throws InvalidInputParametersException
     */
    public function commonContacts(array $request)
    {
        if(!isset($request['userId1']) or !isset($request['userId2']))
            throw new InvalidInputParametersException("Los parametros de entrada [userId1] y [userId2] son obligatorios");

        $contacts_getter = new CommonContactsGetter($this->repository);
        $common_contacts = $contacts_getter->execute(new UserId($request['userId1']), new UserId($request['userId2']));

        Response::jsonOfObjectsArray($common_contacts);
    }

}
