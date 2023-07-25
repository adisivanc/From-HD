apz.extacc.ViewExternalAccount = {};
apz.app.onLoad_ViewExternalAccount = function(params) {
    debugger;
    //apz.extacc.ExternalAccountList.fnGetAccountList();
    //apz.extacc.ViewExternalAccount.sTaskObj = params;
    apz.data.scrdata.extacc__ExternalAccounts_Req.tbDbmiCorpExternalAccounts = params;
    apz.data.loadData("ExternalAccounts", "extacc");
};

apz.extacc.ViewExternalAccount.fnCancel = function(){
    debugger;
    
    apz.show("extacc__ExternalAccountList__ExtAcctHeader");
    apz.show("extacc__ExternalAccountList__MobExtAcctHeader");
    apz.show("extacc__ExternalAccountList__AccListRow");
    apz.hide("extacc__ExternalAccountList__subScreenLauncher");
    apz.extacc.ExternalAccountList.fnGetAccountList();
}