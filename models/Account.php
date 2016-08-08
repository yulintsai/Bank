<?php
class Account
{
    public function __construct()
    {
        Server::pdoConnect();
    }
    public function doDispense($Dispense)
    {

    }
       //收款
    
    public function doDeposit()
    {

    }  
       //入款
    
    public function searchBalance()
    {

    }   //查詢餘額
    
    public function showDetails()
    {

    }
        //查詢明細
}