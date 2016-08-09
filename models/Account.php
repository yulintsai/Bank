<?php
class Account
{
    public function __construct()
    {
        Server::pdoConnect();
    }
    //收款
    public function doDispense($account, $money, $remark)
    {
        try {
            Server::$db->beginTransaction();

            $sql = "SELECT `ID`, `Balance` FROM `User`"; 
            $sql .= "WHERE `Account` = 'rain'";
            $sql .= "ORDER BY `ID` DESC LIMIT 1 FOR UPDATE";

            $data = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
            $balance = $data["Balance"] - $money;

            if ($balance<=0) {
                return "餘額不足";
            }

            $sql = "INSERT INTO `User`";
            $sql .= "(`Account`, `Dispense`, `Balance`, `Remark`) VALUES ";
            $sql .= "(:Account, :Dispense, :Balance, :Remark)";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':Account', $account);
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
            $sql .= "FROM `User` WHERE `Account` = 'rain'"; 
            $sql .= "ORDER BY `ID` DESC LIMIT 1 FOR UPDATE";

            $data = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);
            $balance = $data["Balance"] + $money;

            $sql = "INSERT INTO `User`";
            $sql .= "(`Account`, `Deposit`, `Balance`, `Remark`)";
            $sql .= "VALUES (:Account, :Deposit, :Balance, :Remark)";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':Account', $account);
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
        $sql = "SELECT `ID`, `Balance` FROM `User` WHERE `Account` = 'rain'";
        $sql .= "ORDER BY `ID` DESC LIMIT 1";
        $result = Server::$db->query($sql)->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    //查詢明細
    public function showDetails()
    {
        $sql = "SELECT `ID`, `Dispense`, `Deposit`, `Balance`, `Remark`";
        $sql .= "FROM `User` WHERE `Account` = 'rain'";
        $result = Server::$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}