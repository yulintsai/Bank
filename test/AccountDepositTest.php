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
        $Account->showDetails();
        $this -> assertEquals("", $result);
    }

    public function testNegative()
    {
        $Account = new Account();
        $Account->intoAccount(1);
        $result = $Account->doDeposit("HI", "負數測試");
        $this -> assertEquals("金額必須為數字", $result);
    }
}
