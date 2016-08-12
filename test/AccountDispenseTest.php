<?php
require_once '/home/ubuntu/workspace/Bank/index.php';
require_once '/home/ubuntu/workspace/Bank/models/Account.php';

class AccountDispenseTest extends \PHPUnit_Framework_TestCase
{
    private $Account;

    public function __construct()
    {
        $this->Account = new Account();
    }

    public function testNormalDispense()
    {
        $_SESSION['account']='1';
        $reslut = $this->Account->doDispense(200, "基本領出");
        $this -> assertEquals("", $result);
    }

    public function testBust()
    {
        $_SESSION['account']='1';
        $result = $this->Account->doDispense(50000, "超額領出測試");
        $this -> assertEquals("餘額不足", $result);
    }

    public function testInputMoney()
    {
        $_SESSION['account']='1';
        $result = $this->Account->doDispense("fwqfw", "非數字測試");
        $this -> assertEquals("", $result);
    }
}
