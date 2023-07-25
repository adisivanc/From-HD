apz.chkdpt.ReviewDeposit = {};
apz.app.onLoad_ReviewDeposit = function(params) {
    debugger;
    apz.setElmValue("chkdpt__ReviewDeposit__txtaccount", apz.chkdpt.DepositLauncher.sCache.account);
    apz.setElmValue("chkdpt__ReviewDeposit__txtamount", apz.chkdpt.DepositLauncher.sCache.amount);
    apz.data.scrdata.chkdpt__DepositCheck_Res = {}
    apz.data.scrdata.chkdpt__DepositCheck_Res.CheckList = params.screendata.chkdpt__DepositCheck_Res.CheckList;
    apz.data.loadData("DepositCheck", "chkdpt");
}
apz.chkdpt.ReviewDeposit.fnApprove = function() {
    debugger;
    //apz.chkdpt.DepositLauncher.fnNavigate("DepositConfirmed",{"amount":"","account":""});
    var params = {};
    params.message = "Thank you for depositing your check(s). We wiil review it and notify you when your check(s) has been cleared."
    params.type = "S"
    params.callBack = apz.chkdpt.ReviewDeposit.fnApproveCB;
    apz.dispMsg(params);
}
apz.chkdpt.ReviewDeposit.fnBack = function() {
    debugger;
     var lscrdata = apz.data.buildData("DepositCheck","chkdpt");
    apz.chkdpt.DepositLauncher.fnNavigate("DepositCheck", {
        "amount": apz.chkdpt.DepositLauncher.sCache.amount,
        "account": apz.chkdpt.DepositLauncher.sCache.account,
        "screendata":lscrdata
    });
}
apz.chkdpt.ReviewDeposit.fnApproveCB = function(params) {
    debugger;
    var params = {};
    params.appId = "chkdpt";
    params.scr = "ChkDepositLauncher";
    params.layout = "All";
    params.description = "Remote Check Deposits";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
}
