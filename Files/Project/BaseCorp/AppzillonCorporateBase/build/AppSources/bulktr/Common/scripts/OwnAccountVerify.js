apz.bulktr.OwnAccountVerify = {};
apz.app.onLoad_OwnAccountVerify = function(params) {
    apz.bulktr.OwnAccountVerify.sTaskObj = params;
    apz.data.scrdata.bulktr__OwnAccount_Req = JSON.parse(params.currentWfDetails.screenData).bulktr__OwnAccount_Req;
    apz.data.loadData("OwnAccount", "bulktr");
}

apz.app.onShown_OwnAccountVerify = function() {
    $(".adr-ctr").addClass("sno");
};
apz.bulktr.OwnAccountVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("OwnAccount", "bulktr");
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.OwnAccountVerify.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.OwnAccountVerify.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.OwnAccountVerify.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__OwnAccountVerify__launchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.bulktr.OwnAccountVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "bulktr";
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
                    "div": "bulktr__BulkTransfers__launchdiv",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
};
