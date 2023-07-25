apz.chkdpt.DepositConfirmed = {};

apz.app.onLoad_DepositConfirmed = function(params){
    debugger;
  "chkdpt__DepositConfirmed__amount_txtcnt"
  "chkdpt__DepositConfirmed__account_txtcnt"
  "chkdpt__DepositConfirmed__imgfront"
  "chkdpt__DepositConfirmed__imgback"
   apz.setElmValue("chkdpt__DepositConfirmed__amount_txtcnt",apz.chkdpt.DepositLauncher.sCache.amount);
  apz.setElmValue("chkdpt__DepositConfirmed__account_txtcnt",apz.chkdpt.DepositLauncher.sCache.account);
   $("#chkdpt__DepositConfirmed__imgfront").attr("src", ("data:image/png;base64," +apz.chkdpt.DepositLauncher.sCache.frontImg));
   $("#chkdpt__DepositConfirmed__imgback").attr("src", ("data:image/png;base64," +apz.chkdpt.DepositLauncher.sCache.backImg));
};
apz.chkdpt.DepositConfirmed.done = function(){
    var params = {};
    params.appId = "chkdpt";
    params.scr = "ChkDepositLauncher";
    params.layout = "All";
    params.description = "Remote Check Deposits";
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
};
