apz.bulktr.WithinBankSubmit = {};
apz.app.onLoad_WithinBankSubmit = function(params) {
    debugger;
    apz.bulktr.WithinBankSubmit.sTaskObj = params;
    var lData = JSON.parse(params.currentWfDetails.screenData);
    apz.data.scrdata.bulktr__WithinBankDetailsV_Req = lData.bulktr__WithinBankDetailsV_Req;
    apz.data.loadData("WithinBankDetailsV", "bulktr");
};
apz.app.onShown_WithinBankSubmit = function() {
    $(".adr-ctr").addClass("sno");
    apz.setElmValue("bulktr__WithinBankSubmit__FromAccountNo", apz.data.scrdata.bulktr__WithinBankDetailsV_Req.TxnMaster.Details[0].fromAccount);
};
apz.bulktr.WithinBankSubmit.approve = function() {
    debugger;
    lscreenData = JSON.parse(apz.bulktr.WithinBankSubmit.sTaskObj.currentWfDetails.screenData)
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.WithinBankSubmit.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.WithinBankSubmit.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.WithinBankSubmit.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__WithinBankSubmit__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.bulktr.WithinBankSubmit.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "bulktr";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": "bulktr__BulkTransfers__launchdiv",
                    "layout": "All",
                    "control": {
                        "appId": "otpeng",
                        "callBack": apz.bulktr.WithinBankSubmit.fnAuthenticateCB,
                        "destroyDiv": "bulktr__BulkTransfers__launchdiv"
                    }
                };
                apz.launchApp(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": lReqObj.currentTask.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {
            apz.bulktr.WithinBankSubmit.executeServiceTask(pNextStageObj);
        }
    } else {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": lReqObj.currentTask.referenceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.bulktr.WithinBankSubmit.fnAuthenticateCB = function(params) {
    debugger;
};
apz.bulktr.WithinBankSubmit.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lReqJson = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).bulktr__WithinBankDetailsV_Req.TxnMaster;
    delete lReqJson.Details;
    lReqJson.bulkfundsTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).bulktr__WithinBankDetailsV_Req.TxnMaster.Details;
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
        "callBack": apz.bulktr.WithinBankSubmit.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.bulktr.WithinBankSubmit.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        //apz.acft01.WithinBankSubmit.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__WithinBankSubmit__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.bulktr.WithinBankSubmit.submitCB
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
apz.bulktr.WithinBankSubmit.submitCB = function(pRespObj) {
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
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
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
        // $("#acft01__WithinBankSubmit__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.bulktr.WithinBankSubmit.Reject = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__WithinBankSubmit__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.bulktr.WithinBankSubmit.sTaskObj.currentTask,
            "currentWfDetails": apz.bulktr.WithinBankSubmit.sTaskObj.currentWfDetails,
            "callBack": apz.bulktr.WithinBankSubmit.rejectCB
        }
    };
    apz.launchApp(lParams);
};
apz.bulktr.WithinBankSubmit.rejectCB = function(pRespObj) {
    apz.currAppId = "bulktr";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};