<?php

class Server
{
    public static $db;

    public static function pdoConnect()
    {
        $dsn = "mysql:host=localhost; dbname=Bank; charset=utf8";
        $db = new PDO($dsn, 'rain123473', '0000');
        Server::$db = $db;
    }
}
