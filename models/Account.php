<?php

class Account
{
    public function __construct()
    {
        Server::pdoConnect();
    }
    //出款
    public function doDispense($account, $money, $remark)
    {
        try {
            Server::$db->beginTransaction();

            $sql = "SELECT `ID`, `Balance` FROM `Account`"; 
            $sql .= "WHERE `Account` = 'rain'";
            $sql .= "ORDER BY `ID` DESC LIMIT 1 FOR UPDATE";

            $data = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
            $balance = $data["Balance"] - $money;

            if ($balance<=0) {
                return "餘額不足";
            }
												$time=date("Y-m-d h:i:s");
												
            $sql = "INSERT INTO `Account`";
            $sql .= "(`Account`, `Time`, `Dispense`, `Balance`, `Remark`)";
            $sql .= "VALUES";
            $sql .= "(:Account, :Time, :Dispense, :Balance, :Remark)";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':Account', $account);
            $result->bindParam(':Time', $time);
            $result->bindParam(':Dispense', $money, PDO::PARAM_INT);
            $result->bindParam(':Balance', $balance, PDO::PARAM_INT);
            $result->bindParam(':Remark', $remark);
            $status = $result->execute();

            Server::$db->commit();

            if ($status) {
                return "SUCCESS";
            } else {
                return "FALSE";
            }

            } catch (Exception $err) {
                Server::$db->rollBack();
                $msg = $err->getMessage();
            } 
    }
    //入款
    public function doDeposit($account, $money ,$remark)
    {
        try {
            Server::$db->beginTransaction();

            $sql = "SELECT `ID`, `Balance`";
            $sql .= "FROM `Account` WHERE `Account` = 'rain'"; 
            $sql .= "ORDER BY `ID` DESC LIMIT 1 FOR UPDATE";

            $data = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
            $balance = $data["Balance"] + $money;
            $time=date("Y-m-d h:i:s");

            $sql = "INSERT INTO `Account`";
            $sql .= "(`Account`, `Time`, `Deposit`, `Balance`, `Remark`)";
            $sql .= "VALUES ";
            $sql .= "(:Account, :Time, :Deposit, :Balance, :Remark)";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':Account', $account);
            $result->bindParam(':Time', $time);
            $result->bindParam(':Deposit', $money, PDO::PARAM_INT);
            $result->bindParam(':Balance', $balance, PDO::PARAM_INT);
            $result->bindParam(':Remark', $remark);
            $status = $result->execute();

            Server::$db->commit();

	           if ($status) {
	               return "SUCCESS";
	           } else {
	               return "FALSE";
	           }

            } catch (Exception $err) {
                Server::$db->rollBack();
                $msg = $err->getMessage();
            } 
    }  
    //查詢餘額
    public function searchBalance()
    {
    				Server::$db->beginTransaction();
    				
        $sql = "SELECT `ID`, `Balance` FROM `Account` WHERE `Account` = 'rain'";
        $sql .= "ORDER BY `ID` DESC LIMIT 1 FOR UPDATE";
        $result = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);

								Server::$db->commit();

        return $result;
    }
    //查詢明細
    public function showDetails()
    {
    				Server::$db->beginTransaction();
    				
        $sql = "SELECT ";
        $sql .= "`ID`, `Time`, `Dispense`, `Deposit`, `Balance`, `Remark`";
        $sql .= "FROM `Account` WHERE `Account` = 'rain' FOR UPDATE";
        $result = Server::$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

								Server::$db->commit();

        return $result;
    }

}