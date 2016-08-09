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

            $money = filter_var($money, FILTER_SANITIZE_NUMBER_INT);
            $do = $this->model("Account");
            $test = $this->model("DataFilter");
            $account = $test->test_input($_POST['Account']);
            $remark = $test->test_input($_POST['Remark']);
            $remark = filter_var($remark, FILTER_SANITIZE_STRING);
            $result = $do->doDispense($account, $money, $remark);
            $this->view("alertMsg", $result);
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
            $do = $this->model("Account");
            $test = $this->model("DataFilter");
            $account = $test->test_input($_POST['Account']);
            $remark = $test->test_input($_POST['Remark']);
            $remark = filter_var($remark, FILTER_SANITIZE_STRING);
            $money = filter_var($money, FILTER_SANITIZE_NUMBER_INT);
            $result = $do->doDeposit($account, $money, $remark);
            $this->view("alertMsg", $result);
        }
    }
    //餘額查詢
    public function acBalance()
    {
        $do = $this->model("Account");
        $data = $do->searchBalance();
        $this->view("echoMsg", $data['Balance']);
    }
    //明細查詢
    public function acDetails()
    {
        $do = $this->model("Account");
        $data = $do->showDetails();
        $this->view("showDetails", $data);
    }
    //給帳戶session
    public function cAccount()
    {
    				$account = filter_var($_POST["Account"], FILTER_SANITIZE_STRING);
    				$choose = $this->model("Account");
    				$result = $choose->intoAccount($account);
    				$this->view("alertMsg", $result);
    				header("Refresh:0;/Bank");
    }
    public function logout()
    {
        $go = $this->model("Account");
        $result = $go->logout();
        $this->view("alertMsg", $result);
    				header("Refresh:0;/Bank/Home");
    }

}
