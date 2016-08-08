<?php
class HomeController extends Controller 
{
    public function index()
    {   
        $this -> view("index");
    }
    
    public function acDispense()
    {
        $this ->view("inputView");
        // $do = $this -> model("Account");
        // $do -> doDeposit();
    }
        //出款
        
    public function acDeposit()
    {
        $this ->view("inputView");
        if ($_POST['Money']) {
        $MONEY = $_POST['Money'];
        $do = $this -> model("Account");
        $result = $do -> doDeposit($MONEY);
            if ($result) {
            $this -> view("alertMsg","Deposit Success");
            }
        }
    }
        //入款
    
    public function acBalance()
    {
        $do = $this -> model("Account");
        $data = $do ->searchBalance();
        $this -> view("echoMsg",$data['Balance']);
    }
        //餘額查詢
        
    public function acDetails()
    {
        $do = $this -> model("Account");
        $data = $do -> showDetails();
        $this -> view("echoforeach",$data);
    }
        //明細查詢
}