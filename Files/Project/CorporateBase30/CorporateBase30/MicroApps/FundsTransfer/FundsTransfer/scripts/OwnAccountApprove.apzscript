apz.acft01.ownAccountApprove = {};
apz.acft01.ownAccountApprove.sTaskObj = {};
apz.acft01.ownAccountApprove.sTxnId;
apz.acft01.ownAccountApprove.sCurrentTask = {};
apz.acft01.ownAccountApprove.sCurrentWfDetails = {};
apz.app.onLoad_OwnAccountApprove = function(params) {
    debugger;
    apz.acft01.ownAccountApprove.sTaskObj = params;
    apz.acft01.ownAccountApprove.sCurrentTask = params.currentTask;
    apz.acft01.ownAccountApprove.sCurrentWfDetails = params.currentWfDetails;
    apz.acft01.ownAccountApprove.sDiv = params.div;
    var lData = JSON.parse(params.currentWfDetails.screenData);
    apz.data.scrdata.acft01__OwnAccount_Req = lData.acft01__OwnAccount_Req;
    apz.acft01.ownAccountApprove.getSiDetails(params);
    
    
    
    apz.data.loadData("OwnAccount", "acft01");
};
apz.acft01.ownAccountApprove.getSiDetails = function(params) {
    debugger;
    var lVal = JSON.parse(params.currentWfDetails.screenData).acft01__OwnAccount_Req.Details.type;
    if (lVal == "Schedule Payment") {
        $("#acft01__OwnAccountApprove__Date").removeClass("sno");
    }
};
apz.acft01.ownAccountApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("OwnAccount", "acft01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acft01.ownAccountApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acft01.ownAccountApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acft01.ownAccountApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__OwnAccountApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "FTOA000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acft01__OwnAccountApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acft01__OwnAccountApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acft01.ownAccountApprove.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acft01";
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
                    "div": "acft01__Transfers__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acft01.ownAccountApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acft01.ownAccountApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acft01__OwnAccount_Req.Details;
    var lJson = {};
    lJson.fromAccount = lTransferDetails.fromaccount;
    lJson.toAccount = lTransferDetails.toaccount;
    lJson.transferType = lTransferDetails.transferType;
    lJson.txnDesc = lTransferDetails.remarks;
    lJson.amount = lTransferDetails.amount;
    lJson.currency = lTransferDetails.currency;
    lJson.beneficiaryId = lTransferDetails.toaccount;
    var lReqJson = {};
    lReqJson.fundsTransferDetails = lJson;
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
        "callBack": apz.acft01.ownAccountApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.acft01.ownAccountApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.acft01.ownAccountApprove.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__OwnAccountApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acft01.ownAccountApprove.submitCB
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
apz.acft01.ownAccountApprove.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            var lObj = {};
            lObj.referenceId = apz.acft01.ownAccountApprove.sTxnId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "acft01__OwnAccountApprove__launchTaskCompleted",
                "layout": "All"
            };
            $("#acft01__OwnAccountApprove__approve").addClass("sno");
            apz.launchApp(lParams);
        }
    }
};
apz.acft01.ownAccountApprove.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acft01__OwnAccountApprove__launchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "NEWTASK",
    //         "currentTask": apz.acft01.ownAccountApprove.sTaskObj.currentTask,
    //         "currentWfDetails": apz.acft01.ownAccountApprove.sTaskObj.sCurrentWfDetails,
    //         "callBack": apz.acft01.ownAccountApprove.rejectCB
    //     }
    // };
    // apz.launchApp(lParams);
    $("#acft01__OwnAccountApprove__RejectReason_Form").removeClass('sno');
    $("#acft01__OwnAccountApprove__Reject_Reason_Confirm").removeClass('sno');
    $("#acft01__OwnAccountApprove__ApproveRejectNav").addClass('sno');
};
apz.acft01.ownAccountApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "acft01";
    apz.acft01.ownAccountApprove.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acft01.ownAccountApprove.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acft01.ownAccountApprove.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acft01.ownAccountApprove.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acft01.ownAccountApprove.sDiv,
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {}
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acft01.ownAccountApprove.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acft01.ownAccountApprove.cancelReject = function() {
    debugger;
    $("#acft01__OwnAccountApprove__RejectReason_Form").addClass('sno');
    $("#acft01__OwnAccountApprove__Reject_Reason_Confirm").addClass('sno');
    $("#acft01__OwnAccountApprove__ApproveRejectNav").removeClass('sno');
}
apz.acft01.ownAccountApprove.confirmReject = function() {
    debugger;
    //apz.acpr01.ownAccountApprove.sCurrentTask = {};
    //apz.acpr01.ownAccountApprove.sCurrentWfDetails = {};
    var lRejectReason = apz.getElmValue('acft01__OwnAccountApprove__reject_reason');
    apz.acft01.ownAccountApprove.sCurrentTask.remarks = lRejectReason;
    apz.acft01.ownAccountApprove.sCurrentWfDetails.remarks = lRejectReason;
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__OwnAccountApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acft01.ownAccountApprove.sCurrentTask,
                "currentWfDetails": apz.acft01.ownAccountApprove.sCurrentWfDetails,
                "callBack": apz.acft01.ownAccountApprove.rejectCB,
                "taskVariables": [{
                    "name": "action",
                    "value": "reject",
                    "type": "String"
                }]
            }
        };
        apz.launchApp(lParams);
    } else {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acft01.ownAccountApprove.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": "FTOA000FTAC4321"
            }
        };
        apz.launchApp(lParams);
    }
};
