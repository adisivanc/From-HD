apz.chkdpt.DepositLauncher = {};
apz.chkdpt.DepositLauncher.sCache = {}
apz.app.onLoad_ChkDepositLauncher = function(params){
    debugger;
    if (apz.deviceGroup == "Mobile") {
          apz.chkdpt.DepositLauncher.fnNavigate("DepositCheckMobile",params);
    }
    
    else{
          apz.chkdpt.DepositLauncher.fnNavigate("DepositCheck",params);
    }
  
}

apz.chkdpt.DepositLauncher.fnNavigate = function(scr,params){
    debugger;
    var lparams = {};
    lparams.appId = "chkdpt";
     lparams.scr = scr;
     lparams.div = "chkdpt__ChkDepositLauncher__depositLauncher";
      lparams.layout = "All";
      lparams.userObj = params
      apz.launchSubScreen(lparams);
}
