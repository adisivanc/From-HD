apz.lecr01.modifyImportLCApprove = {};
apz.app.onLoad_modifyImportLCApprove = function(params) {
    apz.lecr01.modifyImportLCApprove.sTaskObj = params;
    apz.data.scrdata.lecr01__LCDetailsAmendment_Req = JSON.parse(params.currentWfDetails.screenData).lecr01__LCDetailsAmendment_Req;
    apz.data.loadData("LCDetailsAmendment", "lecr01");
}
apz.lecr01.modifyImportLCApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("LCDetailsAmendment", "lecr01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.lecr01.modifyImportLCApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.lecr01.modifyImportLCApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.lecr01.modifyImportLCApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__modifyImportLCApprove__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "ILCM000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchApp(lParams);
    }
};
apz.lecr01.modifyImportLCApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
                // apz.ficl01.ApproveCollateral.executeServiceTask();
            }
        } else if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            apz.lecr01.modifyImportLCApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.lecr01.modifyImportLCApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lReqJson = {};
    lReqJson.modifyLetterDetails = apz.data.scrdata.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment;
    lReqJson.modifyLetterDetails.corporateId = apz.Login.sCorporateId;
    lReqJson.modifyLetterDetails.userId = apz.Login.sUserId;
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_letter_credit";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "FetchLetterofCreditsService",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "false",
        "callBack": apz.lecr01.modifyImportLCApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.lecr01.modifyImportLCApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__modifyImportLCApprove__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.lecr01.modifyImportLCApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.lecr01.modifyImportLCApprove.sTaskObj.currentWfDetails,
                "callBack": apz.lecr01.modifyImportLCApprove.submitCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.lecr01.modifyImportLCApprove.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            // if (pRespObj.stageAccess) {
            var lObj = {};
            lObj.referenceId = pRespObj.tbDbmiWorkflowMaster.referenceId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchApp(lParams);
            // }
        }
    }
};
apz.lecr01.modifyImportLCApprove.Reject = function() {
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__modifyImportLCApprove__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.lecr01.modifyImportLCApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.lecr01.modifyImportLCApprove.sTaskObj.currentWfDetails,
                "callBack": apz.lecr01.modifyImportLCApprove.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "ILCM000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchApp(lParams);
    }
};
apz.lecr01.modifyImportLCApprove.rejectCB = function(pRespObj) {
    debugger;
    apz.currAppId = "lecr01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};