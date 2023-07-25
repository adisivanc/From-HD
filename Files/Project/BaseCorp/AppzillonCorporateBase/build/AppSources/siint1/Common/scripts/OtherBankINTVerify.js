apz.siint1.otherBankINTVerify = {};
apz.siint1.otherBankINTVerify.sTaskObj = {};
apz.app.onLoad_OtherBankINTVerify = function(params) {
    debugger;
    apz.siint1.otherBankINTVerify.sTaskObj = params;
    apz.data.scrdata.siint1__OtherBankInt_Req.International = JSON.parse(params.currentWfDetails.screenData).siint1__OtherBankInt_Req.International;
    apz.data.loadData("OtherBankInt", "siint1");
};
apz.siint1.otherBankINTVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "siint1",
        "scr": "OtherBankINT",
        "div": "siint1__OtherBankINT__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.siint1__OtherBankInt_Req
    };
    apz.launchSubScreen(lParams);
};
apz.siint1.otherBankINTVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankInt", "siint1");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.siint1.otherBankINTVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.siint1.otherBankINTVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.siint1.otherBankINTVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "siint1__OtherBankINTVerify__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "siint1",
            "scr": "OtherBankINTApprove",
            "userObj": lReqObj,
            "div": "acsi01__NewSI__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.siint1.otherBankINTVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "siint1";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": "acsi01__NewSI__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.siint1.ownAccountApprove.executeServiceTask();
            }
        }
    }
};