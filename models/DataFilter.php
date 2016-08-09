<?php

class DataFilter
{
				//過濾Input
    public function test_input($data = Array()) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

}
