apz.exrate.ExchangeRate = {};
apz.app.onLoad_ExchangeRate = function(params) {
    debugger;
    apz.exrate.ExchangeRate.sCache = params;
    apz.exrate.ExchangeRate.fnInitialize();
    $("#baseap__BaseApp__showusername").text(apz.exrate.ExchangeRate.sCache.username);
    $("#header").show();
    $("#exrate__ExchangeRate__ratetableul_ttl").remove();
    $("body").removeClass("loginby");
    $("body").addClass("landingby");
}
apz.exrate.ExchangeRate.fnInitialize = function() {
    apz.exrate.ExchangeRate.fnGetRates();
}
apz.exrate.ExchangeRate.fnGetRates = function() {
    debugger;
    
   
   apz.data.loadJsonData("ExchangeRateMap","exrate");

apz.exrate.ExchangeRate.fnGetRatesCB({});

}
apz.exrate.ExchangeRate.launchSubScreen = function(scrName) {
    debugger;
    var lauchParams = {
        "appId": "fxhist",
        "scr": "History",
        "div": "ACNR01__Navigator__launchPad",
        "userObj": {
            "destroyDiv": "ACNR01__Navigator__launchPad",
           "parentAppId": apz.exrate.ExchangeRate.sCache.parentAppId,
            "username": apz.exrate.ExchangeRate.sCache.username
        }
    }
    apz.launchApp(lauchParams);
}

apz.exrate.ExchangeRate.launchBuySell = function() {
    debugger;
    var lauchParams = {
        "appId": "getfxq",
        "scr": "GetFxQuote",
        "div": "ACNR01__Navigator__launchPad",
        "userObj": {
            "destroyDiv": "ACNR01__Navigator__launchPad",
            "parentAppId": apz.exrate.ExchangeRate.sCache.parentAppId,
            "username": apz.exrate.ExchangeRate.sCache.username
        }
    }
    apz.launchApp(lauchParams);
}
apz.exrate.ExchangeRate.fnGetRatesCB = function(params) {
    debugger;
    var length = apz.data.scrdata.exrate__ExchangeRateMap_Res.length;
    for (i = 0; i < length; i++) {
        buyrate = apz.exrate.ExchangeRate.fnConvertdata($("#exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__BuyRate_" + (i) + "_txtcnt").html());
        sellrate = apz.exrate.ExchangeRate.fnConvertdata($("#exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__SellRate_" + (i) + "_txtcnt").html());
        $("#exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__BuyRate_" + (i) + "_txtcnt").html(buyrate.fontcolor("#1BAD01"));
        $("#exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__SellRate_" + (i) + "_txtcnt").html(sellrate.fontcolor("#1BAD01"));
        
        $("#exrate__ExchangeRate__ExchangeRatelist_row_"+i).find("#exrate__ExchangeRate__monthRow_row").css("display","none");
       
        
    }
     $("#exrate__ExchangeRate__ExchangeRatelist>ul>li").prop("onclick",null).off("click");
    //exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__SellRate_0_txtcnt
    setInterval(apz.exrate.ExchangeRate.fnRefreshRow, 10000);
    
    
   
};
apz.exrate.ExchangeRate.fnConvertdata = function(data) {
    var sup = data.slice(0, 4);
    var main = data.slice(4, 6);
    var sub = data.slice(6);
    return` <sup>${sup}</sup><b>${main}</b><sub>${sub}</sub> `;
};
apz.exrate.ExchangeRate.fnRefreshRow = function() {
    
    rows = $("#exrate__ExchangeRate__ExchangeRatelist>ul>li"),
    randomRowIndex = Math.floor(Math.random() * rows.length),
    randomRow = rows.eq(randomRowIndex),
    randomNumber = Math.floor(Math.random() * 10) - 5;
    var originalBuyRate = randomRow.find("#exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__BuyRate_" + randomRowIndex + "_txtcnt").text(),
        originalSellRate = randomRow.find("#exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__SellRate_" + randomRowIndex + "_txtcnt").text(),
        buyRateDelta = '0.000' + Math.abs(randomNumber) + '0';
    if (randomNumber < 0) {
        buyRateDelta = '-0.000' + Math.abs(randomNumber) + '0';
    }
    var buyRate = ((+originalBuyRate) + (+buyRateDelta)).toFixed(5);
    var sellRateDelta = (buyRateDelta - "0.00006").toFixed(5),
        sellRate = ((+originalSellRate) + (+sellRateDelta)).toFixed(5);
        sellRate = apz.exrate.ExchangeRate.fnConverRate(sellRate+"");
        buyRate = apz.exrate.ExchangeRate.fnConverRate(buyRate+"");
    var computedSellRate = apz.exrate.ExchangeRate.fnConvertdata(sellRate),
        computedBuyRate = apz.exrate.ExchangeRate.fnConvertdata(buyRate);
    if ((+buyRateDelta) == 0) {
        buyRateDelta = computedBuyRate.fontcolor("#1BAD01");
        sellRateDelta = computedSellRate.fontcolor("#1BAD01");
    } else if ((+buyRateDelta) > 0) {
        buyRateDelta = computedBuyRate.fontcolor("#1BAD01");
        sellRateDelta = computedSellRate.fontcolor("#1BAD01");
         
    } else {
        buyRateDelta = computedBuyRate.fontcolor("#F50000");
        sellRateDelta = computedSellRate.fontcolor("#F50000");
    }
   
    
   
    let buyText = randomRow.find("#exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__BuyRate_" + randomRowIndex + "_txtcnt").html(buyRateDelta);
    let sellText = randomRow.find("#exrate__ExchangeRateMap__o__exrate__ExchangeRateMap_Res__SellRate_" + randomRowIndex + "_txtcnt").html(sellRateDelta);
    apz.exrate.ExchangeRate.BlinkEffect(buyText);
    apz.exrate.ExchangeRate.BlinkEffect(sellText);
   
}

apz.exrate.ExchangeRate.fnConverRate = function(rates){
    if((rates.split(".")[0]).length > 1){
        return rates.slice(0,-2);
    }
    else{
        return rates;
    }
}


apz.exrate.ExchangeRate.BlinkEffect = function (pObj){
    pObj.fadeOut('fast').fadeIn("fast").fadeOut('fast').fadeIn("fast").fadeOut('fast').fadeIn("fast");
}

apz.exrate.ExchangeRate.BuyQuote = function(pObj){
    debugger;
        let lrowNo=$(pObj).closest("li").attr("rowno"); 
        let lcurrentTrade = apz.data.scrdata.exrate__ExchangeRateMap_Res[lrowNo];
        let lcurrentTradeObj = {
                "BUY_SELL_FLAG":1,
                "CRNCY1":lcurrentTrade.CurrencyCode.split("-")[0],
                "CRNCY2":lcurrentTrade.CurrencyCode.split("-")[1],
                "CRNCY1_AMOUNT":0.00,
        }
        apz.exrate.ExchangeRate.buyOrSellQuote(lcurrentTradeObj);
}

apz.exrate.ExchangeRate.SellQuote= function(pObj){
    debugger;
        let lrowNo=$(pObj).closest("li").attr("rowno"); 
        let lcurrentTrade = apz.data.scrdata.exrate__ExchangeRateMap_Res[lrowNo];
        let lcurrentTradeObj = {
                "BUY_SELL_FLAG":2,
                "CRNCY1":lcurrentTrade.CurrencyCode.split("-")[0],
                "CRNCY2":lcurrentTrade.CurrencyCode.split("-")[1],
                "CRNCY1_AMOUNT":0.00,
        }
       apz.exrate.ExchangeRate.buyOrSellQuote(lcurrentTradeObj);
}


apz.exrate.ExchangeRate.buyOrSellQuote = function(pObj){
    debugger;
    let lauchParams = {
            "appId": "getfxq",
            "scr": "GetFxQuote",
            "div": "ACNR01__Navigator__launchPad",
            "userObj": {
                "destroyDiv": "ACNR01__Navigator__launchPad",
                "parentAppId": apz.exrate.ExchangeRate.sCache.parentAppId,
                "username": apz.exrate.ExchangeRate.sCache.username,
                "MO_FX_RATE_REQUEST":pObj
            }
    }
    apz.launchApp(lauchParams);
}

apz.exrate.ExchangeRate.fnMore = function(pThis){
    debugger;
    var lrow = $(pThis).attr("rowno");
    //$("#exrate__ExchangeRate__ExchangeRatelist_row_"+lrow).find("#exrate__ExchangeRate__monthRow_row").toggleClass("sno");
   //$("#exrate__ExchangeRate__ExchangeRatelist_row_"+lrow).find("#exrate__ExchangeRate__monthRow_row").slideToggle();
   $("#exrate__ExchangeRate__ExchangeRatelist_row_"+lrow).find("#exrate__ExchangeRate__monthRow_row").fadeToggle(1000);
   
//   $("#exrate__ExchangeRate__ExchangeRatelist_row_"+lrow).find("#exrate__ExchangeRate__monthRow_row").slideDown({
//   start: function () {
//   $("#exrate__ExchangeRate__ExchangeRatelist_row_"+lrow).find("#exrate__ExchangeRate__monthRow_row").toggleClass("sno");
//   }
// });

//   $("#exrate__ExchangeRate__ExchangeRatelist_row_"+lrow).find("#exrate__ExchangeRate__monthRow_row").animate({
//             height: 'toggle'
//         });
   
}



