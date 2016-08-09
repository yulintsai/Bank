<?php

class DataFilter
{

    public function test_input($data = Array()) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
        //過濾Input
}
