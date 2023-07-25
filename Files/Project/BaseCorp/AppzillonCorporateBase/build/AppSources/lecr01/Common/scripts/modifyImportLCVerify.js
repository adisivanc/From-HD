apz.lecr01.modifyImportLCVerify = {};
apz.app.onLoad_modifyImportLCVerify = function(params) {
    apz.lecr01.modifyImportLCVerify.sTaskObj = params;
    apz.data.scrdata.lecr01__LCDetailsAmendment_Req = JSON.parse(params.currentWfDetails.screenData).lecr01__LCDetailsAmendment_Req;
    apz.data.loadData("LCDetailsAmendment", "lecr01");
};
apz.lecr01.modifyImportLCVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("LCDetailsAmendment", "lecr01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.lecr01.modifyImportLCVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.lecr01.modifyImportLCVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.lecr01.modifyImportLCVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__modifyImportLCVerify__LaunchMicroService",
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
            "appId": "lecr01",
            "scr": "modifyImportLCApprove",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.lecr01.modifyImportLCVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "lecr01";
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
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pNextStageObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};