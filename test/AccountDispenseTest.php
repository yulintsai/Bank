<?php

require_once '/home/ubuntu/workspace/Bank/index.php';
require_once '/home/ubuntu/workspace/Bank/controllers/HomeController.php';

class AccountDispenseTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalDispense()
    {
        $_SESSION['account']='123';
        $Home = new HomeController();
        $Home->insertAccountDispense(200, "基本領出");
    }

    public function testBust()
    {
        $_SESSION['account']='123';
        $Home = new HomeController();
        $Home->insertAccountDispense(50000, "超額領出測試");
    }

    public function testFalseInput()
    {
        $_SESSION['account']='123';
        $Home = new HomeController();
        $Home->insertAccountDispense("yoyo",200);
    }
}
