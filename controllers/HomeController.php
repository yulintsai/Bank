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

    //出款
    public function insertAccountDispense()
    {
        $this->view("inputView", "Dispense");

        if ($_POST['Money']) {
            $money = $_POST['Money'];

            if (!is_numeric($money)) {
                $this->view("alertMsg", "Dispense Input type Error");
                exit();
            }

            $remark = $this->inputFilter($_POST['Remark']);
            $Account = $this->model("Account");
            $result = $Account->doDispense($money, $remark);

            if ($result) {
                $this->view("alertMsg", $result);
            } else {
                $this->view("alertMsg", "Success");
            }
        }
    }

	//入款
    public function insertAccountDeposit()
    {
        $this->view("inputView", "Deposit");

        if ($_POST['Money']) {
            $money = $_POST['Money'];

            if (!is_numeric($money)) {
                $this->view("alertMsg", "Deposit Input type Error");
                exit();
            }

            $Account = $this->model("Account");
            $remark = $this->inputFilter($_POST['Remark']);
            $money = filter_var($money, FILTER_SANITIZE_NUMBER_INT);

            $result = $Account->doDeposit($money, $remark);

            if ($result) {
                $this->view("alertMsg", $result);
            } else {
                $this->view("alertMsg", "Success");
            }
        }
    }

    //餘額查詢
    public function searchAccounBalance()
    {
        $Account = $this->model("Account");
        $data = $Account->searchBalance();
        $this->view("echoMsg", $data["Balance"]);
    }

    //明細查詢
    public function searchAccountDetails()
    {
        $Account = $this->model("Account");
        $data = $Account->showDetails();
        $this->view("showDetails", $data);
    }

    //給帳戶session
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

    //輸入值過濾器
    private function inputFilter($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        $data = $data;

        return $data;
    }
}
