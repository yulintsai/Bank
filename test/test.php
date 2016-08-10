<?php

require_once '../core/Controller.php';
require_once '../controllers/HomeController.php';


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
