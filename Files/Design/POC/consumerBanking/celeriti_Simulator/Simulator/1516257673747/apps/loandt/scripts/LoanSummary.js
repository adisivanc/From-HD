apz.loandt = {};
apz.loandt.loanSummary = {};
apz.loandt.loanSummary.sCache = {};

apz.app.onLoad_LoanSummary = function(params) {
    
    apz.loandt.loanSummary.sCache = params;
    apz.loandt.loanSummary.fnInitialize();
}

apz.loandt.loanSummary.fnInitialize = function(){
    debugger;
    $("#csmrbk__LandingPage__backCol").css("visibility","visible");
    $("#csmrbk__LandingPage__backCol p").text("Home");
    $("#loandt__LoanSummary__name_txtcnt").text(apz.loandt.loanSummary.sCache.custInfo.customerNameLine1);
    $("#loandt__LoanSummary__custId_txtcnt").text("Customer Id :"+apz.loandt.loanSummary.sCache.custInfo.customerNbr);
    $("#loandt__LoanSummary__mob_txtcnt").text("Mob: "+apz.loandt.loanSummary.sCache.custInfo.homePhoneNbr);
    $("#loandt__LoanSummary__email_txtcnt").text("Email : "+apz.loandt.loanSummary.sCache.custInfo.emailAddress);
    apz.data.scrdata.loandt__LoanSummary_Res = {};
    apz.data.scrdata.loandt__LoanSummary_Res.loanAccs = [];
    apz.data.scrdata.loandt__LoanSummary_Res.loanAccs = apz.loandt.loanSummary.sCache.accounts;
    apz.data.loadData("LoanSummary","loandt");
    $("#loandt__LoanSummary__loanAccList li").attr("onclick","apz.loandt.loanSummary.fnLoadAccountDetails(this)");
};

apz.loandt.loanSummary.fnLoadAccountDetails = function(pthis){
    debugger;
    var lLoanNum = $(pthis).find(".accNum").text();
    var lAccType = $(pthis).find(".accType").text();
    var lParams = {
        "scr": "LoanAccDetails",
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
                "loanAccNum":lLoanNum,
                "loanAccType":lAccType
            },
            "custInfo":apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchSubScreen(lParams);
}
