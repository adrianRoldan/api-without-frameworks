<?php


namespace Core;


use DI\ContainerBuilder;
use Src\Api\User\Domain\UserRepositoryContract;
use Src\Api\User\Infrastructure\MysqlUserRepository;
use function DI\create;

class ServiceContainer
{

    private ContainerBuilder $builder;

    public function __construct()
    {
        $this->builder = new ContainerBuilder();    //Instancia del paquete php-di para inyección de dependencias
        $this->builder->addDefinitions($this->bindingMap());
    }

    public function build()
    {
        return $this->builder->build();
    }


    private function bindingMap()
    {
        //Definimos las implementaciones de las interficies que el contender instanciará automáticamente
        return [
            UserRepositoryContract::class => create(MysqlUserRepository::class)
        ];
    }

}
