apz.bulktr.DomesticVerify = {};
apz.bulktr.DomesticVerify.sTaskObj = {};
apz.app.onLoad_DomesticVerify = function(params) {
    debugger;
    apz.bulktr.DomesticVerify.sTaskObj = params;
    apz.data.scrdata.bulktr__OtherBankDom_Req.Domestic = JSON.parse(params.currentWfDetails.screenData).bulktr__OtherBankDom_Req.Domestic;
    apz.data.loadData("OtherBankDom", "bulktr");
};
apz.app.onShown_DomesticVerify = function() {
    $(".adr-ctr").addClass("sno");
};
apz.bulktr.DomesticVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankDom", "bulktr");
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.DomesticVerify.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.DomesticVerify.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.DomesticVerify.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__DomesticVerify__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.bulktr.DomesticVerify.workflowMicroServiceCB = function(pNextStageObj) {
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
