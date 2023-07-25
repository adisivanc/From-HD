apz.siint1.otherBankINTConfirm = {};
apz.app.onLoad_OtherBankINTConfirm = function(params){
 debugger;
var lRefNum = params.txnId;
apz.setElmValue("siint1__OtherBankINTConfirm__refNum",lRefNum);
};
apz.siint1.otherBankINTConfirm.setFavourite = function() {
    var params = {
        'code': 'APZ-SVR-FAV'
    };
    apz.dispMsg(params);
};
apz.siint1.otherBankINTConfirm.anotherTransfer = function() {
    debugger;
    var lParams = {
        "appId": "siint1",
        "scr": "OtherBankINT",
           "div": "acsi01__NewSI__launchPad",
        "layout": "All"
    };
    apz.data.scrdata.siint1__OtherBankInt_Req = {};
    apz.launchSubScreen(lParams);
};