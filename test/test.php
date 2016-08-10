<?php

require_once '/Bank/controller/HomeController.php';

class BankTest extends HomeController
{
    public function testInsertAccountDispense()
    {
        $this->insertAccountDispense(200, "撿到");
    }
}
