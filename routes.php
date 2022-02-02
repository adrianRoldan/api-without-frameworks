<?php

use Core\Request;
use Src\Api\User\Infrastructure\UserController;

return [

    /**
     * Formato para definir rutas
     *
     * Verbo HTTP => [
     *      "ruta"  => [clase controlador, "metodo del controlador a ejecutar"]
     * ]
     *
     */
    Request::METHOD_GET => [
        "user/contacts"         => [UserController::class, 'contacts'],
        "user/contacts/common"  => [UserController::class, 'commonContacts'],
    ],

    Request::METHOD_POST => [
        "user/create"           => [UserController::class, 'create'],
        "user/contacts/create"  => [UserController::class, 'createContacts'],
    ],

    Request::METHOD_PUT => [
        "user/contacts/update"  => [UserController::class, 'updateContacts'],
    ],
];
