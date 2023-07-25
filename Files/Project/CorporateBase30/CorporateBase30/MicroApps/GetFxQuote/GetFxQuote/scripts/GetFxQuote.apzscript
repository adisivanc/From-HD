apz.getfxq.GetFxQuote = {};
apz.getfxq.GetFxQuote.exchangeRate = "";
apz.app.onLoad_GetFxQuote = function(params) {
    debugger;
    apz.getfxq.GetFxQuote.sCache = params;
    $("body").removeClass("landingby");
    if(params.MO_FX_RATE_REQUEST){
       apz.data.buildData();
       apz.data.scrdata.getfxq__GetFxQuote_Res = {};
       apz.data.scrdata.getfxq__GetFXQuote_Req.MO_FX_RATE_REQUEST={};
       apz.data.scrdata.getfxq__GetFXQuote_Req.MO_FX_RATE_REQUEST=params.MO_FX_RATE_REQUEST;
       apz.data.loadData("GetFXQuote","getfxq");
       setTimeout(function(){
            apz.getfxq.GetFxQuote.fnExchangeRate();    
       },200)
       
    }
    apz.getfxq.GetFxQuote.fnGetExchangerate();
    
}

apz.getfxq.GetFxQuote.fnRequestQuotes = function() {
    debugger;
  
    //apz.data.loadJsonData("GetFxQuote","getfxq");
    
    var quotelist = JSON.parse(apz.getFile(apz.getDataFilesPath("getfxq") + "/GetFxQuote.json"));
    apz.data.scrdata.getfxq__GetFxQuote_Req = {
        MO_FX_RATE_REQUEST: quotelist
    }
    apz.data.loadData("MO_FX_RATE_REQUEST", "getfxq");
    
    apz.getfxq.GetFxQuote.fnAfterServerCall();
   
};

apz.getfxq.GetFxQuote.fnAfterServerCall = function() {
    debugger;
    if ( apz.data.scrdata.getfxq__GetFxQuote_Req.MO_FX_RATE_REQUEST != null) {
        let quoteInfo =  apz.data.scrdata.getfxq__GetFxQuote_Req.MO_FX_RATE_REQUEST;
        $("#getfxq__GetFxQuote__gr_col_1").removeClass('sno');
        if(apz.getElmValue("getfxq__GetFxQuote__tglMarket") == "mar"){
            $("#getfxq__GetFxQuote__ExchangeRate")[0].innerText = apz.getElmValue("getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__RATE");
        }
        else{
            $("#getfxq__GetFxQuote__ExchangeRate")[0].innerText = quoteInfo.getfxq__GetFxQuote_Req.MO_FX_RATE_REQUEST.RATE;
        }
        
        $("#getfxq__GetFxQuote__Ex_Trn_Ref")[0].innerText = quoteInfo.getfxq__GetFxQuote_Req.MO_FX_RATE_REQUEST.EXTRNL_TXN_REF;
        $("#getfxq__GetFxQuote__valDate")[0].innerText = apz.getElmValue("getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__VALUE_DATE");
        var Dates = new Date().toString().split(" ");
        
        $("#getfxq__GetFxQuote__tranDate")[0].innerText = Dates[2]+"-"+Dates[1]+"-"+Dates[3];
        
        $('html, body').animate({
                    scrollTop: ($("#getfxq__GetFxQuote__gr_col_1").offset().top)+200
        }, 2000);
        
    }
}

apz.getfxq.GetFxQuote.fnGetExchangerate = function() {
    debugger;

    apz.data.loadJsonData("ExchangeRate","getfxq");
   apz.getfxq.GetFxQuote.fnGetExchangerateCB();
}

apz.getfxq.GetFxQuote.fnGetExchangerateCB = function(){
    debugger;
    apz.getfxq.GetFxQuote.exchangeRate =  apz.data.scrdata.getfxq__ExchangeRate_Res;
    

}

apz.getfxq.GetFxQuote.fnExchangeRate = function(){
    debugger;
    var fCur = apz.getElmValue("getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__CRNCY1");
    var tCur = apz.getElmValue("getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__CRNCY2");
    var getCur = fCur+"-"+tCur;
    var RateArr = apz.getfxq.GetFxQuote.exchangeRate;
    var optionType = apz.getElmValue("getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__BUY_SELL_FLAG");
    
    if(!apz.isNull(fCur) && !apz.isNull(tCur)){
        let lfilterCurrency = jQuery.grep(RateArr, function(lrateObj ) {
            return lrateObj.CurrencyCode == getCur;
        });
        if(!apz.isNull(lfilterCurrency[0])){
            if(optionType == "1"){
                   // apz.setElmValue("getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__RATE",lfilterCurrency[0].BuyRate);
                   $("#getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__RATE").text(lfilterCurrency[0].BuyRate)
            }else{
                    //apz.setElmValue("getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__RATE",lfilterCurrency[0].SellRate);
                    $("#getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__RATE").text(lfilterCurrency[0].SellRate)
            }
        }
    }
}

apz.getfxq.GetFxQuote.fnBackToHome = function() {
    debugger;
    var lauchParams = {
        "appId": "exrate",
        "scr": "ExchangeRate",
        "div": apz.getfxq.GetFxQuote.sCache.destroyDiv,
        "userObj": {
            "destroyDiv": apz.getfxq.GetFxQuote.sCache.destroyDiv,
            "parentAppId": apz.getfxq.GetFxQuote.sCache.parentAppId,
            "username": apz.getfxq.GetFxQuote.sCache.username
        }
    }
    apz.launchApp(lauchParams);
}
apz.getfxq.GetFxQuote.fnConfirmQuotes = function() {
    debugger;
    
}
apz.getfxq.GetFxQuote.fnCancelQuotes = function() {
    debugger;
}
apz.getfxq.GetFxQuote.fnToggleMarket = function() {
    var lval = apz.getElmValue("getfxq__GetFxQuote__tglMarket");
    console.log(lval);
    if (lval == "mar") {
        $("#getfxq__GetFxQuote__TradeBtn_txtcnt").text("Trade");
        $("#getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__RATE_ul").removeClass("sno");
    } else {
        $("#getfxq__GetFxQuote__TradeBtn_txtcnt").text("Get Quote");
        $("#getfxq__GetFXQuote__i__MO_FX_RATE_REQUEST__RATE_ul").addClass("sno");
    }
}
