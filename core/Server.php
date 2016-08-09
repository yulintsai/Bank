<?php

class Server {
    
    public static $mysqli,$myip,$db,$db2;
    
    public static function setConnect() 
    {
        $db_server="localhost";
        $db_user="rain123473";
        $db_pwd="0000";
        $db_name="Bank";
        $mysqli=new mysqli($db_server,$db_user,$db_pwd,$db_name);
        if ($mysqli->connect_errno)
            die("Can't Connect Database");
        $mysqli->set_charset("utf8");
        Server::$mysqli=$mysqli;
    }
    
    public static function pdoConnect()
    {
        $config['db']['dsn']='mysql:host=localhost; dbname=Bank; charset=utf8';
        // 資料庫的帳號密碼 >>> 要依照你的資料做設定
        $config['db']['user'] = 'rain123473';
        $config['db']['password'] = '0000';
        $db = new PDO(
            $config['db']['dsn'],
            $config['db']['user'],
            $config['db']['password'],
                array(
                    PDO::ATTR_EMULATE_PREPARES=>false,
                    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                )
            );
        Server::$db=$db;
    }
}
