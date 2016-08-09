$(document).ready(function() {
    $("#Balance").click(function(){
        document.location.href = "/Bank/Home/searchAccountBalance";
    })
    $("#Dispense").click(function(){
        document.location.href = "/Bank/Home/insertAccountDispense";
    })
    $("#Deposit").click(function(){
        document.location.href = "/Bank/Home/insertAccountDeposit";
    })
    $("#Details").click(function(){
        document.location.href = "/Bank/Home/searchAccountDetails";
    })
     $("#Logout").click(function(){
        document.location.href = "/Bank/Home/logout";
    })
});
