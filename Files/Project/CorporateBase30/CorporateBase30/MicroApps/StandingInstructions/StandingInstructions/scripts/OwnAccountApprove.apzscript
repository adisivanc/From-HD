apz.acsi01.ownAccountApprove = {};
apz.acsi01.ownAccountApprove.sTaskObj = {};
apz.acsi01.ownAccountApprove.sTxnId;
apz.app.onLoad_OwnAccountApprove = function(params) {
    debugger;
    apz.acsi01.ownAccountApprove.sTaskObj = params;
    var lData = JSON.parse(params.currentWfDetails.screenData);
    apz.data.scrdata.acsi01__OwnAccount_Req = lData.acsi01__OwnAccount_Req;
    apz.data.loadData("OwnAccount", "acsi01");
};
apz.acsi01.ownAccountApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("OwnAccount", "acsi01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acsi01.ownAccountApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acsi01.ownAccountApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acsi01.ownAccountApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__OwnAccountApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "SIOA000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acsi01__OwnAccountApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acsi01__OwnAccountApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acsi01.ownAccountApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
                    "div": "acsi01__StandingInstructions__launchScreen",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acsi01.ownAccountApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acsi01.ownAccountApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acsi01__OwnAccount_Req.Details;
    var lJson = {};
    lJson.fromAccount = lTransferDetails.fromaccount;
    lJson.toAccount = lTransferDetails.toaccount;
    lJson.transferType = lTransferDetails.transferType;
    lJson.startDate = lTransferDetails.startDate;
    lJson.txnFrequency = lTransferDetails.frequency;
    lJson.noOfTimes = lTransferDetails.noOfTimes;
    lJson.endDate = lTransferDetails.endDate;
    lJson.amount = lTransferDetails.amount;
    lJson.currency = lTransferDetails.currency;
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
        "callBack": apz.acsi01.ownAccountApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.acsi01.ownAccountApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.acsi01.ownAccountApprove.sTxnId = pResp.res.acsi01__ExecuteQuery_Res.fundsTransferResp.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__OwnAccountApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acsi01.ownAccountApprove.submitCB
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
apz.acsi01.ownAccountApprove.submitCB = function(pRespObj) {
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
                lObj.referenceId = apz.acsi01.ownAccountApprove.sTxnId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "acsi01__OwnAccountApprove__launchTaskCompleted",
                    "layout": "All"
                };
                $("#acsi01__OwnAccountApprove__approve").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
apz.acsi01.ownAccountApprove.Reject = function() {
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__OwnAccountApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEWTASK",
                "currentTask": apz.acsi01.ownAccountApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.acsi01.ownAccountApprove.sTaskObj.sCurrentWfDetails,
                "callBack": apz.acsi01.ownAccountApprove.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "SIOA000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acsi01__OwnAccountApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acsi01__OwnAccountApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acsi01.ownAccountApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "acsi01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};