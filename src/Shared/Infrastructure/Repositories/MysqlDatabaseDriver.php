<?php


namespace Src\Shared\Infrastructure\Repositories;

use mysqli;
use Src\Shared\Domain\Contracts\DatabaseDriverContract;
use Src\Shared\Domain\Exceptions\MysqlException;

class MysqlDatabaseDriver implements DatabaseDriverContract
{
    private static $instance = null;
    const DRIVER_NAME = "mysql";
    public mysqli $connection;


    public static function getInstance() : MysqlDatabaseDriver
    {
        if(!self::$instance)
            self::$instance = new self();

        return self::$instance;
    }

    public function query(string $query)
    {
        return $this->connection->query($query);
    }


    private function __construct()
    {
        $db_config  = require 'config/database.php';
        $db_config  = $db_config[self::DRIVER_NAME];
        $host     = $db_config["host"];
        $user     = $db_config["user"];
        $pass     = $db_config["pass"];
        $database = $db_config["database"];
        $charset  = $db_config["charset"];
        $port     = $db_config["port"];

        $this->connection = $this->connect($host, $user, $pass, $database, $port, $charset);
    }


    private function connect($host, $user, $pass, $database, $port = 3306, $charset = "utf8")
    {
        $db = new mysqli($host, $user, $pass, $database, $port);

        if ($db->connect_errno)
            throw new MysqlException("Problema con la conexion a la base de datos: ". $db->connect_error);


        $db->query("SET NAMES '".$charset."'");

        return $db;
    }

    //Evitamos clonar la instancia
    private function __clone() { }

}
