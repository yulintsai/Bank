<?php

require_once '/Bank/controller/HomeController.php';

class BankTest extends HomeController
{
    public function testInsertAccountDispense()
    {
        $this->insertAccountDispense(500, "保險");
    }

    public function testInsertAccountDeposit()
    {
        $this->insertAccountDeposit(30000, "薪水");
    }

    public function testSearchAccountBalance()
    {
        $this->searchAccountBalance();
    }

    public function testSearchAccountDetails()
    {
        $this->searchAccountDetails();
    }
}
