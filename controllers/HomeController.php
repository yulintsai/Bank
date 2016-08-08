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
    
    public function acDeposit()
    {
        $this ->view("inputView");
        // $do = $this -> model("Account");
        // $do -> doDeposit();
    }
    
    public function acBalance()
    {
        $do = $this -> model("Account");
        $do -> searchBalance();
    }
    
    public function acDetails()
    {
        // $do = $this -> model("Account");
        // $do -> showDetails();
    }
}