<?php

class HomeController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['account'])) {
            $this->view("insertAccount");
        } else {
            $this->view("index");
        }
    }

    // 出款
    public function insertAccountDispense($money= "", $remark = "")
    {
        $this->view("inputView", "Dispense");
        if ($money) {

            if (!is_numeric($money) || ($money < 0)) {
                $this->view("alertMsg", "Dispense Input type Error");

                return;
            }

            $remark = $this->inputFilter($remark);
            $Account = $this->model("Account");
            $result = $Account->doDispense($money, $remark);

            if ($result) {
                $this->view("alertMsg", $result);
            } else {
                $this->view("alertMsg", "Success");
            }
        }
    }

    // 入款
    public function insertAccountDeposit($money= "", $remark = "")
    {
        $this->view("inputView", "Deposit");
        if ($money) {

            if (!is_numeric($money) || ($money < 0)) {
                $this->view("alertMsg", "Deposit Input type Error");

                return;
            }

            $Account = $this->model("Account");
            $remark = $this->inputFilter($remark);

            $result = $Account->doDeposit($money, $remark);

            if ($result) {
                $this->view("alertMsg", "Please try again later");
            } else {
                $this->view("alertMsg", "Success");
            }
        }
    }

    // 餘額查詢
    public function searchAccountBalance()
    {
        $Account = $this->model("Account");
        $data = $Account->searchBalance();
        $this->view("echoMsg", $data);
    }

    // 明細查詢
    public function searchAccountDetails()
    {
        $Account = $this->model("Account");
        $data = $Account->showDetails();
        $this->view("showDetails", $data);
    }

    // 給帳戶session
    public function giveAccountSession()
    {
        $account = $_POST["Account"];
        $account = $this->inputFilter($account);
        $Account = $this->model("Account");
        $result = $Account->intoAccount($account);
        $this->view("alertMsg", $result);

        header("Refresh:0;/Bank");
    }

    public function logout()
    {
        $Account = $this->model("Account");
        $result = $Account->logout();
        $this->view("alertMsg", $result);

        header("Refresh:0;/Bank/Home");
    }

    // 輸入值過濾器
    private function inputFilter($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = filter_var($data, FILTER_SANITIZE_STRING);

        return $data;
    }
}
