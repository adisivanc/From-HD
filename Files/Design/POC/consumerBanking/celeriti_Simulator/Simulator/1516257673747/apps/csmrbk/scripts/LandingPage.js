apz.csmrbk.landingpage = {};
apz.csmrbk.landingpage.sCustomerToken = "";
apz.csmrbk.landingpage.sLoanToken = "";
apz.csmrbk.landingpage.sCardToken = "";
apz.csmrbk.landingpage.sCache = {};
apz.app.onLoad_LandingPage = function(params) {
    apz.csmrbk.landingpage.sCache = params;
    apz.csmrbk.landingpage.fnInitialise();
};
/* Business logic to be executed during application initialization goes here */
apz.csmrbk.landingpage.fnInitialise = function() {
    debugger;
    apz.csmrbk.landingpage.fnGetTokens("CeleritiCustomersAPI");
    apz.csmrbk.landingpage.fnGetTokens("CeleritiLoansAPI");
    apz.csmrbk.landingpage.fnGetTokens("CeleritiCardsAPI");
    apz.csmrbk.landingpage.fnGetTokens("CeleritiDepositsAPI");
    var lParams = {
        "appId": "custdb",
        "scr": "Dashboard",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "parentAppId": "csmrbk",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "userName": apz.csmrbk.landingpage.sCache.userId
        }
    };
    apz.launchApp(lParams);
    $(window).click(function() {
        if ($("#sidebar").hasClass("apz-nav-open")) {
            $("#csmrbk__LandingPage__el_btn_1").trigger("click");
        }
    })
};
apz.csmrbk.landingpage.fnGetTokens = function(params) {
    debugger;
    var lServerParams = {
        "ifaceName": "GetToken",
        "buildReq": "N",
        "req": {},
        "paintResp": "N",
        "async": "",
        "callBack": apz.csmrbk.landingpage.fnCallback,
        "callBackObj": "",
    };
    lServerParams.req = {
        "reqDetails": {
            "action": "getToken",
            "tokenType": params
        }
    }
    apz.server.callServer(lServerParams);
};
apz.csmrbk.landingpage.fnClickMenu = function(pthis) {
    debugger;
     $("#sidebar .current").removeClass("current");
     $(pthis).addClass("current");
    $("#csmrbk__LandingPage__el_btn_1").trigger("click");
    var lLaunchParams = {
        "appId": "",
        "scr": "",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "customerId": "12345",
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "accounts": "",
            "custInfo": apz.custdb.dashboard.sCustInfo
        }
    };
    if (pthis.textContent == "Home") {
        lLaunchParams.appId = "custdb";
        lLaunchParams.scr = "Dashboard";
    } else if (pthis.textContent == "Customer Info") {
        // Launch customer information page   
        lLaunchParams.appId = "custpr";
        lLaunchParams.scr = "Profile";
    } else if (pthis.textContent == "Cards") {
        //  Launch Credit card page
        lLaunchParams.appId = "carddt";
        lLaunchParams.scr = "CardSummary";
        var lAccounts = [];
        lAccounts = apz.custdb.dashboard.sCardAcc;
        lLaunchParams.userObj.accounts = lAccounts;
    } else if (pthis.textContent == "Loans") {
        //  Launch Credit card page
        lLaunchParams.appId = "loandt";
        lLaunchParams.scr = "LoanSummary";
        var lAccounts = [];
        lAccounts = apz.custdb.dashboard.sLoanAcc;
        lLaunchParams.userObj.accounts = lAccounts;
    } else if (pthis.textContent == "Standing Order") {
        //  Launch Credit card page
        lLaunchParams.appId = "funtra";
        lLaunchParams.scr = "TransferDetails";
        lAccounts = apz.custdb.dashboard.sDepositAcc;
        lLaunchParams.userObj.accounts = lAccounts;
    } else if (pthis.textContent == "Personalizer") {
        lLaunchParams.appId = "custdb";
        lLaunchParams.scr = "Dashboard";
        lLaunchParams.userObj.widget=true;
        
    }else {
        lLaunchParams = '';
    }
    if (!apz.isNull(lLaunchParams)) {
        apz.launchApp(lLaunchParams);
    }
};
apz.csmrbk.landingpage.fnLogout = function() {
    apz.launchScreen({
        "appId": "csmrbk",
        "scr": "Login"
    });
};
apz.csmrbk.landingpage.fnCallback = function(params) {
    debugger;
    if (params.req.reqDetails.tokenType == "CeleritiCustomersAPI") {
        apz.csmrbk.landingpage.sCustomerToken = params.res.csmrbk__GetToken_Res.tokenDet.access_token;
    } else if (params.req.reqDetails.tokenType == "CeleritiLoansAPI") {
        apz.csmrbk.landingpage.sLoanToken = params.res.csmrbk__GetToken_Res.tokenDet.access_token;
    } else if (params.req.reqDetails.tokenType == "CeleritiCardsAPI") {
        apz.csmrbk.landingpage.sCardToken = params.res.csmrbk__GetToken_Res.tokenDet.access_token;
    } else if (params.req.reqDetails.tokenType == "CeleritiDepositsAPI") {
        apz.csmrbk.landingpage.sDepositToken = params.res.csmrbk__GetToken_Res.tokenDet.access_token;
    }
}
