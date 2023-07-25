apz.acdp01 = {};
apz.acdp01.DepositLauncher = {};
apz.app.onLoad_DepositLauncher = function(userObj) {
    apz.acdp01.DepositLauncher.sparams = userObj;
    
      if(apz.acdp01.DepositLauncher.sparams.from == "OmniSearch"){
        apz.acdp01.DepositLauncher.fnLaunchDeposit();
    }
    
    else{
    
    var params = {};
    params.appId = "acdp01";
    params.scr = "DepositSummary";
    params.div = "acdp01__DepositLauncher__DepositLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
    }
};
apz.acdp01.DepositLauncher.fnLaunchDeposit = function() {
    debugger;
    apz.hide("acdp01__DepositLauncher__gr_row_1");
    var params = {};
    params.appId = "acdp01";
    params.scr = "Deposits";
    params.div = "acdp01__DepositLauncher__DepositLauncher";
    params.layout = "All";
    
     if(apz.acdp01.DepositLauncher.sparams.from == "OmniSearch"){
        params.userObj = apz.acdp01.DepositLauncher.sparams;
    }
    apz.launchSubScreen(params);
};