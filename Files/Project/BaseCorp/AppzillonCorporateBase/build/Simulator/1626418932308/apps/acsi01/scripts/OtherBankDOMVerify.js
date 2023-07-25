apz.acsi01.otherBankDOMVerify = {};
apz.acsi01.otherBankDOMVerify.sTaskObj = {};
apz.app.onLoad_OtherBankDOMVerify = function(params) {
    debugger;
    apz.acsi01.otherBankDOMVerify.sTaskObj = params;
    apz.data.scrdata.acsi01__OtherBankDom_Req.Domestic = JSON.parse(params.currentWfDetails.screenData).acsi01__OtherBankDom_Req.Domestic;
    apz.data.loadData("OtherBankDom", "acsi01");
};
apz.acsi01.otherBankDOMVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "acsi01",
        "scr": "OtherBankDOM",
        "div": "acsi01__NewSI__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.acsi01__OtherBankDom_Req
    };
    apz.launchSubScreen(lParams);
};
apz.acsi01.otherBankDOMVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankDom", "acsi01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.acsi01.otherBankDOMVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acsi01.otherBankDOMVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acsi01.otherBankDOMVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__OtherBankDOMVerify__launchMicroServiceHere",
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
            "scr": "OtherBankDOMApprove",
            "userObj": lReqObj,
            "div": "acsi01__StandingInstructions__launchScreen",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acsi01.otherBankDOMVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
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
            } else { // apz.acsi01.ownAccountApprove.executeServiceTask();
            }
        }
    }
};