apz.acft01.otherBankDOMApprove = {};
apz.acft01.otherBankDOMApprove.sTaskObj = {};
apz.acft01.otherBankDOMApprove.sTxnId;
apz.acft01.otherBankDOMApprove.sCurrentTask = {};
apz.acft01.otherBankDOMApprove.sCurrentWfDetails = {};
apz.app.onLoad_OtherBankDOMApprove = function(params) {
    debugger;
    apz.acft01.otherBankDOMApprove.sTaskObj = params;
    apz.acft01.otherBankDOMApprove.sCurrentTask = params.currentTask;
    apz.acft01.otherBankDOMApprove.sCurrentWfDetails = params.currentWfDetails;
    apz.acft01.otherBankDOMApprove.sDiv = params.div;
    if (apz.data.scrdata.acft01__OtherBankDom_Req) {
        apz.data.scrdata.acft01__OtherBankDom_Req.Domestic = JSON.parse(params.currentWfDetails.screenData).acft01__OtherBankDom_Req.Domestic;
    } else {
        apz.data.scrdata.acft01__OtherBankDom_Req = {};
        apz.data.scrdata.acft01__OtherBankDom_Req.Domestic = JSON.parse(params.currentWfDetails.screenData).acft01__OtherBankDom_Req.Domestic;
    }
    apz.acft01.otherBankDOMApprove.getSiDetails(params);
    
     var strlen = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.maskFrmAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.toAccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.toAccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.maskToAccNo = result1;
    
    
    apz.data.loadData("OtherBankDom", "acft01");
};
apz.acft01.otherBankDOMApprove.getSiDetails = function(params) {
    debugger;
    var lVal = JSON.parse(params.currentWfDetails.screenData).acft01__OtherBankDom_Req.Domestic.type;
    if (lVal == "Schedule Payment") {
        $("#acft01__OtherBankDOMApprove__Date").removeClass("sno");
    }
};
apz.acft01.otherBankDOMApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankDom", "acft01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acft01.otherBankDOMApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acft01.otherBankDOMApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acft01.otherBankDOMApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__OtherBankDOMApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "FTDOM000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acft01__OtherBankDOMApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acft01__OtherBankDOMApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acft01.otherBankDOMApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
                    "div": apz.acft01.otherBankDOMApprove.sDiv,
                    "layout": "All"
                };
                apz.launchApp(lParams);
            }
        } else {
            apz.acft01.otherBankDOMApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acft01.otherBankDOMApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acft01__OtherBankDom_Req.Domestic;
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
    lReqJson.callBack = apz.acft01.otherBankDOMApprove.executeServiceTaskCB;
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    lReqJson.Wfdetails = lReqObj;
    var lParams = {
        "appId": "ftserv",
        "scr": "FTService",
        "div": "acft01__OtherBankDOMApprove__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lReqJson
    };
    apz.launchApp(lParams);
    // var lServerParams = {
    //     "ifaceName": "FTService",
    //     "buildReq": "N",
    //     "req": "",
    //     "paintResp": "N",
    //     "async": "true",
    //     "callBack": apz.acft01.otherBankDOMApprove.executeServiceTaskCB,
    //     "callBackObj": {
    //         "userObj": lReqObj
    //     }
    // };
    // var req = {};
    // lServerParams.req = lReqJson;
    // apz.server.callServer(lServerParams);
};
apz.acft01.otherBankDOMApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        //apz.acft01.otherBankDOMApprove.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        apz.acft01.otherBankDOMApprove.sTxnId = pResp.res.ftserv__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acft01__OtherBankDOMApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acft01.otherBankDOMApprove.submitCB
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
apz.acft01.otherBankDOMApprove.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            var lObj = {};
            lObj.referenceId = apz.acft01.otherBankDOMApprove.sTxnId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "acft01__OtherBankDOMApprove__launchTaskCompleted",
                "layout": "All"
            };
            $("#acft01__OtherBankDOMApprove__approve").addClass("sno");
            apz.launchApp(lParams);
        }
    }
};
apz.acft01.otherBankDOMApprove.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acft01__OtherBankDOMApprove__launchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "NEXTTASK",
    //         "currentTask": apz.acft01.otherBankDOMApprove.sTaskObj.currentTask,
    //         "currentWfDetails": apz.acft01.otherBankDOMApprove.sTaskObj.sCurrentWfDetails,
    //         "callBack": apz.acft01.otherBankDOMApprove.rejectCB
    //     }
    // };
    // apz.launchApp(lParams);
    $("#acft01__OtherBankDOMApprove__RejectReason_Form").removeClass('sno');
    $("#acft01__OtherBankDOMApprove__Reject_Reason_Confirm").removeClass('sno');
    $("#acft01__OtherBankDOMApprove__ApproveRejectNav").addClass('sno');
};
apz.acft01.otherBankDOMApprove.cancelReject = function() {
    debugger;
    $("#acft01__OtherBankDOMApprove__RejectReason_Form").addClass('sno');
    $("#acft01__OtherBankDOMApprove__Reject_Reason_Confirm").addClass('sno');
    $("#acft01__OtherBankDOMApprove__ApproveRejectNav").removeClass('sno');
}
apz.acft01.otherBankDOMApprove.confirmReject = function() {
    debugger;
    var lRejectReason = apz.getElmValue('acft01__OtherBankDOMApprove__reject_reason');
    apz.acft01.otherBankDOMApprove.sCurrentTask.remarks = lRejectReason;
    apz.acft01.otherBankDOMApprove.sCurrentWfDetails.remarks = lRejectReason;
     if (!apz.mockServer) {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acft01__OtherBankDOMApprove__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acft01.otherBankDOMApprove.sCurrentTask,
            "currentWfDetails": apz.acft01.otherBankDOMApprove.sCurrentWfDetails,
            "callBack": apz.acft01.otherBankDOMApprove.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
     }
     
     else{
         var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acft01.otherBankDOMApprove.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": "FTDOM000FTAC4321"
            }
        };
        apz.launchApp(lParams);
     }
};
apz.acft01.otherBankDOMApprove.rejectCB = function(pRespObj) {
    // apz.currAppId = "acft01";
    // var msg = {
    //     "code": 'APZ-FT-REJCT'
    // };
    // apz.dispMsg(msg);
    apz.currAppId = "acft01";
    apz.acft01.otherBankDOMApprove.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acft01.otherBankDOMApprove.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acft01.otherBankDOMApprove.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acft01.otherBankDOMApprove.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acft01.otherBankDOMApprove.sDiv,
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
            "div": apz.acft01.otherBankDOMApprove.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};

apz.acft01.otherBankDOMApprove.fnShowDocument = function(){
    debugger;
    var myBase64string = apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.Document;
    var objbuilder = '';
    objbuilder += ('<object width="100%" height="100%" data="data:'+apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.DocumentType+';base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="'+apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.DocumentType+'" class="internal">');
    objbuilder += ('<embed src="data:'+apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.DocumentType+';base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="'+apz.data.scrdata.acft01__OtherBankDom_Req.Domestic.DocumentType+'"  />');
    objbuilder += ('</object>');
    var win = window.open("#", "_blank");
    var title = "Document";
    win.document.write('<html><title>' + title + '</title><body style="margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bottom: 0px;">');
    win.document.write(objbuilder);
    win.document.write('</body></html>');
    var layer = jQuery(win.document);
}
