apz.extacc.ExternalAccountList = {};
apz.app.onLoad_ExternalAccountList = function(params) {
    apz.extacc.ExternalAccountList.fnGetAccountList();
};
apz.extacc.ExternalAccountList.fnGetAccountList = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "ExternalAccounts_Query",
        "buildReq": "N",
        "appId": "extacc",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.extacc.ExternalAccountList.fnGetAccountListCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpExternalAccounts = {};
    req.tbDbmiCorpExternalAccounts.corporateId = apz.Login.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
}
apz.extacc.ExternalAccountList.fnGetAccountListCB = function(params) {
    debugger;
    apz.extacc.ExternalAccountList.acctList = params.res.extacc__ExternalAccounts_Req.tbDbmiCorpExternalAccounts;
}
apz.extacc.ExternalAccountList.fnAddAccount = function() {
    debugger;
    apz.hide("extacc__ExternalAccountList__ExtAcctHeader");
    apz.hide("extacc__ExternalAccountList__MobExtAcctHeader");
    apz.hide("extacc__ExternalAccountList__AccListRow");
    apz.show("extacc__ExternalAccountList__subScreenLauncher");
    var params = {};
    params.appId = "extacc";
    params.scr = "AddExternalAccount";
    params.layout = "All";
    params.div = "extacc__ExternalAccountList__subScreenLauncher";
    apz.launchSubScreen(params);
}

apz.extacc.ExternalAccountList.fnDetail = function(pthis){
    debugger;
    var selectedAcc = [];
    var lrow = $(pthis).attr("rowno");
    var acctlist = apz.extacc.ExternalAccountList.acctList;
    var lacctno = apz.getElmValue("extacc__ExternalAccounts__i__tbDbmiCorpExternalAccounts__accountNumber_"+lrow);
     var lbank = apz.getElmValue("extacc__ExternalAccounts__i__tbDbmiCorpExternalAccounts__bankName_"+lrow);
    for(var i=0;i<acctlist.length;i++){
        if(acctlist[i].accountNumber ==  lacctno && acctlist[i].bankName ==  lbank){
            selectedAcc.push(acctlist[i]);
            break;
        }
    }
     apz.hide("extacc__ExternalAccountList__ExtAcctHeader");
    apz.hide("extacc__ExternalAccountList__MobExtAcctHeader");
    apz.hide("extacc__ExternalAccountList__AccListRow");
    apz.show("extacc__ExternalAccountList__subScreenLauncher");
    var params = {};
    params.appId = "extacc";
    params.scr = "ViewExternalAccount";
    params.layout = "All";
    params.div = "extacc__ExternalAccountList__subScreenLauncher";
    params.userObj = selectedAcc;
    apz.launchSubScreen(params);
    
}