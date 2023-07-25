apz.acft01.withinBankApprove = {};
apz.acft01.withinBankApprove.sTaskObj = {};
apz.acft01.withinBankApprove.sTxnId;
apz.acft01.withinBankApprove.sCurrentTask = {};
apz.acft01.withinBankApprove.sCurrentWfDetails = {};
apz.app.onLoad_WithinBankApprove = function(params) {
    debugger;
    apz.acft01.withinBankApprove.sTaskObj = params;
    apz.acft01.withinBankApprove.sCurrentTask = params.currentTask;
    apz.acft01.withinBankApprove.sCurrentWfDetails = params.currentWfDetails;
    apz.acft01.withinBankApprove.sDiv = params.div;
    var lData = JSON.parse(params.currentWfDetails.screenData);
    apz.data.scrdata.acft01__WithinBankDetails_Req = lData.acft01__WithinBankDetails_Req;
    apz.acft01.withinBankApprove.getSiDetails(params);
    
    var strlen = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acft01__WithinBankDetails_Req.Details.maskFrmAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.toAccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.toAccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acft01__WithinBankDetails_Req.Details.maskToAccNo = result1;
    
    apz.data.loadData("WithinBankDetails", "acft01");
};
apz.acft01.withinBankApprove.getSiDetails = function(params) {
    debugger;
    var lVal = JSON.parse(params.currentWfDetails.screenData).acft01__WithinBankDetails_Req.Details.type;
    if (lVal == "Schedule Payment") {
        $("#acft01__WithinBankApprove__Date").removeClass("sno");
    }
};
apz.acft01.withinBankApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("WithinBankDetails", "acft01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acft01.withinBankApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acft01.withinBankApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acft01.withinBankApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__WithinBankApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "FTWB000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acft01__WithinBankApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acft01__WithinBankApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acft01.withinBankApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
                    "div": apz.acft01.withinBankApprove.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acft01.withinBankApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acft01.withinBankApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acft01__WithinBankDetails_Req.Details;
    var lJson = {};
    lJson.fromAccount = lTransferDetails.fromAccount;
    lJson.toAccount = lTransferDetails.toAccount;
    lJson.transferType = lTransferDetails.transferType;
    lJson.txnDesc = lTransferDetails.remarks;
    lJson.amount = lTransferDetails.amount;
    lJson.currency = lTransferDetails.currency;
    lJson.beneficiaryId = lTransferDetails.toAccount;
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
        "callBack": apz.acft01.withinBankApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.acft01.withinBankApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.acft01.withinBankApprove.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__WithinBankApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acft01.withinBankApprove.submitCB
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
apz.acft01.withinBankApprove.submitCB = function(pRespObj) {
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
                    "div": apz.acft01.withinBankApprove.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    } else {
        if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
            if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
                var lObj = {};
                //lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                //lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.referenceId = apz.acft01.withinBankApprove.sTxnId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "acft01__WithinBankApprove__launchTaskCompleted",
                    "layout": "All"
                };
                $("#acft01__WithinBankApprove__approve").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
apz.acft01.withinBankApprove.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acft01__WithinBankApprove__launchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "NEXTTASK",
    //         "currentTask": apz.acft01.withinBankApprove.sTaskObj.currentTask,
    //         "currentWfDetails": apz.acft01.withinBankApprove.sTaskObj.sCurrentWfDetails,
    //         "callBack": apz.acft01.withinBankApprove.rejectCB
    //     }
    // };
    // apz.launchApp(lParams);
    $("#acft01__WithinBankApprove__RejectReason_Form").removeClass('sno');
    $("#acft01__WithinBankApprove__Reject_Reason_Confirm").removeClass('sno');
    $("#acft01__WithinBankApprove__ApproveRejectNav").addClass('sno');
};
apz.acft01.withinBankApprove.cancelReject = function() {
    debugger;
    $("#acft01__WithinBankApprove__RejectReason_Form").addClass('sno');
    $("#acft01__WithinBankApprove__Reject_Reason_Confirm").addClass('sno');
    $("#acft01__WithinBankApprove__ApproveRejectNav").removeClass('sno');
}
apz.acft01.withinBankApprove.confirmReject = function() {
    debugger;
    //apz.acpr01.ownAccountApprove.sCurrentTask = {};
    //apz.acpr01.ownAccountApprove.sCurrentWfDetails = {};
    var lRejectReason = apz.getElmValue('acft01__WithinBankApprove__reject_reason');
    apz.acft01.withinBankApprove.sCurrentTask.remarks = lRejectReason;
    apz.acft01.withinBankApprove.sCurrentWfDetails.remarks = lRejectReason;
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__WithinBankApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acft01.withinBankApprove.sCurrentTask,
                "currentWfDetails": apz.acft01.withinBankApprove.sCurrentWfDetails,
                "callBack": apz.acft01.withinBankApprove.rejectCB,
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
            "div": apz.acft01.withinBankApprove.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": "FTWB000FTAC4321"
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acft01.withinBankApprove.rejectCB = function(pRespObj) {
    // apz.currAppId = "acft01";
    // var msg = {
    //     "code": 'APZ-FT-REJCT'
    // };
    // apz.dispMsg(msg);
    apz.currAppId = "acft01";
    apz.acft01.withinBankApprove.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acft01.withinBankApprove.sCurrentTask = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acft01.withinBankApprove.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acft01.withinBankApprove.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acft01.withinBankApprove.sDiv,
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
            "div": apz.acft01.withinBankApprove.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};

apz.acft01.withinBankApprove.fnShowDocument = function(){
    var myBase64string = apz.data.scrdata.acft01__WithinBankDetails_Req.Details.Document;
    var objbuilder = '';
    objbuilder += ('<object width="100%" height="100%" data="data:'+apz.data.scrdata.acft01__WithinBankDetails_Req.Details.DocumentType+';base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="'+apz.data.scrdata.acft01__WithinBankDetails_Req.Details.DocumentType+'" class="internal">');
    objbuilder += ('<embed src="data:'+apz.data.scrdata.acft01__WithinBankDetails_Req.Details.DocumentType+';base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="'+apz.data.scrdata.acft01__WithinBankDetails_Req.Details.DocumentType+'"  />');
    objbuilder += ('</object>');
    var win = window.open("#", "_blank");
    var title = "Document";
    win.document.write('<html><title>' + title + '</title><body style="margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bottom: 0px;">');
    win.document.write(objbuilder);
    win.document.write('</body></html>');
    var layer = jQuery(win.document);
}
