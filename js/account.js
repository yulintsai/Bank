$(document).ready(function() {
    $("#Balance").click(function(){
        document.location.href = "/Bank/Home/acBalance";
    })
    $("#Dispense").click(function(){
        document.location.href = "/Bank/Home/acDispense";
    })
    $("#Deposit").click(function(){
        document.location.href = "/Bank/Home/acDeposit";
    })
    $("#Details").click(function(){
        document.location.href = "/Bank/Home/acDetails";
    })
     $("#Logout").click(function(){
        document.location.href = "/Bank/Home/logout";
    })
});
