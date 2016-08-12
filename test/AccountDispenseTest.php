<?php

require_once '/home/ubuntu/workspace/Bank/core/Server.php';
require_once '/home/ubuntu/workspace/Bank/models/Account.php';

class AccountDispenseTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalDispense()
    {
        $Account = new Account();
        $_SESSION['account']='1';
        $result = $Account->doDispense(500, "正常領出測試");
        $this -> assertEquals("", $result);
    }

    public function testBust()
    {
        $Account = new Account();
        $_SESSION['account']='1';
        $result = $Account->doDispense(5000000000000, "超額領出測試");
        $this -> assertEquals("餘額不足", $result);
    }
}
