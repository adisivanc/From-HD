apz.bulktr.OwnAccountApprove = {};
apz.app.onLoad_OwnAccountApprove = function(params) {
    debugger;
    apz.bulktr.OwnAccountApprove.sTaskObj = params;
    apz.data.scrdata.bulktr__OwnAccount_Req = JSON.parse(params.currentWfDetails.screenData).bulktr__OwnAccount_Req;
    apz.data.loadData("OwnAccount", "bulktr");
}
apz.app.onShown_OwnAccountApprove = function() {
    $(".adr-ctr").addClass("sno");
};

apz.bulktr.OwnAccountApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("OwnAccount", "bulktr");
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.OwnAccountApprove.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.OwnAccountApprove.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.OwnAccountApprove.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__OwnAccountApprove__launchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.bulktr.OwnAccountApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
            apz.bulktr.OwnAccountApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.bulktr.OwnAccountApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).bulktr__OwnAccount_Req.Details;
    // var lJson = {};
    // lJson.fromAccount = lTransferDetails.fromaccount;
    // lJson.toAccount = lTransferDetails.toaccount;
    // lJson.transferType = "";
    // lJson.txnDesc = lTransferDetails.remarks;
    // lJson.amount = lTransferDetails.amount;
    // lJson.currency = "";
    // lJson.beneficiaryId = lTransferDetails.toaccount;
    var lReqJson = {};
   // lReqJson.bulkfundsTransferDetails = lJson;
   lReqJson.bulkfundsTransferDetails = apz.data.scrdata.bulktr__OwnAccount_Req.Details;
      for(var i=0; i< lReqJson.bulkfundsTransferDetails.length;i++){
        lReqJson.bulkfundsTransferDetails[i].transferType = "BTOW";
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
        "callBack": apz.bulktr.OwnAccountApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};

apz.bulktr.OwnAccountApprove.executeServiceTaskCB = function(pResp){
     debugger;
    if (!pResp.errors) {
        debugger;
       // apz.acft01.ownAccountApprove.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__OwnAccountApprove__launchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.bulktr.OwnAccountApprove.submitCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
}

apz.bulktr.OwnAccountApprove.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            var lObj = {};
            lObj.referenceId =apz.Login.sCorporateId + "__" + apz.Login.sUserId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
              $("#acft01__OwnAccountApprove__approve").addClass("sno");
            apz.launchApp(lParams);
        }
    }
};

apz.bulktr.OwnAccountApprove.Reject = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__OwnAccountApprove__launchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEWTASK",
            "currentTask": apz.bulktr.OwnAccountApprove.sTaskObj.currentTask,
            "currentWfDetails": apz.bulktr.OwnAccountApprove.sTaskObj.sCurrentWfDetails,
            "callBack": apz.bulktr.OwnAccountApprove.rejectCB
        }
    };
  
    apz.launchApp(lParams);
};
apz.bulktr.OwnAccountApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "bulktr";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};
