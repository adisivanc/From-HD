apz.loandt.loanAccDetails = {};
apz.loandt.loanAccDetails.sCache = {};
apz.app.onLoad_LoanAccDetails = function(params) {
    apz.loandt.loanAccDetails.sCache = params;
    apz.loandt.loanAccDetails.fnInitialize();
}
apz.loandt.loanAccDetails.fnInitialize = function() {
    debugger;
    $("#csmrbk__LandingPage__backCol p ").text("Loan Account Summary");
    $("#loandt__LoanAccDetails__name_txtcnt").text(apz.loandt.loanAccDetails.sCache.custInfo.customerNameLine1);
    $("#loandt__LoanAccDetails__custId_txtcnt").text("Customer Id: " + apz.loandt.loanAccDetails.sCache.custInfo.customerNbr);
    
    
        var lServerParams = {
            "ifaceName": "GetLoanAccount",
            "buildReq": "N",
            "req": {},
            "paintResp": "N",
            "async": "",
            "callBack": apz.loandt.loanAccDetails.fnDbCallback,
            "callBackObj": "",
        };
        lServerParams.req = {
            "reqDetails": {
                "action": "getLoanAccount",
                "loanNumber": apz.loandt.loanAccDetails.sCache.accountDetails.loanAccNum,
                "productCd": apz.loandt.loanAccDetails.sCache.accountDetails.loanAccType,
                "token": apz.loandt.loanAccDetails.sCache.tokenObj.loans
            }
        }
        apz.startSpinner("loandt__LoanAccDetails__ps_pls_10");
        $("#page-body").css("opacity","0.4");
        apz.server.callServer(lServerParams);
        apz.data.loadData("GetLoanAccount", "loandt");
    apz.data.loadData("GetLoanAccount", "loandt");
    $("#loandt__GetLoanAccount__o__loanAccDetails__currencyCd").text("USD");
    var lPaid = parseInt(apz.data.scrdata.loandt__GetLoanAccount_Res.loanAccDetails.originalLoanAmt - apz.data.scrdata.loandt__GetLoanAccount_Res.loanAccDetails.balanceAmt);
    apz.data.scrdata.loandt__LoanOverview_Res = {
        "Overview": [{
            "label": "Outstanding Balance- $"+apz.data.scrdata.loandt__GetLoanAccount_Res.loanAccDetails.balanceAmt,
            "value": apz.data.scrdata.loandt__GetLoanAccount_Res.loanAccDetails.balanceAmt
        }, {
            "label": "Amount Paid- $"+lPaid,
            "value": lPaid
        }]
    };
    apz.data.loadData("LoanOverview", "loandt");
    $("#loandt__GetLoanAccount__o__loanAccDetails__amountDue").text("$ "+$("#loandt__GetLoanAccount__o__loanAccDetails__amountDue").text());
    $("#loandt__GetLoanAccount__o__loanAccDetails__paymentAmt").text("$ "+$("#loandt__GetLoanAccount__o__loanAccDetails__paymentAmt").text());
    $("#loandt__GetLoanAccount__o__loanAccDetails__balanceAmt").text("$ "+$("#loandt__GetLoanAccount__o__loanAccDetails__balanceAmt").text());
    $("#loandt__GetLoanAccount__o__loanAccDetails__originalLoanAmt").text("$ "+$("#loandt__GetLoanAccount__o__loanAccDetails__originalLoanAmt").text());
    var lSplitVal = $("#loandt__GetLoanAccount__o__loanAccDetails__nextDueDt").text().split("-");
    var lFinalVal = lSplitVal[1]+"/"+lSplitVal[2]+"/"+lSplitVal[0];
    $("#loandt__GetLoanAccount__o__loanAccDetails__nextDueDt").text(lFinalVal);
    var lSplitVal = $("#loandt__GetLoanAccount__o__loanAccDetails__originalLoanDt").text().split("-");
    var lFinalVal = lSplitVal[1]+"/"+lSplitVal[2]+"/"+lSplitVal[0];
    $("#loandt__GetLoanAccount__o__loanAccDetails__originalLoanDt").text(lFinalVal);
    var lSplitVal = $("#loandt__GetLoanAccount__o__loanAccDetails__lastPaymentDt").text().split("-");
    var lFinalVal = lSplitVal[1]+"/"+lSplitVal[2]+"/"+lSplitVal[0];
    $("#loandt__GetLoanAccount__o__loanAccDetails__lastPaymentDt").text(lFinalVal);
    $("#loandt__GetLoanAccount__o__loanAccDetails__interestRate").text($("#loandt__GetLoanAccount__o__loanAccDetails__interestRate").text()+".00")
}
apz.loandt.loanAccDetails.fnDbCallback = function(params) {
    debugger;
    apz.stopSpinner("loandt__LoanAccDetails__ps_pls_10");
        $("#page-body").css("opacity","1");
    if (params.req.reqDetails.action == "getLoanAccount") {
        apz.data.scrdata.loandt__GetLoanAccount_Res = {};
        apz.data.scrdata.loandt__GetLoanAccount_Res.loanAccDetails = params.res.loandt__GetLoanAccount_Res.loanAccDetails.loanAccountData;
    }
}
apz.loandt.loanAccDetails.fnLoanPayment = function() {
    var lParams = {
        "scr": "LoanPayment",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "accountDetails": {
                "loanAccNum": apz.loandt.loanAccDetails.sCache.accountDetails.loanAccNum,
                "loanAccType": apz.loandt.loanAccDetails.sCache.accountDetails.loanAccType
            },
            "custInfo": apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchSubScreen(lParams);
}


apz.loandt.loanAccDetails.fnBack = function(){
    var lParams = {
        "scr": "LoanSummary",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "accounts": apz.custdb.dashboard.sLoanAcc,
            "custInfo": apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchSubScreen(lParams);
};
