<?php

require_once '/home/ubuntu/workspace/Bank/index.php';
require_once '/home/ubuntu/workspace/Bank/models/Account.php';

class AccountDepositTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalDeposit()
    {
        $Account = new Account();
        $Account->intoAccount(1);
        $result = $Account->doDeposit(50, "基本入款");
        $this -> assertNull($result);
    }

    public function testNegative()
    {
        $Account = new Account();
        $Account->intoAccount(1);
        $result = $Account->doDeposit(-2, "負數測試");
        $this -> assertEquals("金額不能為負", $result);
    }
}
