apz.intb01.otherBankINTApprove = {};
apz.intb01.otherBankINTApprove.sTaskObj = {};
apz.intb01.otherBankINTApprove.sTxnId;
apz.app.onLoad_OtherBankINTApprove = function(params) {
    debugger;
    apz.intb01.otherBankINTApprove.sTaskObj = params;
    apz.intb01.otherBankINTApprove.sDiv = params.div;
    apz.data.scrdata.intb01__OtherBankInt_Req = {};
    apz.data.scrdata.intb01__OtherBankInt_Req.International = JSON.parse(params.currentWfDetails.screenData).intb01__OtherBankInt_Req.International;
    apz.intb01.otherBankINTApprove.getSiDetails(params);
    
    var strlen = apz.data.scrdata.intb01__OtherBankInt_Req.International.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.intb01__OtherBankInt_Req.International.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.intb01__OtherBankInt_Req.International.maskFrmAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.intb01__OtherBankInt_Req.International.toAccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.intb01__OtherBankInt_Req.International.toAccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.intb01__OtherBankInt_Req.International.maskToAccNo = result1;
    apz.data.loadData("OtherBankInt", "intb01");
};
apz.intb01.otherBankINTApprove.getSiDetails = function(params) {
    debugger;
    var lVal = JSON.parse(params.currentWfDetails.screenData).intb01__OtherBankInt_Req.International.type;
    if (lVal == "Schedule Payment") {
        $("#intb01__OtherBankINTApprove__Date").removeClass("sno");
    }
};
apz.intb01.otherBankINTApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankInt", "intb01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.intb01.otherBankINTApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.intb01.otherBankINTApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.intb01.otherBankINTApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "intb01__OtherBankINTApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        //lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
        //lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
        lObj.referenceId = "FTINT000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "intb01__OtherBankINTApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#intb01__OtherBankINTApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.intb01.otherBankINTApprove.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "intb01";
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
                    "div": apz.intb01.otherBankINTApprove.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.intb01.otherBankINTApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.intb01.otherBankINTApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).intb01__OtherBankInt_Req.International;
    var lJson = {};
    lJson.fromAccount = lTransferDetails.fromAccount;
    lJson.toAccount = lTransferDetails.toAccount;
    lJson.transferType = lTransferDetails.transferType;
    lJson.txnDesc = lTransferDetails.remarks;
    lJson.amount = lTransferDetails.amount;
    lJson.currency = lTransferDetails.amountCurrency;
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
        "callBack": apz.intb01.otherBankINTApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.intb01.otherBankINTApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.intb01.otherBankINTApprove.sTxnId = pResp.res.intb01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "intb01__OtherBankINTApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.intb01.otherBankINTApprove.submitCB
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
apz.intb01.otherBankINTApprove.submitCB = function(pRespObj) {
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
                    "div": apz.intb01.otherBankINTApprove.sDiv,
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
                lObj.referenceId = apz.intb01.otherBankINTApprove.sTxnId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "intb01__OtherBankINTApprove__launchTaskCompleted",
                    "layout": "All"
                };
                $("#intb01__OtherBankINTApprove__approve").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
apz.intb01.otherBankINTApprove.Reject = function() {
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "intb01__OtherBankINTApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.intb01.otherBankINTApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.intb01.otherBankINTApprove.sTaskObj.sCurrentWfDetails,
                "callBack": apz.intb01.otherBankINTApprove.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.intb01.otherBankINTApprove.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": "FTINT000FTAC4321"
            }
        };
        apz.launchApp(lParams);
    }
};
apz.intb01.otherBankINTApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "intb01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};



apz.intb01.otherBankINTApprove.fnShowDocument = function(){
    debugger;
    var myBase64string = apz.data.scrdata.intb01__OtherBankInt_Req.International.Document;
    var objbuilder = '';
    objbuilder += ('<object width="100%" height="100%" data="data:'+apz.data.scrdata.intb01__OtherBankInt_Req.International.DocumentType+';base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="'+apz.data.scrdata.intb01__OtherBankInt_Req.International.DocumentType+'" class="internal">');
    objbuilder += ('<embed src="data:'+apz.data.scrdata.intb01__OtherBankInt_Req.International.DocumentType+';base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="'+apz.data.scrdata.intb01__OtherBankInt_Req.International.DocumentType+'"  />');
    objbuilder += ('</object>');
    var win = window.open("#", "_blank");
    var title = "Document";
    win.document.write('<html><title>' + title + '</title><body style="margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bottom: 0px;">');
    win.document.write(objbuilder);
    win.document.write('</body></html>');
    var layer = jQuery(win.document);
}
