<?php
    echo "<table border=1px><tr><td>ID</td><td>Time</td><td>Dispense</td><td>Deposit</td>
          <td>Balance</td><td>Remark</td></tr>";
    foreach ($data as $num => $id) {
        echo "<tr><td>".($num+1)."</td>";
        foreach ($id as $key => $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "<a href='/Bank'>BACK</a>";
