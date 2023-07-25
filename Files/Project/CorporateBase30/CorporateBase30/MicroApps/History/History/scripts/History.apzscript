apz.fxhist.History = {};
apz.app.onLoad_History = function(params) {
    apz.fxhist.History.sCache = params;
    apz.fxhist.History.fnBeforeCAllServer("TradeHistory");
    $("body").removeClass("landingby");
};
apz.fxhist.History.fnBeforeCAllServer = function(ifacename) {
    debugger;
   
    apz.data.loadJsonData("TradeHistory","fxhist");
    apz.fxhist.History.fnAfterServerCall();
   
};
apz.fxhist.History.fnAfterServerCall = function() {
    debugger;
  
    var lHistoryList =   apz.data.scrdata.fxhist__TradeHistory_Res.MO_FX_RATE_REQ_LIST_OUT;
    var lHistoryListLen = lHistoryList.length;
    for (var i = 0; i < lHistoryListLen; i++) {
        var lType = lHistoryList[i].BANK_OPN_TYPE;
        if (lType == 1) {
            lHistoryList[i].BANK_OPN_TYPE = "BUY";
            lHistoryList[i].BUYSELLIMG = "buy.svg";
        } else if (lType == 2) {
            lHistoryList[i].BANK_OPN_TYPE = "SELL";
            lHistoryList[i].BUYSELLIMG = "sell.svg";
        }
        if (lHistoryList[i].IS_CANCELLATION != 0) {
            lHistoryList[i].STATUS = "CANCELLED";
        } else if (lHistoryList[i].IS_SETTLEMENT != 0) {
            lHistoryList[i].STATUS = "CONFIRMED";
            lHistoryList[i].SQUARE_OFF = "icon-transfer";
        } else if (lHistoryList[i].IS_CANCELLATION == 0 && lHistoryList[i].IS_SETTLEMENT == 0) {
            lHistoryList[i].STATUS = "PENDING";
        }
    }
    apz.data.loadData("TradeHistory", "fxhist");
};
apz.fxhist.History.fnGoBack = function() {
    var lauchParams = {
        "appId": "exrate",
        "scr": "ExchangeRate",
        "div": apz.fxhist.History.sCache.destroyDiv,
        "userObj": {
            "destroyDiv": apz.fxhist.History.sCache.destroyDiv,
            "parentAppId": apz.fxhist.History.sCache.parentAppId,
            "username": apz.fxhist.History.sCache.username
        }
    }
    apz.launchApp(lauchParams);
};
apz.fxhist.History.getMoreInfo = function(pobj) {
    debugger;
    //  $("#fxhist__History__moreInfo_row").addClass("sno");
    $($($(pobj).parent().parent()[0]).siblings()[0]).toggleClass("sno");
}
apz.fxhist.History.fnGoToBuySellScreen = function() {
    var lauchParams = {
        "appId": "getfxq",
        "scr": "GetFxQuote",
        "div": apz.fxhist.History.sCache.destroyDiv,
        "userObj": {
            "destroyDiv": apz.fxhist.History.sCache.destroyDiv,
            "parentAppId": apz.fxhist.History.sCache.parentAppId,
            "username": apz.fxhist.History.sCache.username
        }
    }
    apz.launchApp(lauchParams);
};
apz.fxhist.History.fnSearchRecords = function() {
    var lval = apz.getElmValue("fxhist__History__el_ipb_1");
    apz.searchRecords("fxhist__History__ct_lst_1", lval);
};
apz.fxhist.History.squareOff = function(pObj) {
    debugger;
    if ($(pObj).hasClass("icon-transfer")) {
        let lrowNo = $(pObj).closest("li").attr("rowno");
        let lcurrentTrade = apz.data.scrdata.fxhist__TradeHistory_Res.MO_FX_RATE_REQ_LIST_OUT[lrowNo];
        let buySellflage = (lcurrentTrade.BANK_OPN_TYPE == "BUY" ? 2 : 1);
        let lcurrentTradeSquareOffObj = {
            "BUY_SELL_FLAG": buySellflage,
            "CRNCY1": lcurrentTrade.CNTR_CRNCY,
            "CRNCY2": lcurrentTrade.ORIG_CRNCY,
            "CRNCY1_AMOUNT": lcurrentTrade.DEAL_AMT,
            "VALUE_DATE": lcurrentTrade.VAL_DT
        }
        let lauchParams = {
            "appId": "getfxq",
            "scr": "GetFxQuote",
            "div": apz.fxhist.History.sCache.destroyDiv,
            "userObj": {
                "destroyDiv": apz.fxhist.History.sCache.destroyDiv,
                "parentAppId": apz.fxhist.History.sCache.parentAppId,
                "username": apz.fxhist.History.sCache.username,
                "MO_FX_RATE_REQUEST": lcurrentTradeSquareOffObj
            }
        }
        apz.launchApp(lauchParams);
    }
};
