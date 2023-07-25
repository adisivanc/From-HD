apz.acsi01.otherBankDOMApprove = {};
apz.acsi01.otherBankDOMApprove.sTaskObj = {};
apz.acsi01.otherBankDOMApprove.sTxnId;
apz.app.onLoad_OtherBankDOMApprove = function(params) {
    debugger;
    apz.acsi01.otherBankDOMApprove.sTaskObj = params;
    apz.data.scrdata.acsi01__OtherBankDom_Req.Domestic = JSON.parse(params.currentWfDetails.screenData).acsi01__OtherBankDom_Req.Domestic;
    apz.data.loadData("OtherBankDom", "acsi01");
};
apz.acsi01.otherBankDOMApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankDom", "acsi01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.acsi01.otherBankDOMApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acsi01.otherBankDOMApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acsi01.otherBankDOMApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__OtherBankDOMApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "SIDOM000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acsi01__OtherBankDOMApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acsi01__OtherBankDOMApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acsi01.otherBankDOMApprove.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acsi01";
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
                    "div": "acsi01__Transfers__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acsi01.otherBankDOMApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acsi01.otherBankDOMApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acsi01__OtherBankDom_Req.Domestic;
    var lJson = {};
    lJson.fromAccount = lTransferDetails.fromAccount;
    lJson.toAccount = lTransferDetails.toAccount;
    lJson.transferType = lTransferDetails.transferType;
    lJson.txnDesc = lTransferDetails.remarks;
    lJson.amount = lTransferDetails.amount;
    lJson.currency = lTransferDetails.Currency;
    lJson.beneficiaryId = lTransferDetails.toAccount;
    var lReqJson = {};
    lReqJson.fundsTransferDetails = lJson;
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbtp_funds_transfer";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "ExecuteQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acsi01.otherBankDOMApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.acsi01.otherBankDOMApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.acsi01.otherBankDOMApprove.sTxnId = pResp.res.acsi01__ExecuteQuery_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__OtherBankDOMApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acsi01.otherBankDOMApprove.submitCB
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
apz.acsi01.otherBankDOMApprove.submitCB = function(pRespObj) {
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
                    "div": "acsi01__Transfers__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    } else {
        if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
            if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
                var lObj = {};
                lObj.referenceId = apz.acsi01.otherBankDOMApprove.sTxnId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "acsi01__OtherBankDOMApprove__launchTaskCompleted",
                    "layout": "All"
                };
                $("#acsi01__OtherBankDOMApprove__approve").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
apz.acsi01.otherBankDOMApprove.Reject = function() {
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__OtherBankDOMApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acsi01.otherBankDOMApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.acsi01.otherBankDOMApprove.sTaskObj.sCurrentWfDetails,
                "callBack": apz.acsi01.otherBankDOMApprove.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "SIDOM000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acsi01__OtherBankDOMApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acsi01__OtherBankDOMApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acsi01.otherBankDOMApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "acsi01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};
