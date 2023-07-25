apz.acsi01.SIClosureApprove = {};
apz.acsi01.SIClosureApprove.sTaskObj = {};
apz.acsi01.SIClosureApprove.sTxnId;
apz.app.onLoad_SIClosureApprove = function(params) {
    debugger;
    apz.hide("acsi01__StandingInstructions__SIRow");
    apz.acsi01.SIClosureApprove.sTaskObj = params;
    apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer = JSON.parse(params.currentWfDetails.screenData).acsi01__SIClosure_Req.tbDbtpSiFundsTransfer;
    
    var strlen = apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.maskAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.toAccount;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.toAccount;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acsi01__SIClosure_Req.tbDbtpSiFundsTransfer.MaskToAccNo = result1;
    
    apz.data.loadData("SIClosure", "acsi01");
};
apz.acsi01.SIClosureApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("SIClosure", "acsi01");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.acsi01.SIClosureApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acsi01.SIClosureApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acsi01.SIClosureApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__SIClosureApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "SICS000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acsi01__SIClosureApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acsi01__SIClosureApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acsi01.SIClosureApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
            apz.acsi01.SIClosureApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acsi01.SIClosureApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acsi01__SIClosure_Req.tbDbtpSiFundsTransfer;
    var lReqJson = {};
    if (lTransferDetails.status = "Closed") {
        lReqJson.updateSIDetails = lTransferDetails;
    } else {
        lReqJson.sifundsTransferDetails = lTransferDetails;
    }
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
        "callBack": apz.acsi01.SIClosureApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.acsi01.SIClosureApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.acsi01.SIClosureApprove.sTxnId = pResp.res.acsi01__ExecuteQuery_Res.txnId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acsi01__SIClosureApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acsi01.SIClosureApprove.submitCB
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
apz.acsi01.SIClosureApprove.submitCB = function(pRespObj) {
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
                lObj.referenceId = apz.acsi01.SIClosureApprove.sTxnId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "acsi01__SIClosureApprove__launchTaskCompleted",
                    "layout": "All"
                };
                $("#acsi01__SIClosureApprove__approve").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
