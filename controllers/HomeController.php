<?php
class HomeController extends Controller 
{
    public function index()
    {   
        $this->view("index");
    }
    
    public function acDispense()
    {
        $this->view("inputView");
        if ($_POST['Money']) {
            $MONEY = $_POST['Money'];
            if (!is_numeric($MONEY)) {
            $this->view("alertMsg", "Dispense Input type Error");
            exit();
            }
            $do = $this->model("Account");
            $test = $this->model("DataFilter");
            $account = $test->test_input($_POST['Account']);
            $remark = $test->test_input($_POST['Remark']);
            $result = $do->doDispense($account, $MONEY, $remark);
            if ($result) {
                    //出款成功
                $this->view("alertMsg", "Dispense Success");
                } else {
                    $this->view("alertMsg", "Dispense ERROR");
                }
        }
    }
        //出款
        
    public function acDeposit()
    {
        $this ->view("inputView");
        if ($_POST['Money']) {
            $MONEY = $_POST['Money'];
            if (!is_numeric($MONEY)) {
            $this->view("alertMsg", "Deposit Input type Error");
            exit();
            }
            $do = $this->model("Account");
            $test = $this->model("DataFilter");
            $account = $test->test_input($_POST['Account']);
            $remark = $test->test_input($_POST['Remark']);
            $result = $do->doDeposit($account, $MONEY, $remark);
            if ($result) {
                //入款成功
            $this->view("alertMsg", "Deposit Success");
            } else {
                $this->view("alertMsg", "Deposit ERROR");
            }
        }
    }
        //入款
    
    public function acBalance()
    {
        $do = $this->model("Account");
        $data = $do->searchBalance();
        $this->view("echoMsg", $data['Balance']);
    }
        //餘額查詢
        
    public function acDetails()
    {
        $do = $this->model("Account");
        $data = $do->showDetails();
        $this->view("showDetails", $data);
    }
        //明細查詢
}