<?php
    foreach ($data as $Num => $ID) {
        foreach ($ID as $key => $value) {
        echo $key." : ".$value;
        }
        echo "<br>";
    }