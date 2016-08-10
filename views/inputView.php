<?php
$this->js('jquery-3.0.0');
$this->js('account');
echo "<h1>$data</h1>"
?>
    出/入款：<input type="number" id="Money" name="Money"/>台幣<br>
    備註：<input type="text" id="Remark" name="Remark"/><br>
　　　　　<input type="submit" id="submit" name="Submit"/>
　　　　　<input type="hidden" id='status' value='<?php echo $data;?>'/>
<a href='/Bank'>BACK</a>
