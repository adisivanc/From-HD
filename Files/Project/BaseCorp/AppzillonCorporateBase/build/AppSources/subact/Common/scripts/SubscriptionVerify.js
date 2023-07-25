apz.subact.SubscriptionVerify = {};
apz.subact.SubscriptionVerify.sparams = {};
apz.app.onLoad_SubscriptionVerify = function(params) {
    debugger;
    apz.setElmValue("subact__SubscriptionVerify__ddlCorpId",params.Corpid);
    apz.setElmValue("subact__SubscriptionVerify__ddlUsers",params.User);
apz.data.loadData("BindMenuItem", "subact");
}

apz.subact.SubscriptionVerify.fndisplayMessage = function()
{
    debugger;
    apz.dispMsg({"message" : "Subscription request has been submitted successfully", "type" : "S" , "callBack" :apz.subact.SubscriptionVerify.fngoBack} )
}

apz.subact.SubscriptionVerify.fngoBack = function()
{
    debugger;
       apz.ACNR01.Navigator.launchApp("ACDB01", "AdminDashboard", "All", "AdminDashboard");
       
       //apz.ACNR01.Navigator.launchApp("subact", "SubscriptionActivation", "All", "SubscriptionActivation");
}
