<?php
class Account
{
    public function __construct()
    {
        Server::pdoConnect();
    }
    public function doDispense($MONEY)
    {
        $sql = "INSERT INTO `User`(`Account`, `Dispense`, `Balance`, `Remark`) VALUES (
            :Account,
            :Dispense,
            :Balance,
            :Remark
            )";
        $Account = "rain";
        $Remark = "";
        $data = $this->searchBalance();
        $Balance = $data["Balance"] - $MONEY;
        $result = Server::$db->prepare($sql);
        $result->bindParam(':Account', $Account);
        $result->bindParam(':Dispense', $MONEY, PDO::PARAM_INT);
        $result->bindParam(':Balance', $Balance, PDO::PARAM_INT);
        $result->bindParam(':Remark', $Remark);
        $status = $result->execute();
        return $status;
    }
       //收款
    
    public function doDeposit($MONEY)
    {
        $sql = "INSERT INTO `User`(`Account`, `Deposit`, `Balance`, `Remark`) VALUES (
            :Account,
            :Deposit,
            :Balance,
            :Remark
            )";
        $Account = "rain";
        $Remark = "";
        $data = $this->searchBalance();
        $Balance = $data["Balance"] + $MONEY;
        $result = Server::$db->prepare($sql);
        $result->bindParam(':Account', $Account);
        $result->bindParam(':Deposit', $MONEY, PDO::PARAM_INT);
        $result->bindParam(':Balance', $Balance, PDO::PARAM_INT);
        $result->bindParam(':Remark', $Remark);
        $status = $result->execute();
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
        $sql = "SELECT * 
            FROM  `User` 
            WHERE  `Account` = 'rain'";
        $result = Server::$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
        //查詢明細
}