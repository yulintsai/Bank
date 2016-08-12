<?php

require_once '/home/ubuntu/workspace/Bank/index.php';
require_once '/home/ubuntu/workspace/Bank/models/Account.php';

class AccountBalanceTest extends \PHPUnit_Framework_TestCase
{
    public function testSearchAccountBalance()
    {
        $Account = new Account();
        $Account->intoAccount(999);
        $result = $Account->searchBalance();
        $this -> assertEquals(888, $result);
    }
}