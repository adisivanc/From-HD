apz.bulktr.BulkTransfersVerify = {};
apz.app.onLoad_BulkTransfersVerify = function(params) {
    apz.hide("bulktr__BulkTransfers__mainheader");
    apz.hide("bulktr__BulkTransfers__addBtn");
    apz.hide("bulktr__BulkTransfers__addRow");
    apz.bulktr.BulkTransfersVerify.sTaskObj = params;
    apz.data.scrdata.bulktr__BulkTransfers_Req = JSON.parse(params.currentWfDetails.screenData).bulktr__BulkTransfers_Req;
    apz.data.loadData("BulkTransfers", "bulktr");
};
apz.app.onShown_BulkTransfersVerify = function() {
    $(".adr-ctr").addClass("sno");
};
apz.bulktr.BulkTransfersVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("BulkTransfers", "bulktr");
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.BulkTransfersVerify.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.BulkTransfersVerify.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.BulkTransfersVerify.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__BulkTransfersVerify__launchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.bulktr.BulkTransfersVerify.workflowMicroServiceCB = function(pNextStageObj) {
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
