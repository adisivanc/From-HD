apz.acft01 = {};
apz.acft01.Transfers = {};
apz.app.onLoad_Transfers = function(params) {
    debugger;
    $("body").removeClass("dbcls");
    apz.show("acft01__Transfers__gr_row_6");
    apz.acft01.Transfers.sparams = params;
    if (params.from == "OmniSearch") {
        apz.acft01.Transfers.otherBankDOMCB(true);
    }
};
apz.acft01.Transfers.ownAccount = function() {
    debugger;
    var params = {};
    params.appId = "acft01";
    params.scr = "OwnAccount";
    params.layout = "All";
    params.div = "acft01__Transfers__launchPad";
    $("#acft01__Transfers__navigator").addClass('sno');
    $("#acft01__Transfers__launchPadRow").removeClass('sno');
    params.userObj = {};
    params.userObj.div = "acft01__Transfers__launchPad";
    apz.launchSubScreen(params);
};
apz.acft01.Transfers.withinBank = function() {
    debugger;
    var params = {};
    params.appId = "acft01";
    params.scr = "WithinBank";
    params.layout = "All";
    params.div = "acft01__Transfers__launchPad";
    $("#acft01__Transfers__navigator").addClass('sno');
    $("#acft01__Transfers__launchPadRow").removeClass('sno');
    params.userObj = {};
    params.userObj.div = "acft01__Transfers__launchPad";
    apz.launchSubScreen(params);
};
apz.acft01.Transfers.otherBankDOM = function() {
    debugger;
    lUserObj = {};
    lUserObj.workflowId = "FTDOM";
    lUserObj.task = "DETAILS"
    lUserObj.callBack = apz.acft01.Transfers.otherBankDOMCB;
    // lUserObj.operation = "CHECKACCESS";
    lUserObj.operation = "INITIALISE";
    lUserObj.action = "CHECKACCESS";
    if (!apz.mockServer) {
        apz.acft01.Transfers.checkAccess(lUserObj);
    } else {
        apz.acft01.Transfers.otherBankDOMCB(true);
    }
};
apz.acft01.Transfers.otherBankDOMCB = function(pResp) {
    debugger;
    apz.currAppId = 'acft01';
    if (pResp) {
        var params = {};
        params.appId = "acft01";
        params.scr = "OtherBankDOM";
        params.layout = "All";
        params.div = "acft01__Transfers__launchPad";
        $("#acft01__Transfers__navigator").addClass('sno');
        $("#acft01__Transfers__launchPadRow").removeClass('sno');
        params.userObj = {};
        params.userObj.div = "acft01__Transfers__launchPad";
        if (apz.acft01.Transfers.sparams.from == "OmniSearch") {
             params.userObj.amount = apz.acft01.Transfers.sparams.entities.entities[4].extractedValue[0];
        params.userObj.beneName = apz.acft01.Transfers.sparams.entities.entities[0].extractedValue[0];
        params.userObj.from = "omniSearch";
           
        }
        apz.launchSubScreen(params);
    }
};
apz.acft01.Transfers.checkAccess = function(pUserObj) {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acft01__Transfers__launchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": pUserObj
    };
    apz.launchApp(lParams);
}
apz.acft01.Transfers.otherBankINT = function() {
    debugger;
    var params = {};
    params.appId = "intb01";
    params.scr = "OtherBankINT";
    params.layout = "All";
    params.div = "acft01__Transfers__launchPad";
    $("#acft01__Transfers__navigator").addClass('sno');
    $("#acft01__Transfers__launchPadRow").removeClass('sno');
    params.userObj = {};
    params.userObj.div = "acft01__Transfers__launchPad";
    apz.launchApp(params);
};
apz.acft01.Transfers.cancel = function() {
    debugger;
    $("#acft01__Transfers__navigator").removeClass('sno');
    $("#acft01__Transfers__launchPadRow").addClass('sno');
};
// apz.acft01.Transfers.menuClick = function(pThis) {
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