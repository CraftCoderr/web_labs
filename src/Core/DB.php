<?php


namespace Core;


use PDO;

class DB
{
    private static $connection = null;

    public static function connect() : PDO
    {
        global $config;
        if (DB::$connection == null) {
           DB::$connection = new PDO('mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['name'],
                $config['database']['user'], $config['database']['password']);
           DB::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return DB::$connection;
    }
}