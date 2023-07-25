apz.acft01 = {};
apz.acft01.Payments = {};
apz.app.onLoad_Payments = function() {
    debugger;
    apz.show("acft01__Payments__gr_row_6");
};
apz.acft01.Payments.ownAccount = function() {
    debugger;
    var params = {};
    params.appId = "acft01";
    params.scr = "OwnAccount";
    params.layout = "All";
    params.div = "acft01__Payments__launchPad";
    $("#acft01__Payments__navigator").addClass('sno');
    $("#acft01__Payments__launchPadRow").removeClass('sno');
    params.userObj = {};
    params.userObj.div = "acft01__Payments__launchPad";
    apz.launchSubScreen(params);
};
apz.acft01.Payments.withinBank = function() {
    debugger;
    var params = {};
    params.appId = "acft01";
    params.scr = "WithinBank";
    params.layout = "All";
    params.div = "acft01__Payments__launchPad";
    $("#acft01__Payments__navigator").addClass('sno');
    $("#acft01__Payments__launchPadRow").removeClass('sno');
    params.userObj = {};
    params.userObj.div = "acft01__Payments__launchPad";
    apz.launchSubScreen(params);
};
apz.acft01.Payments.otherBankDOM = function() {
    debugger;
    lUserObj = {};
    lUserObj.workflowId = "FTDOM";
    lUserObj.task = "DETAILS"
    lUserObj.callBack = apz.acft01.Payments.otherBankDOMCB;
   // lUserObj.operation = "CHECKACCESS";
    lUserObj.operation = "INITIALISE";
    lUserObj.action = "CHECKACCESS";
    apz.acft01.Payments.checkAccess(lUserObj);
};
apz.acft01.Payments.otherBankDOMCB = function(pResp) {
    apz.currAppId = 'acft01';
    if (pResp) {
        var params = {};
        params.appId = "acft01";
        params.scr = "OtherBankDOM";
        params.layout = "All";
        params.div = "acft01__Payments__launchPad";
        $("#acft01__Payments__navigator").addClass('sno');
        $("#acft01__Payments__launchPadRow").removeClass('sno');
        params.userObj = {};
    params.userObj.div = "acft01__Payments__launchPad";
        apz.launchSubScreen(params);
    } 
};
apz.acft01.Payments.checkAccess = function(pUserObj) {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acft01__Payments__launchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": pUserObj
    };
    apz.launchApp(lParams);
}
apz.acft01.Payments.otherBankINT = function() {
    debugger;
    var params = {};
    params.appId = "intb01";
    params.scr = "OtherBankINT";
    params.layout = "All";
    params.div = "acft01__Payments__launchPad";
    $("#acft01__Payments__navigator").addClass('sno');
    $("#acft01__Payments__launchPadRow").removeClass('sno');
    params.userObj = {};
    params.userObj.div = "acft01__Payments__launchPad";
    apz.launchApp(params);
};
apz.acft01.Payments.cancel = function() {
    debugger;
    $("#acft01__Payments__navigator").removeClass('sno');
    $("#acft01__Payments__launchPadRow").addClass('sno');
};
// apz.acft01.Payments.menuClick = function(pThis) {
//     debugger;
//     var lscreen = pThis.id.split("_li");
//     lscreen = lscreen[0].replace(/\s/g, '');
//     apz.acft01.Transfers.menuClickdesc(lscreen);
// };
// apz.acft01.Transfers.menuClickdesc = function(lscreen) {
//     debugger;
//     if (lscreen == "acft01__Transfers__Menu_OwnAccount") {
//         var params = {};
//         params.appId = "acft01";
//         params.scr = "OwnAccount";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchInDiv(params);
//     } else if (lscreen == "acft01__Transfers__Menu_WithinBank") {
//         var params = {};
//         params.appId = "acft01";
//         params.scr = "WithinBank";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchInDiv(params);
//     } else if (lscreen == "acft01__Transfers__Menu_OtherBank(DOM)") {
//         var params = {};
//         params.appId = "acft01";
//         params.scr = "OtherBankDOM";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchInDiv(params);
//     } else if (lscreen == "acft01__Transfers__Menu_OtherBank(INT)") {
//         var params = {};
//         params.appId = "intb01";
//         params.scr = "OtherBankINT";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchApp(params);
//     }else if (lscreen == "acft01__Transfers__Menu_TaskFlow") {
//         var params = {};
//         params.appId = "actf01";
//         params.scr = "TaskFlow";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchApp(params);
//     } else if (lscreen == "acft01__Transfers__Menu_Beneficary") {
//         var params = {};
//         params.appId = "benf01";
//         params.scr = "Beneficiary";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchApp(params);
//     } else if (lscreen == "acft01__Transfers__Menu_Beneficary(INT)") {
//         var params = {};
//         params.appId = "bein01";
//         params.scr = "OtherBankINT";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchApp(params);
//     }
//     else if (lscreen == "acft01__Transfers__Menu_StandingInstructions") {
//         var params = {};
//         params.appId = "acsi01";
//         params.scr = "StandingInstructions";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchApp(params);
//     } else if (lscreen == "acft01__Transfers__Menu_SIOtherBankINT") {
//         var params = {};
//         params.appId = "siint1";
//         params.scr = "OtherBankINT";
//         params.layout = "All";
//         params.div = "acft01__Transfers__launchPad";
//         apz.launchApp(params);
//     }
// };
