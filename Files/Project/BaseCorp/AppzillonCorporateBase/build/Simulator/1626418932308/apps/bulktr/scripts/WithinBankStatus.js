apz.bulktr.WithinBankStatus = {};
apz.app.onLoad_WithinBankStatus = function(params) {
    debugger;
    apz.bulktr.WithinBankStatus.sTaskObj = params;
    var lData = JSON.parse(params.currentWfDetails.screenData);
    apz.data.scrdata.bulktr__WithinBankDetails_Req = lData.bulktr__WithinBankDetails_Req;
    apz.data.loadData("WithinBankDetails", "bulktr");
};
apz.app.onShown_WithinBankStatus = function() {
    $(".adr-ctr").addClass("sno");
};
apz.bulktr.WithinBankStatus.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("WithinBankDetails", "bulktr");
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.WithinBankStatus.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.WithinBankStatus.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.WithinBankStatus.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__WithinBankStatus__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.bulktr.WithinBankStatus.workflowMicroServiceCB = function(pNextStageObj) {
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
            apz.bulktr.WithinBankStatus.executeServiceTask(pNextStageObj);
        }
    }
};
apz.bulktr.WithinBankStatus.executeServiceTask = function(pNextStageObj) {
    debugger;
    //var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).bulktr__WithinBankDetails_Req.TxnMaster.Details;
   
    var lReqJson = apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster;
   // lReqJson.bulkfundsTransferDetails = lJson;
   delete lReqJson.Details;
   lReqJson.bulkfundsTransferDetails = apz.data.scrdata.bulktr__WithinBankDetails_Req.TxnMaster.Details;
      for(var i=0; i< lReqJson.bulkfundsTransferDetails.length;i++){
          if(lReqJson.bulkfundsTransferDetails[i].type == "WithinBank"){
              lReqJson.bulkfundsTransferDetails[i].transferType = "BTWithinBank";
          }
           if(lReqJson.bulkfundsTransferDetails[i].type == "Domestic"){
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
        "callBack": apz.bulktr.WithinBankStatus.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.bulktr.WithinBankStatus.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        //apz.acft01.WithinBankStatus.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__WithinBankStatus__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.bulktr.WithinBankStatus.submitCB
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
apz.bulktr.WithinBankStatus.submitCB = function(pRespObj) {
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
                // $("#acft01__WithinBankStatus__approve").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
apz.bulktr.WithinBankStatus.Reject = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__WithinBankStatus__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.bulktr.WithinBankStatus.sTaskObj.currentTask,
            "currentWfDetails": apz.bulktr.WithinBankStatus.sTaskObj.currentWfDetails,
            "callBack": apz.bulktr.WithinBankStatus.rejectCB
        }
    };
    apz.launchApp(lParams);
};
apz.bulktr.WithinBankStatus.rejectCB = function(pRespObj) {
    apz.currAppId = "bulktr";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};
