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
    public function acDispense()
    {
        $this->view("inputView");

        if ($_POST['Money']) {
            $money = $_POST['Money'];

            if (!is_numeric($money)) {
                $this->view("alertMsg", "Dispense Input type Error");
                exit();
            }

            $Account = $this->model("Account");
            $filter = $this->model("DataFilter");
            $remark = $filter->test_input($_POST['Remark']);
            $money = filter_var($money, FILTER_SANITIZE_NUMBER_INT);
            $remark = filter_var($remark, FILTER_SANITIZE_STRING);
            $result = $Account->doDispense($money, $remark);

            if ($result) {
                $this->view("alertMsg", $result);
            } else {
                $this->view("alertMsg", "Success");
            }
        }
    }

	//入款
    public function acDeposit()
    {
        $this->view("inputView");

        if ($_POST['Money']) {
            $money = $_POST['Money'];

            if (!is_numeric($money)) {
                $this->view("alertMsg", "Deposit Input type Error");
                exit();
            }

            $Account = $this->model("Account");
            $filter = $this->model("DataFilter");
            $remark = $filter->test_input($_POST['Remark']);
            $remark = filter_var($remark, FILTER_SANITIZE_STRING);
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
    public function acBalance()
    {
        $Account = $this->model("Account");
        $data = $Account->searchBalance();
        $this->view("echoMsg", $data["Balance"]);
    }
    //明細查詢
    public function acDetails()
    {
        $Account = $this->model("Account");
        $data = $Account->showDetails();
        $this->view("showDetails", $data);
    }

    //給帳戶session
    public function cAccount()
    {
        $account = $_POST["Account"];
        $account = filter_var($account, FILTER_SANITIZE_STRING);
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
}
