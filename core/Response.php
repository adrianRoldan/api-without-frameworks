<?php


namespace Core;


class Response
{
    // Formato de respuesta en JSON
    public static function json($data, $code = 200)
    {
        self::setResponseHeaders($code);
        self::response(json_encode($data));
    }

    // Formato de respuesta en JSON a partir de array de entidades del dominio
    public static function jsonOfObjectsArray(array $data, $code = 200)
    {
        self::setResponseHeaders($code);

        $data = array_map(function($object){
            return $object->toArray();
        },$data);

        self::response(json_encode($data));
    }

    private static function response($data)
    {
        echo $data;
        exit();
    }

    private static function setResponseHeaders($code = 200)
    {
        switch ($code){
            case "200" :
                $msg = "OK";
                break;
            case "404" :
                $msg = "NOT FOUND";
                break;
            case "422" :
                $msg = "Error de validacion de datos";
                break;
            case "500" :
                $msg = "Internal Server Error";
                break;
            default:
                $code = 500;
                $msg = "Unknown response";
                break;
        }

        header('HTTP/1.1 '.$code.' '.$msg);
        header('Content-Type: application/json; charset=utf-8');
    }
}
