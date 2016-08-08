<?php
class Account
{
    public function __construct()
    {
        Server::pdoConnect();
    }
    public function doDispense($Dispense)
    {

    }
       //收款
    
    public function doDeposit()
    {

    }  
       //入款
    
    public function searchBalance()
    {
        $sql = "SELECT `ID`, `Balance` FROM `User` 
            WHERE `Account` = 'rain' 
            ORDER BY `ID` DESC 
            LIMIT 1";
        $result = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }   //查詢餘額
    
    public function showDetails()
    {
        $sql = "SELECT * 
            FROM  `User` 
            WHERE  `Account` = 'rain'";
        $result = Server::$db -> query($sql)-> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
        //查詢明細
}