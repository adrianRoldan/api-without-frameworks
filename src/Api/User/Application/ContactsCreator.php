<?php

namespace Src\Api\User\Application;

use Src\Api\User\Domain\Entities\Contact;
use Src\Api\User\Domain\Services\UserFinder as DomainUserFinder;
use Src\Api\User\Domain\UserRepositoryContract;
use Src\Api\User\Domain\ValueObjects\ContactName;
use Src\Api\User\Domain\ValueObjects\ContactPhone;
use Src\Api\User\Domain\ValueObjects\UserId;
use Src\Shared\Domain\Exceptions\InvalidInputParametersException;


class ContactsCreator
{
    private UserRepositoryContract $repository;
    private DomainUserFinder $userFinder;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->repository = $userRepository;
        $this->userFinder = new DomainUserFinder($userRepository);
    }


    public function execute(array $data)
    {
        $user_id = new UserId($data['userId']);
        $this->userFinder->execute($user_id); //Buscamos al usuario. Si no existe el servicio de dominio lanza una excepción

        $contacts = [];
        foreach($data['contacts'] as $contact) {

            if(!isset($contact['contactName']) or !isset($contact['phone']))
                throw new InvalidInputParametersException("Los parametros de entrada [contactName] y [phone] para los contactos son obligatorios");

            //Transformamos los datos de entrada en ValueObjects de Contact
            $name = new ContactName($contact['contactName']);
            $phone = new ContactPhone($contact['phone']);
            $contacts[] = Contact::create($name, $phone, $user_id);

        }

        $this->repository->saveContacts($user_id, ...$contacts);
    }

}
