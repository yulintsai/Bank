<?php

class Account
{
    public function __construct()
    {
        Server::pdoConnect();
    }

    // 出款
    public function doDispense($money, $remark)
    {
        $account = $_SESSION['account'];

        try {

            // 查詢餘額
            Server::$db->beginTransaction();

            $sql = "SELECT `Balance` FROM `Account`WHERE `Account` = :account "
                 . "ORDER BY `ID` DESC LIMIT 1 FOR UPDATE";

            $statement = Server::$db->prepare($sql);
            $statement->execute([':account' => "$account"]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $balance = $result["Balance"] - $money;

            if ($balance <= 0) {
                return "餘額不足";
            }

            $time = date("Y-m-d h:i:s");

            // 進行出款
            $sql = "INSERT INTO `Account`"
                 . "(`Account`, `Time`, `Dispense`, `Balance`, `Remark`)"
                 . "VALUES"
                 . "(:Account, :Time, :Dispense, :Balance, :Remark)";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':Account', $account);
            $result->bindParam(':Time', $time);
            $result->bindParam(':Dispense', $money, PDO::PARAM_INT);
            $result->bindParam(':Balance', $balance, PDO::PARAM_INT);
            $result->bindParam(':Remark', $remark);
            $status = $result->execute();

            Server::$db->commit();

        } catch (Exception $err) {
            Server::$db->rollBack();
            $msg = $err->getMessage();

            return $msg;
        }
    }

    // 入款
    public function doDeposit($money ,$remark)
    {
        $account = $_SESSION['account'];

        try {

            // 餘額查詢
            Server::$db->beginTransaction();

            $sql = "SELECT `Balance` FROM `Account`"
                 . "WHERE `Account` = :account "
                 . "ORDER BY `ID` DESC LIMIT 1 FOR UPDATE";

            $statement = Server::$db->prepare($sql);
            $statement->execute([':account' => "$account"]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);

            // 進行入款
            $balance = $data["Balance"] + $money;
            $time = date("Y-m-d h:i:s");

            $sql = "INSERT INTO `Account`"
                 . "(`Account`, `Time`, `Deposit`, `Balance`, `Remark`)"
                 . "VALUES "
                 . "(:Account, :Time, :Deposit, :Balance, :Remark)";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':Account', $account);
            $result->bindParam(':Time', $time);
            $result->bindParam(':Deposit', $money, PDO::PARAM_INT);
            $result->bindParam(':Balance', $balance, PDO::PARAM_INT);
            $result->bindParam(':Remark', $remark);
            $status = $result->execute();

            Server::$db->commit();

        } catch (Exception $err) {
            Server::$db->rollBack();
            $msg = $err->getMessage();

            return $msg;
        }
    }

    // 查詢餘額
    public function searchBalance()
    {
        $account = $_SESSION['account'];

        $sql = "SELECT `Balance` FROM `Account` "
             . "WHERE `Account` = :account "
             . "ORDER BY `ID` DESC LIMIT 1 FOR UPDATE";

        $statement = Server::$db->prepare($sql);
        $statement->execute([':account' => "$account"]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // 查詢明細
    public function showDetails()
    {
        $account = $_SESSION['account'];

        $sql = "SELECT `Time`, `Dispense`, `Deposit`, `Balance`, `Remark`"
             . "FROM `Account` WHERE `Account` = :account FOR UPDATE";
        $statement = Server::$db->prepare($sql);
        $statement->execute([':account' => "$account"]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // 進入帳號
    public function intoAccount($account)
    {
        $_SESSION['account']=$account;

        return "setAccount $account OK";
    }

    // 登出
    public function logout()
    {
        session_unset();

        return "Logout Success";
    }
}
