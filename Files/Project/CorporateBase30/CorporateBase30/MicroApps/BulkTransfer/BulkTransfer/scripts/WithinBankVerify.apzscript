apz.bulktr.WithinBankVerify = {};
apz.app.onLoad_WithinBankVerify = function(params) {
    debugger;
    apz.bulktr.WithinBankVerify.sTaskObj = params;
    apz.data.scrdata.bulktr__WithinBankDetailsV_Req = JSON.parse(params.currentWfDetails.screenData).bulktr__WithinBankDetails_Req;
    
    
      for (var i = 0; i < apz.data.scrdata.bulktr__WithinBankDetailsV_Req.TxnMaster.Details.length; i++) {
                var strlen = apz.data.scrdata.bulktr__WithinBankDetailsV_Req.TxnMaster.Details[i].toAccount;
                strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(
                    /[0-9]/g, '9');
                var laccNo = apz.data.scrdata.bulktr__WithinBankDetailsV_Req.TxnMaster.Details[i].toAccount;
                var result = apz.getMaskedValue(strlen, laccNo);
                apz.data.scrdata.bulktr__WithinBankDetailsV_Req.TxnMaster.Details[i].maskAccNo = result;
            }
    
    apz.data.loadData("WithinBankDetailsV", "bulktr");
};
apz.app.onShown_WithinBankVerify = function() {
    $(".adr-ctr").addClass("sno");
    
    var strlen = apz.data.scrdata.bulktr__WithinBankDetailsV_Req.TxnMaster.Details[0].fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.bulktr__WithinBankDetailsV_Req.TxnMaster.Details[0].fromAccount
        var result = apz.getMaskedValue(strlen, laccNo);
        
    //apz.setElmValue("bulktr__WithinBankVerify__FromAccountNo", apz.data.scrdata.bulktr__WithinBankDetailsV_Req.TxnMaster.Details[0].fromAccount);
    apz.setElmValue("bulktr__WithinBankVerify__FromAccountNo", result);
};
apz.bulktr.WithinBankVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("WithinBankDetailsV", "bulktr");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.bulktr.WithinBankVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.bulktr.WithinBankVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.bulktr.WithinBankVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__WithinBankVerify__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj,
        };
        apz.launchApp(lParams);
    } else {
        //apz.currAppId = "bulktr";
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "bulktr",
            "scr": "WithinBankApprove",
            "div": "bulktr__BulkTransfers__launchdiv",
            "layout": "All",
            "userObj": lReqObj,
        };
        
                 if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
        apz.launchApp(lParams);
    }
};
apz.bulktr.WithinBankVerify.fnAuthenticateCB = function(params) {
    debugger;
    var lscreenData = JSON.parse(apz.bulktr.WithinBankVerify.sTaskObj.currentWfDetails.screenData);
    var lUserObj = {};
    lUserObj.currentTask = apz.bulktr.WithinBankVerify.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.bulktr.WithinBankVerify.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.bulktr.WithinBankVerify.authencticateMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "bulktr__BulkTransfers__launchdiv",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj,
    };
    lParams.userObj.taskVariables = [{
        "name": "amount",
        "value": parseFloat(lscreenData.bulktr__WithinBankDetailsV_Req.TxnMaster.amount),
        "type": "Number"
    }];
    apz.launchApp(lParams);
};
apz.bulktr.WithinBankVerify.authencticateMicroServiceCB = function(pNextStageObj) {
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
                    "layout": "All"
                };
                         if (apz.deviceGroup == "Mobile") {
                        lParams.layout = "Mobile";
                        }
                
                apz.launchSubScreen(lParams);
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
            apz.bulktr.WithinBankVerify.executeServiceTask(pNextStageObj);
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
apz.bulktr.WithinBankVerify.executeServiceTask = function(pNextStageObj) {
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
        "callBack": apz.bulktr.WithinBankVerify.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.bulktr.WithinBankVerify.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        //apz.acft01.WithinBankVerify.sTxnId = pResp.res.acft01__FTService_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bulktr__BulkTransfers__launchdiv",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.bulktr.WithinBankVerify.submitCB
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
apz.bulktr.WithinBankVerify.submitCB = function(pRespObj) {
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
        // $("#acft01__WithinBankVerify__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.bulktr.WithinBankVerify.workflowMicroServiceCB = function(pNextStageObj) {
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
                    "div": "bulktr__BulkTransfers__launchdiv",
                    "layout": "All",
                    "callBack": apz.bulktr.WithinBankVerify.fnAuthenticateCB,
                };
                lParams.userObj = {};
                lParams.userObj.action = "Generate";
                lParams.userObj.data = lReqObj;
                lParams.userObj.control = {
                    "appId": "otpeng",
                    "callBack": apz.bulktr.WithinBankVerify.fnAuthenticateCB,
                    "destroyDiv": ""
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
