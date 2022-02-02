<?php

use Core\App;
use Core\Response;

require 'vendor/autoload.php';

try{

    $app = new App();
    $app->run();

}catch (Throwable $exception)
{
    error_log($exception->__toString());
    Response::json($exception->getMessage(), $exception->getCode());
}




