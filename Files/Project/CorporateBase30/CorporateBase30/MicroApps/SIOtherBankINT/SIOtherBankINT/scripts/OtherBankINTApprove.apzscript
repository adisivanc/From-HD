apz.siint1.otherBankINTApprove = {};
apz.siint1.otherBankINTApprove.sTaskObj = {};
apz.siint1.otherBankINTApprove.sTxnId;
apz.app.onLoad_OtherBankINTApprove = function(params) {
    debugger;
    apz.siint1.otherBankINTApprove.sTaskObj = params;
    apz.data.scrdata.siint1__OtherBankInt_Req.International = JSON.parse(params.currentWfDetails.screenData).siint1__OtherBankInt_Req.International;
    apz.data.loadData("OtherBankInt", "siint1");
};
apz.siint1.otherBankINTApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("OtherBankInt", "siint1");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.siint1.otherBankINTApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.siint1.otherBankINTApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.siint1.otherBankINTApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "siint1__OtherBankINTApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "SIINT000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "siint1__OtherBankINTApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#siint1__OtherBankINTApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.siint1.otherBankINTApprove.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "siint1";
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
                    "div": "acsi01__StandingInstructions__launchScreen",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.siint1.otherBankINTApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.siint1.otherBankINTApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).siint1__OtherBankInt_Req.International;
    var lJson = {};
    lJson.fromAccount = lTransferDetails.fromAccount;
    lJson.toAccount = lTransferDetails.toAccount;
    lJson.transferType = lTransferDetails.transferType;
    lJson.startDate = lTransferDetails.startDate;
    lJson.txnFrequency = lTransferDetails.frequency;
    lJson.noOfTimes = lTransferDetails.noOfTimes;
    lJson.endDate = lTransferDetails.endDate;
    lJson.amount = lTransferDetails.amount;
    lJson.currency = lTransferDetails.amountCurrency;
    lJson.txnDesc = lTransferDetails.remarks;
    lJson.corporateId = apz.Login.sCorporateId;
    lJson.nextExecutionDate = lTransferDetails.nextExecutionDate;
    var lReqJson = {};
    lReqJson.sifundsTransferDetails = lJson;
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbtp_si_funds_transfer";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "ExecuteQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.siint1.otherBankINTApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.siint1.otherBankINTApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.siint1.otherBankINTApprove.sTxnId = pResp.res.siint1__ExecuteQuery_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "siint1__OtherBankINTApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.siint1.otherBankINTApprove.submitCB
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
apz.siint1.otherBankINTApprove.submitCB = function(pRespObj) {
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
                    "div": "acsi01__StandingInstructions__launchScreen",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    } else {
        if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
            if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
                var lObj = {};
                lObj.referenceId = apz.siint1.otherBankINTApprove.sTxnId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "siint1__OtherBankINTApprove__launchTaskCompleted",
                    "layout": "All"
                };
                $("#siint1__OtherBankINTApprove__approve").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
apz.siint1.otherBankINTApprove.Reject = function() {
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "siint1__OtherBankINTApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.siint1.otherBankINTApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.siint1.otherBankINTApprove.sTaskObj.sCurrentWfDetails,
                "callBack": apz.siint1.otherBankINTApprove.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "SIINT000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "siint1__OtherBankINTApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#siint1__OtherBankINTApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.siint1.otherBankINTApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "siint1";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};