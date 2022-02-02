<?php

namespace Core;

class App
{

    public function run()
    {
        //Capturamos la información de la petición del cliente
        $request = Request::capture();

        //Pasamos la peticion al enrutador para resolver la ruta
        $router = new Router($request);
        $route = $router->resolve();

        //Inicializamos el contenedor de inyección de dependencias
        $service_container = new ServiceContainer();
        $container = $service_container->build();

        //Lanzamos el controlador y accion asociada a la ruta con los datos de la peticíon.
        $controller = $container->get($route->controller);
        return $controller->{$route->action}($request->data);

    }

}
