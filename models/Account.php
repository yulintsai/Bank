<?php
class Account
{
    public function __construct()
    {
        Server::pdoConnect();
    }
    public function doDispense($account, $MONEY, $remark)
    {
        try{
            Server::$db->beginTransaction();
            $sql = "SELECT `ID`, `Balance` FROM `User` 
                WHERE `Account` = 'rain' 
                ORDER BY `ID` DESC 
                LIMIT 1 FOR UPDATE";
            $data = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
            $BALANCE = $data["Balance"] - $MONEY;
            if($BALANCE<=0)
            return null;
            $sql = "INSERT INTO `User`(`Account`, `Dispense`, `Balance`, `Remark`) VALUES (
                :Account,
                :Dispense,
                :Balance,
                :Remark
                )";
            $result = Server::$db->prepare($sql);
            $result->bindParam(':Account', $account);
            $result->bindParam(':Dispense', $MONEY, PDO::PARAM_INT);
            $result->bindParam(':Balance', $BALANCE, PDO::PARAM_INT);
            $result->bindParam(':Remark', $remark);
            $status = $result->execute();
            Server::$db->commit();
            if ($status) {
                return "SUCCESS";
            } else {
                    return "FALSE";
            }
        }catch(Exception $err) {
            Server::$db->rollBack();
            $msg = $err->getMessage();
        } 
    }
       //收款
    
    public function doDeposit($account, $MONEY ,$remark)
    {
        try{
            Server::$db->beginTransaction();
            $sql = "SELECT `ID`, `Balance` FROM `User` 
                WHERE `Account` = 'rain' 
                ORDER BY `ID` DESC 
                LIMIT 1 FOR UPDATE";
            $data = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
            $BALANCE = $data["Balance"] + $MONEY;
            $sql = "INSERT INTO `User`(`Account`, `Deposit`, `Balance`, `Remark`) VALUES (
                :Account,
                :Deposit,
                :Balance,
                :Remark
                )";
            $result = Server::$db->prepare($sql);
            $result->bindParam(':Account', $account);
            $result->bindParam(':Deposit', $MONEY, PDO::PARAM_INT);
            $result->bindParam(':Balance', $BALANCE, PDO::PARAM_INT);
            $result->bindParam(':Remark', $remark);
            $status = $result->execute();
            Server::$db->commit();
            if ($status) {
                return "SUCCESS";
            } else {
                    return "FALSE";
            }
        }catch(Exception $err) {
            Server::$db->rollBack();
            $msg = $err->getMessage();
        } 
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
