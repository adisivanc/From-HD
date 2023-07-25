apz.acsi01.ownAccountVerify = {};
apz.acsi01.ownAccountVerify.sTaskObj = {};
apz.app.onLoad_OwnAccountVerify = function(params) {
    debugger;
    apz.acsi01.ownAccountVerify.sTaskObj = params;
    apz.data.scrdata.acsi01__OwnAccount_Req = JSON.parse(params.currentWfDetails.screenData).acsi01__OwnAccount_Req;
    apz.data.loadData("OwnAccount", "acsi01");
};
apz.acsi01.ownAccountVerify.edit = function() {
    debugger;
    var lParams = {
        "appId": "acsi01",
        "scr": "OwnAccount",
        "div": "acsi01__NewSI__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.acsi01__OwnAccount_Req
    };
    apz.launchSubScreen(lParams);
};
apz.acsi01.ownAccountVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("OwnAccount", "acsi01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acsi01.ownAccountVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acsi01.ownAccountVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acsi01.ownAccountVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__OwnAccountVerify__launchMicroServiceHere",
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
            "scr": "OwnAccountApprove",
            "userObj": lReqObj,
            "div": apz.acsi01.ownAccountVerify.sTaskObj.div,
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.acsi01.ownAccountVerify.workflowMicroServiceCB = function(pNextStageObj) {
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
