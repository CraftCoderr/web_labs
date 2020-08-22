<?php


namespace Core;


use PDO;

class DB
{
    private static $connection = null;

    public static function connect()
    {
        global $config;
        if (DB::$connection == null) {
           DB::$connection = new PDO('mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['name'],
                $config['database']['user'], $config['database']['password']);
        }
        return DB::$connection;
    }
}