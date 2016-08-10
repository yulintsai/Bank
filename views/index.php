<!DOCTYPE html>
<html>
    <head>
        <?php $this->js("jquery-3.0.0");?>
        <?php $this->js("account");?>
    </head>
    <body>
        <H1><?php echo $_SESSION['account']."'s ";?>Bank</H1>
        <button id='Balance'>餘額查詢</button><br>
        <button id='Dispense'>出款</button><br>
        <button id='Deposit'>入款</button><br>
        <button id='Details'>帳目明細</button><br>
        <button id='Logout'>登出</button>
    </body>
</html>
