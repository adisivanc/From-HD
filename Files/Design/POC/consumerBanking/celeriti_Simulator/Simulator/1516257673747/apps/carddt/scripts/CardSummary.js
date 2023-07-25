apz.carddt = {};
apz.carddt.cardSummary = {};
apz.carddt.cardSummary.sCache = {};

apz.app.onLoad_CardSummary = function(params) {
    
    apz.carddt.cardSummary.sCache = params;
    apz.carddt.cardSummary.fnInitialize();
}

apz.carddt.cardSummary.fnInitialize = function(){
    debugger;
    $("#carddt__CardSummary__name_txtcnt").text(apz.carddt.cardSummary.sCache.custInfo.customerNameLine1);
    $("#carddt__CardSummary__custId_txtcnt").text("Customer Id :"+apz.carddt.cardSummary.sCache.custInfo.customerNbr);
    $("#carddt__cardSummary__mob_txtcnt").text("Mob: "+apz.carddt.cardSummary.sCache.custInfo.homePhoneNbr);
    $("#carddt__cardSummary__email_txtcnt").text("Email : "+apz.carddt.cardSummary.sCache.custInfo.emailAddress);
    apz.data.scrdata.carddt__CardAccountSummary_Res = {};
    apz.data.scrdata.carddt__CardAccountSummary_Res.cardAccs = [];
    for(i=0;apz.data.scrdata.carddt__CardAccountSummary_Res.cardAccs.length;i++){
        apz.data.scrdata.carddt__CardAccountSummary_Res.cardAccs[i].currentBalanceAmt = Math.abs(apz.data.scrdata.carddt__CardAccountSummary_Res.cardAccs[i].currentBalanceAmt);
    }
    apz.data.scrdata.carddt__CardAccountSummary_Res.cardAccs = apz.carddt.cardSummary.sCache.accounts;
    apz.data.loadData("CardAccountSummary","carddt");
    $("#carddt__CardSummary__cardAccList li .accNum").each(function(){
         $(this).text($(this).text().split("*").join("").split("-").join(""));
    });
    $("#carddt__CardSummary__cardAccList li").attr("onclick","apz.carddt.cardSummary.fnLoadAccountDetails(this)");
};

apz.carddt.cardSummary.fnLoadAccountDetails = function(pthis){
    debugger;
    var lLoanNum = $(pthis).find(".accNum").text();
    var lAccType = $(pthis).find(".accType").text();
    var lParams = {
        "scr": "CardAccDetails",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj":{
                "customer":apz.csmrbk.landingpage.sCustomerToken,
                "loans":apz.csmrbk.landingpage.sLoanToken,
                "cards":apz.csmrbk.landingpage.sCardToken
            },
            "accountDetails":{
                "cardAccNum":lLoanNum,
                "cardAccType":lAccType
            },
            "custInfo":apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchSubScreen(lParams);
}
