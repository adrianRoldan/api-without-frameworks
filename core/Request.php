<?php

namespace Core;

use Src\Shared\Domain\Exceptions\HTTPMethodNotAllowed;
use Src\Shared\Domain\Exceptions\IncorrectJSONFormat;

class Request
{

    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';

    public string $uri;
    public string $method;
    public array $data_server;
    public array $data;


    public function __construct(string $method, string $uri, array $server, array $data = [])
    {
        $this->init($method, $uri, $server, $data);
    }


    /**
     * @return Request
     * @throws HTTPMethodNotAllowed
     * @throws IncorrectJSONFormat
     */
    public static function capture()
    {
        $method = $_SERVER['REQUEST_METHOD'];   //Obtenemos el verbo http de la petición
        $data_server = ['remote_ip' => $_SERVER['REMOTE_ADDR']];    //Información del servidor del cliente

        $request_data = self::getRequestData($method, $_SERVER['REQUEST_URI']);
        self::checkData($request_data['data']);

        return self::create($method, $request_data['uri'], $data_server, $request_data['data']);
    }


    /**
     * Extrae de la petición la información y la uri correcta.
     * @param string $request_method
     * @param string $uri
     * @return array
     * @throws HTTPMethodNotAllowed
     */
    private static function getRequestData(string $request_method, string $uri) : array
    {
        switch($request_method){

            case self::METHOD_PUT   :
            case self::METHOD_POST  :
                $data = json_decode(file_get_contents( 'php://input'), true);
                break;

            case self::METHOD_GET   :
                $uri = $_GET['url'] ?? $uri;
                $data = $_GET;
                break;

            default: throw new HTTPMethodNotAllowed();
        }

        return [
            "uri"     => $uri,
            "data"    => $data
        ];
    }


    /**
     * @param array|null $data_input
     * @throws IncorrectJSONFormat
     */
    private static function checkData(array $data_input = null)
    {
        # Si el json no tiene el formato correcto, lanzamos excepción
        if (!json_encode($data_input))
            throw new IncorrectJSONFormat();
    }


    /**
     * Crea una instancia de la clase Request pasandole los datos de la petición
     * @param string $method
     * @param string $uri
     * @param array $server
     * @param array $data
     * @return Request
     */
    private static function create(string $method, string $uri, array $server, array $data = []) : Request
    {
        return new self($method, $uri, $server, $data);
    }


    /**
     * Inicializa los atributos de clase con los datos de la petición
     * @param string $method
     * @param string $uri
     * @param array $server
     * @param array $data
     */
    private function init(string $method, string $uri, array $server, array $data)
    {
        $this->data = $data;
        $this->method = $method;
        $this->uri = $uri;
        $this->data_server = $server;
    }

}
