<?php

require_once '/home/ubuntu/workspace/Bank/index.php';
require_once '/home/ubuntu/workspace/Bank/models/Account.php';

class IntoAccountTest extends \PHPUnit_Framework_TestCase
{
    public function testIntoAccountTrue()
    {
        $Account = new Account();
        $account = 1;
        $result = $Account->intoAccount($account);
        $this -> assertEquals("setAccount $account OK", $result);
    }

    public function testIntoAccountFalse()
    {
        $Account = new Account();
        $result = $Account->intoAccount(100);
        $this -> assertEquals("No account", $result);
    }

    public function testLogout()
    {
        $Account = new Account();
        $result = $Account->logout();
        $this -> assertEquals("Logout Success", $result);
    }
}