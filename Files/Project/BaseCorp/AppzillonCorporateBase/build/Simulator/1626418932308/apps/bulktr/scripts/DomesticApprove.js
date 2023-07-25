apz.bulktr.DomesticApprove = {};
apz.bulktr.DomesticApprove.sTaskObj = {};
apz.app.onLoad_DomesticApprove = function(params) {
    debugger;
    apz.bulktr.DomesticApprove.sTaskObj = params;
    apz.data.scrdata.bulktr__OtherBankDom_Req.Domestic = JSON.parse(params.currentWfDetails.screenData).bulktr__OtherBankDom_Req.Domestic;
    apz.data.loadData("OtherBankDom", "bulktr");
};
apz.app.onShown_DomesticApprove = function() {
    $(".adr-ctr").addClass("sno");
};
apz.bulktr.DomesticApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankDom", "bulktr");
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.DomesticApprove.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.DomesticApprove.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.DomesticApprove.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__DomesticApprove__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.bulktr.DomesticApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
        } else {
            apz.bulktr.DomesticApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.bulktr.DomesticApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).bulktr__OtherBankDom_Req.Domestic;
    // var lJson = {};
    // lJson.fromAccount = lTransferDetails.fromAccount;
    // lJson.toAccount = lTransferDetails.toAccount;
    // lJson.transferType = "";
    // lJson.txnDesc = lTransferDetails.remarks;
    // lJson.amount = lTransferDetails.amount;
    // lJson.currency = "";
    // lJson.beneficiaryId = lTransferDetails.toAccount;
    
    var lReqJson = {};
   // lReqJson.bulkfundsTransferDetails = lJson;
      lReqJson.bulkfundsTransferDetails = apz.data.scrdata.bulktr__OtherBankDom_Req.Domestic;
      for(var i=0; i< lReqJson.bulkfundsTransferDetails.length;i++){
        lReqJson.bulkfundsTransferDetails[i].transferType = "BTDO";
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
        "callBack": apz.bulktr.DomesticApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.bulktr.DomesticApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        // apz.acft01.otherBankDOMApprove.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__DomesticApprove__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.bulktr.DomesticApprove.submitCB
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
apz.bulktr.DomesticApprove.submitCB = function(pRespObj) {
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

apz.bulktr.DomesticApprove.Reject = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__DomesticApprove__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.bulktr.DomesticApprove.sTaskObj.currentTask,
            "currentWfDetails": apz.bulktr.DomesticApprove.sTaskObj.currentWfDetails,
            "callBack": apz.bulktr.DomesticApprove.rejectCB
        }
    };
    apz.launchApp(lParams);
};
apz.bulktr.DomesticApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "bulktr";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};
