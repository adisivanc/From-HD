apz.acsi01.withinBankVerify = {};
apz.acsi01.withinBankVerify.sTaskObj = {};
apz.app.onLoad_WithinBankVerify = function(params) {
    debugger;
    apz.acsi01.withinBankVerify.sTaskObj = params;
    apz.data.scrdata.acsi01__WithinBankDetails_Req = JSON.parse(params.currentWfDetails.screenData).acsi01__WithinBankDetails_Req;
    //  apz.data.scrdata.acsi01__WithinBankDetails_Req.Beneficiary = params.data.acsi01__WithinBankDetails_Req.Beneficiary;
    apz.data.loadData("WithinBankDetails", "acsi01");
};
apz.acsi01.withinBankVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "acsi01",
        "scr": "WithinBank",
        "div": "acsi01__NewSI__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.acsi01__WithinBankDetails_Req
    };
    apz.launchSubScreen(lParams);
};
apz.acsi01.withinBankVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("WithinBankDetails", "acsi01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.acsi01.withinBankVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acsi01.withinBankVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acsi01.withinBankVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__WithinBankVerify__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        //lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        //lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "acsi01",
            "scr": "WithinBankApprove",
            "userObj": lReqObj,
            "div": "acsi01__StandingInstructions__launchScreen",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acsi01.withinBankVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acsi01";
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
                    "div": "acsi01__StandingInstructions__launchScreen",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.acsi01.ownAccountApprove.executeServiceTask();
            }
        }
    }
};