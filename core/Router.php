<?php


namespace Core;


use Src\Shared\Domain\Exceptions\HTTPMethodNotAllowed;
use Src\Shared\Domain\Exceptions\RouteNotFoundException;

class Router
{
    private Request $request;
    public string $controller;
    public string $action;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Devuelve una ruta con el controlador y accion de destino de la petición
     * @return $this
     * @throws HTTPMethodNotAllowed
     * @throws RouteNotFoundException
     */
    public function resolve() : Router
    {
        $destination = $this->resolveUri();  //Obtenemos el controlador y metodo a ejecutar asociado a la URI

        $class_name = ucwords(trim($destination["controller"]));
        $class_filename = str_replace("\\", "/", dirname( dirname(__FILE__))."/".$class_name.".php");

        //Comprobamos si existe el fichero de la clase y si el metodo existe en el controlador
        if (!file_exists(strtolower($class_filename)) or !method_exists($class_name, $destination["action"]))
            throw new RouteNotFoundException();

        $this->controller = $class_name;
        $this->action = $destination["action"];

        return $this;
    }


    /**
     * @return array with controller and method to execute
     * @throws HTTPMethodNotAllowed
     * @throws RouteNotFoundException
     */
    private function resolveUri()
    {
        $routesMap = include_once dirname( dirname(__FILE__)) .'/routes.php';

        //Si no hay definidas rutas para el verbo http de la petición, lanzamos excepción
        if(!array_key_exists($this->request->method, $routesMap))
            throw new HTTPMethodNotAllowed();

        $method_routes = $routesMap[$this->request->method]; //Obtenemos las rutas definidas para el verbo de la petición
        $uri = trim($this->request->uri, "/");

        //Si no esta definida la uri de la petición en las rutas, lanzamos excepción
        if(!array_key_exists($uri, $method_routes))
            throw new RouteNotFoundException();

        return [
            "controller"    => $method_routes[$uri][0],
            "action"        => $method_routes[$uri][1]
        ];
    }
}
