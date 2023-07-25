apz.acdp01.LiquidateFDApprove = {};
apz.acdp01.LiquidateFDApprove.sTaskObj = {};
apz.acdp01.LiquidateFDApprove.sTxnId;
apz.app.onLoad_LiquidateFDApprove = function(params) {
    debugger;
    apz.acdp01.LiquidateFDApprove.sTaskObj = params;
    apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits = JSON.parse(params.currentWfDetails.screenData).acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits;
    
     var strlen = apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits.refNum;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits.refNum
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits.maskRefno = result;
        
         var strlen1 = apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits.principalCreditAcno;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits.principalCreditAcno;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits.maskPrincipalNo = result1;
    
    
    apz.data.loadData("LiquidateFDDummy", "acdp01");
    
    
};
apz.acdp01.LiquidateFDApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("LiquidateFDDummy", "acdp01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.acdp01.LiquidateFDApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acdp01.LiquidateFDApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acdp01.LiquidateFDApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acdp01__LiquidateFDApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "LIDP000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acdp01__LiquidateFDApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acdp01__LiquidateFDApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acdp01.LiquidateFDApprove.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "acdp01";
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
                    "div": "acdp01__LiquidateFD__FDLaunchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acdp01.LiquidateFDApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acdp01.LiquidateFDApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lDepositDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acdp01__LiquidateFDDummy_Req.tbDbmiCorpDeposits;
    var lReqJson = {};
    if (lDepositDetails.status = "Closed") {
        lReqJson.updateFDDetails = lDepositDetails;
    } else {
        lReqJson.addDepositsDetails = lDepositDetails;
    }
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_deposits";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "ExecuteQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acdp01.LiquidateFDApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.acdp01.LiquidateFDApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.acdp01.LiquidateFDApprove.sTxnId = pResp.res.acdp01__ExecuteQuery_Res.refId;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acdp01__LiquidateFDApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acdp01.LiquidateFDApprove.submitCB
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
apz.acdp01.LiquidateFDApprove.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            var lObj = {};
            lObj.referenceId = apz.acdp01.LiquidateFDApprove.sTxnId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "acdp01__LiquidateFDApprove__launchTaskCompleted",
                "layout": "All"
            };
            $("#acdp01__LiquidateFDApprove__approve").addClass("sno");
            apz.launchApp(lParams);
        }
    }
};
apz.acdp01.LiquidateFDApprove.Reject = function() {
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acdp01__LiquidateFDApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acdp01.LiquidateFDApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.acdp01.LiquidateFDApprove.sTaskObj.currentWfDetails,
                "callBack": apz.acdp01.LiquidateFDApprove.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "LIDP000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acdp01__LiquidateFDApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acdp01__LiquidateFDApprove__approve").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acdp01.LiquidateFDApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "acdp01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};
