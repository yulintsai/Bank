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

            $sql = "SELECT `balance` FROM `Client` " .
                   "WHERE `account` = :account FOR UPDATE";

            $statement = Server::$db->prepare($sql);
            $statement->execute([':account' => "$account"]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);

            $balance = $data["balance"] - $money;

            if ($balance <= 0) {
                throw new PDOException("餘額不足");
            }

            $time = date("Y-m-d h:i:s");

            // 進行出款
            $sql = "UPDATE `Client` SET `balance`= :balance, `time` = :time " .
                   "WHERE `account`= :account";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':account', $account);
            $result->bindParam(':time', $time);
            $result->bindParam(':balance', $balance, PDO::PARAM_INT);
            $doDispenseStatus = $result->execute();

            // 新增出款明細
            $sql = "INSERT INTO `Account`" .
                   "(`account`, `time`, `dispense`, `balance`, `remark`)" .
                   "VALUES" .
                   "(:account, :time, :dispense, :balance, :remark)";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':account', $account);
            $result->bindParam(':time', $time);
            $result->bindParam(':dispense', $money, PDO::PARAM_INT);
            $result->bindParam(':balance', $balance, PDO::PARAM_INT);
            $result->bindParam(':remark', $remark);
            $insertDetail = $result->execute();

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

            if (!is_numeric($money)){
                throw new PDOException("金額必須為數字");
            }

            $sql = "SELECT `balance` FROM `Client`" .
                   "WHERE `account` = :account FOR UPDATE";

            $statement = Server::$db->prepare($sql);
            $statement->execute([':account' => "$account"]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);

            // 進行入款
            $balance = $data["balance"] + $money;
            $time = date("Y-m-d h:i:s");

            $sql = "UPDATE `Client` SET `balance`= :balance, `time` = :time " .
                   "WHERE `account`= :account";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':account', $account);
            $result->bindParam(':time', $time);
            $result->bindParam(':balance', $balance, PDO::PARAM_INT);
            $status = $result->execute();

            // 新增入款明細
            $sql = "INSERT INTO `Account`" .
                   "(`account`, `time`, `deposit`, `balance`, `remark`)" .
                   "VALUES " .
                   "(:account, :time, :deposit, :balance, :remark)";

            $result = Server::$db->prepare($sql);
            $result->bindParam(':account', $account);
            $result->bindParam(':time', $time);
            $result->bindParam(':deposit', $money, PDO::PARAM_INT);
            $result->bindParam(':balance', $balance, PDO::PARAM_INT);
            $result->bindParam(':remark', $remark);
            $status = $result->execute();

            Server::$db->commit;
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

        $sql = "SELECT `balance` FROM `Client` " .
               "WHERE `account` = :account";

        $statement = Server::$db->prepare($sql);
        $statement->execute([':account' => "$account"]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result["balance"];
    }

    // 查詢明細
    public function showDetails()
    {
        $account = $_SESSION['account'];

        $sql = "SELECT `time`, `dispense`, `deposit`, `balance`, `remark`" .
               "FROM `Account` WHERE `account` = :account";
        $statement = Server::$db->prepare($sql);
        $statement->execute([':account' => "$account"]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // 進入帳號
    public function intoAccount($account)
    {
        $sql = "SELECT `account` FROM `Client` WHERE `account` = :account";
        $statement = Server::$db->prepare($sql);
        $statement->execute([':account' => "$account"]);
        $result = $statement->fetch();

        if ($result) {
            $_SESSION['account'] = $account;

            return "setAccount $account OK";

        } else {
            return "No account";
        }
    }

    // 登出
    public function logout()
    {
        session_unset();

        return "Logout Success";
    }
}
