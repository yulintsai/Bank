<?php

require_once '/home/ubuntu/workspace/Bank/index.php';
require_once '/home/ubuntu/workspace/Bank/models/Account.php';

class AccountDetailsTest extends \PHPUnit_Framework_TestCase
{
    public function testShowDetails()
    {
        $Account = new Account();
        $Account->intoAccount(999);
        $result = $Account->showDetails();
        $this -> assertEquals("2016-08-12 03:39:30", $result[0]['time']);
        $this -> assertEquals("", $result[0]['dispense']);
        $this -> assertEquals("888", $result[0]['deposit']);
        $this -> assertEquals("888", $result[0]['balance']);
        $this -> assertEquals("", $result[0]['remark']);
    }
}