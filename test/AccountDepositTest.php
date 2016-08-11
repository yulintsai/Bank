<?php

require_once '/home/ubuntu/workspace/Bank/index.php';
require_once '/home/ubuntu/workspace/Bank/controllers/HomeController.php';

class AccountDepositTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalDeposit()
    {
        $_SESSION['account']='123';
        $Home = new HomeController();
        $Home->insertAccountDeposit(20000, "基本入款");
    }

    public function testNegativeInput()
    {
        $_SESSION['account']='123';
        $Home = new HomeController();
        $Home->insertAccountDeposit(-50000, "入款負數測試");
    }

    public function testFalseInput()
    {
        $_SESSION['account']='123';
        $Home = new HomeController();
        $Home->insertAccountDeposit("yoyo",200);
    }

    public function testzeroInput()
    {
        $_SESSION['account']='123';
        $Home = new HomeController();
        $Home->insertAccountDispense("00000","zero");
    }
}
