apz.acdp01.depositsApprove = {};
apz.acdp01.depositsApprove.sTaskObj = {};
apz.acdp01.depositsApprove.sRefId;
apz.app.onLoad_DepositsApprove = function(params) {
    debugger;
    apz.acdp01.depositsApprove.sTaskObj = params;
    var lData = JSON.parse(params.currentWfDetails.screenData);
    apz.data.scrdata.acdp01__Deposits_Req = lData.acdp01__Deposits_Req;
    
    var strlen = apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.fromAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.fromAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.maskAccNo = result;
        
        
        var strlen1 = apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.principalCreditAcno;
        strlen1 = strlen1.substr(0, strlen1.length - 4).replace(/[0-9]/g, 'X') + strlen1.substr(strlen1.length - 4, strlen1.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.principalCreditAcno;
        var result1 = apz.getMaskedValue(strlen1, laccNo);
        apz.data.scrdata.acdp01__Deposits_Req.tbDbmiCorpDeposits.maskPrinciple = result1;
    apz.data.loadData("Deposits", "acdp01");
};
apz.acdp01.depositsApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("Deposits", "acdp01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.acdp01.depositsApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.acdp01.depositsApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.acdp01.depositsApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acdp01__DepositsApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "ACDP000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acdp01__DepositsApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acdp01__DepositsApprove__approve").addClass("sno");
        $("#acdp01__DepositsApprove__appGray").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acdp01.depositsApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
                    "div": "acdp01__DepositLauncher__DepositLauncher",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acdp01.depositsApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.acdp01.depositsApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lDepositDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).acdp01__Deposits_Req.tbDbmiCorpDeposits;
    lDepositDetails.corporateId = apz.Login.sCorporateId;
    var lReqJson = {};
    lReqJson.addDepositsDetails = lDepositDetails;
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
        "callBack": apz.acdp01.depositsApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.acdp01.depositsApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        apz.acdp01.depositsApprove.sRefId = pResp.res.acdp01__ExecuteQuery_Res.lRef;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acdp01__DepositsApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": pResp.callBackObj.userObj.currentTask,
                "currentWfDetails": pResp.callBackObj.userObj.currentWfDetails,
                "callBack": apz.acdp01.depositsApprove.submitCB
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
apz.acdp01.depositsApprove.submitCB = function(pRespObj) {
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
                    "div": "acdp01__DepositLauncher__DepositLauncher",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    } else {
        if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
            if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
                var lObj = {};
                lObj.referenceId = apz.acdp01.depositsApprove.sRefId;
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "userObj": lObj,
                    "div": "acdp01__DepositsApprove__launchTaskCompleted",
                    "layout": "All"
                };
                $("#acdp01__DepositsApprove__approve").addClass("sno");
                $("#acdp01__DepositsApprove__appGray").addClass("sno");
                apz.launchApp(lParams);
            }
        }
    }
};
apz.acdp01.depositsApprove.Reject = function() {
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acdp01__DepositsApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acdp01.depositsApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.acdp01.depositsApprove.sTaskObj.sCurrentWfDetails,
                "callBack": apz.acdp01.depositsApprove.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "ACDP000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "acdp01__DepositsApprove__launchTaskCompleted",
            "layout": "All"
        };
        $("#acdp01__DepositsApprove__approve").addClass("sno");
        $("#acdp01__DepositsApprove__appGray").addClass("sno");
        apz.launchApp(lParams);
    }
};
apz.acdp01.depositsApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "acdp01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};
