apz.bulktr.BulkTransfersApprove = {};
apz.app.onLoad_BulkTransfersApprove = function(params) {
    debugger;
    apz.bulktr.BulkTransfersApprove.sTaskObj = params;
    var lData = JSON.parse(params.currentWfDetails.screenData);
    apz.data.scrdata.bulktr__BulkTransfers_Req = lData.bulktr__BulkTransfers_Req;
    apz.data.loadData("BulkTransfers", "bulktr");
};
apz.app.onShown_BulkTransfersApprove = function() {
    $(".adr-ctr").addClass("sno");
};
apz.bulktr.BulkTransfersApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("BulkTransfers", "bulktr");
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.BulkTransfersApprove.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.BulkTransfersApprove.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.BulkTransfersApprove.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__BulkTransfersApprove__launchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.bulktr.BulkTransfersApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
                    "layout": "All",
                    "control": {
                        "appId": "otpeng",
                        "callBack": apz.bulktr.BulkTransfersApprove.fnAuthenticateCB,
                        "destroyDiv": "bulktr__BulkTransfers__launchdiv"
                    }
                };
                apz.launchApp(lParams);
            }
        } else {
            apz.bulktr.BulkTransfersApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.bulktr.BulkTransfersApprove.fnAuthenticateCB = function(params) {
    debugger;
}
apz.bulktr.BulkTransfersApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    //var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).bulktr__BulkTransfers_Req.Details;
    var lReqJson = apz.data.scrdata.bulktr__BulkTransfers_Req.TxnMaster;
    // lReqJson.bulkfundsTransferDetails = lJson;
    delete lReqJson.Details;
    lReqJson.bulkfundsTransferDetails = apz.data.scrdata.bulktr__BulkTransfers_Req.TxnMaster.Details;
    for (var i = 0; i < lReqJson.bulkfundsTransferDetails.length; i++) {
        if (lReqJson.bulkfundsTransferDetails[i].type == "WithinBank") {
            lReqJson.bulkfundsTransferDetails[i].transferType = "BTWithinBank";
        }
        if (lReqJson.bulkfundsTransferDetails[i].type == "Domestic") {
            lReqJson.bulkfundsTransferDetails[i].transferType = "BTDomestic";
        }
        // lReqJson.bulkfundsTransferDetails[i].transferType = "BTWB";
    }
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbtp_funds_transfer";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "FTService",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.bulktr.BulkTransfersApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.bulktr.BulkTransfersApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        //apz.acft01.withinBankApprove.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__BulkTransfersApprove__launchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.bulktr.BulkTransfersApprove.submitCB
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
apz.bulktr.BulkTransfersApprove.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    } else {
        if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
            if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
                var lObj = {};
                //lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                //lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.referenceId = apz.Login.sCorporateId + "__" + apz.Login.sUserId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                // $("#acft01__WithinBankApprove__approve").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
apz.bulktr.BulkTransfersApprove.Reject = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__BulkTransfersApprove__launchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.bulktr.BulkTransfersApprove.sTaskObj.currentTask,
            "currentWfDetails": apz.bulktr.BulkTransfersApprove.sTaskObj.currentWfDetails,
            "callBack": apz.bulktr.BulkTransfersApprove.rejectCB
        }
    };
    apz.launchApp(lParams);
};
apz.bulktr.BulkTransfersApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "bulktr";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};