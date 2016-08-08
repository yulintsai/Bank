<?php
class Account
{
    public function __construct()
    {
        Server::pdoConnect();
    }
    public function doDispense($MONEY, $remark)
    {
        Server::$db->beginTransaction();
        $sql = "SELECT `ID`, `Balance` FROM `User` 
            WHERE `Account` = 'rain' 
            ORDER BY `ID` DESC 
            LIMIT 1 FOR UPDATE";
        $data = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        $Balance = $data["Balance"] - $MONEY;
        if($Balance<=0)
        return null;
        $sql = "INSERT INTO `User`(`Account`, `Dispense`, `Balance`, `Remark`) VALUES (
            :Account,
            :Dispense,
            :Balance,
            :Remark
            )";
        $Account = "rain";
        $result = Server::$db->prepare($sql);
        $result->bindParam(':Account', $Account);
        $result->bindParam(':Dispense', $MONEY, PDO::PARAM_INT);
        $result->bindParam(':Balance', $Balance, PDO::PARAM_INT);
        $result->bindParam(':Remark', $remark);
        $status = $result->execute();
        Server::$db->commit();
        return $status;
    }
       //收款
    
    public function doDeposit($MONEY ,$remark)
    {
        Server::$db->beginTransaction();
        $sql = "SELECT `ID`, `Balance` FROM `User` 
            WHERE `Account` = 'rain' 
            ORDER BY `ID` DESC 
            LIMIT 1 FOR UPDATE";
        $data = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        $Balance = $data["Balance"] + $MONEY;
        $sql = "INSERT INTO `User`(`Account`, `Deposit`, `Balance`, `Remark`) VALUES (
            :Account,
            :Deposit,
            :Balance,
            :Remark
            )";
        $Account = "rain";
        $result = Server::$db->prepare($sql);
        $result->bindParam(':Account', $Account);
        $result->bindParam(':Deposit', $MONEY, PDO::PARAM_INT);
        $result->bindParam(':Balance', $Balance, PDO::PARAM_INT);
        $result->bindParam(':Remark', $remark);
        $status = $result->execute();
        Server::$db->commit();
        return $status;
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
        $sql = "SELECT `ID`, `Dispense`, `Deposit`, `Balance`, `Remark`
            FROM  `User` 
            WHERE  `Account` = 'rain'";
        $result = Server::$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
        //查詢明細
}