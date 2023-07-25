apz.carddt.cardAccDetails = {};
apz.carddt.cardAccDetails.sCache = {};
apz.app.onLoad_CardAccDetails = function(params) {
    apz.carddt.cardAccDetails.sCache = params;
    apz.carddt.cardAccDetails.fnInitialize();
}
apz.carddt.cardAccDetails.fnInitialize = function() {
    debugger;
    $("#csmrbk__LandingPage__backCol p ").text("Card Account Summary");
    $("#carddt__CardAccDetails__name_txtcnt").text(apz.carddt.cardAccDetails.sCache.custInfo.customerNameLine1);
    $("#carddt__CardAccDetails__custId_txtcnt").text("Customer Id: " + apz.carddt.cardAccDetails.sCache.custInfo.customerNbr);
    
        var lServerParams = {
            "ifaceName": "GetCardAccount",
            "buildReq": "N",
            "req": {},
            "paintResp": "N",
            "async": "",
            "callBack": apz.carddt.cardAccDetails.fnDbCallback,
            "callBackObj": "",
        };
        lServerParams.req = {
            "reqDetails": {
                "action": "getCardAccount",
                "accNumber": apz.carddt.cardAccDetails.sCache.accountDetails.cardAccNum,
                "token": apz.carddt.cardAccDetails.sCache.tokenObj.cards
            }
        }
        apz.startLoader();
        apz.server.callServer(lServerParams);
    apz.data.loadData("GetCardAccount", "carddt");
    apz.data.loadData("CardSummary", "carddt");
    apz.data.scrdata.carddt__CardOverview_Res = {
        "Overview": [{
            "label": "Available Amount- $"+apz.data.scrdata.carddt__GetCardAccount_Res.getCardAccDet.financialInfo.availableCreditAmt,
            "value": apz.data.scrdata.carddt__GetCardAccount_Res.getCardAccDet.financialInfo.availableCreditAmt
        }, {
            "label": "Utilized Amount- $"+apz.data.scrdata.carddt__GetCardAccount_Res.getCardAccDet.financialInfo.currentBalanceAmt,
            "value": Math.abs(apz.data.scrdata.carddt__GetCardAccount_Res.getCardAccDet.financialInfo.currentBalanceAmt)
        }]
    };
    apz.data.loadData("CardOverview", "carddt");
    $("#carddt__CardAccDetails__cardSummaryList li.srb").attr("onclick", "apz.carddt.cardAccDetails.fnCardTransaction(this)");
  $("#carddt__GetCardAccount__o__financialInfo__minimumPaymentAmt").text("$ "+$("#carddt__GetCardAccount__o__financialInfo__minimumPaymentAmt").text());
    $("#carddt__GetCardAccount__o__financialInfo__currentBalanceAmt").text("$ "+$("#carddt__GetCardAccount__o__financialInfo__currentBalanceAmt").text());
    $("#carddt__GetCardAccount__o__financialInfo__availableCashAmt").text("$ "+$("#carddt__GetCardAccount__o__financialInfo__availableCashAmt").text());
    var lSplitVal = $("#carddt__GetCardAccount__o__financialInfo__lastStatementDt").text().split("-");
    var lFinalVal = lSplitVal[1]+"/"+lSplitVal[2]+"/"+lSplitVal[0];
    $("#carddt__GetCardAccount__o__financialInfo__lastStatementDt").text(lFinalVal);
    $("#carddt__GetCardAccount__o__financialInfo__availableCreditAmt").text("$ "+$("#carddt__GetCardAccount__o__financialInfo__availableCreditAmt").text());
}
apz.carddt.cardAccDetails.fnDbCallback = function(params) {
    debugger;
    apz.stopLoader();
    if (params.req.reqDetails.action == "getCardAccount") {
        apz.data.scrdata.carddt__GetCardAccount_Res = {};
        apz.data.scrdata.carddt__GetCardAccount_Res.getCardAccDet = params.res.carddt__GetCardAccount_Res.getCardAccDet;
        apz.data.scrdata.carddt__CardSummary_Res = {};
        apz.data.scrdata.carddt__CardSummary_Res.cardInfo = params.res.carddt__GetCardAccount_Res.getCardAccDet.cardInfo;
        apz.data.scrdata.carddt__GetCardAccount_Res.getCardAccDet.financialInfo.currentBalanceAmt = Math.abs(apz.data.scrdata.carddt__GetCardAccount_Res.getCardAccDet.financialInfo.currentBalanceAmt)
    }
}
apz.carddt.cardAccDetails.fnCardTransaction = function(pthis) {
    debugger;
    var lIndex = $(pthis).attr("rowno");
    var lParams = {
        "scr": "CardTransaction",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "cardDetails": apz.data.scrdata.carddt__CardSummary_Res.cardInfo[lIndex],
"accNumber": apz.carddt.cardAccDetails.sCache.accountDetails.cardAccNum,
        }
    };
    apz.launchSubScreen(lParams);
}

apz.carddt.cardAccDetails.fnBack = function(){
     var lParams = {
        "scr": "CardSummary",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
"accounts": apz.custdb.dashboard.sCardAcc,

            "custInfo": apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchSubScreen(lParams);
}
