<?php
    class dataFilter
    {
        public function __construct()
        {
            Server::setConnect();
        }
        
        public function test_input($data = Array()) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = Server::$mysqli->real_escape_string($data);
            return $data;
        }
            //過濾Input
    }
