apz.achpay.ACHConfirmPage = {};
apz.app.onLoad_ACHConfirmPage = function(params) {
    debugger;
    apz.achpay.ACHConfirmPage.sCorporateId = apz.Login.sCorporateId;
    apz.achpay.ACHConfirmPage.sUserID = apz.Login.sUserId;
    apz.achpay.ACHConfirmPage.sTaskObj = params;
    apz.data.scrdata.achpay__ACHPaymentDetails_Req = JSON.parse(params.currentWfDetails.screenData).achpay__ACHPaymentDetails_Req;
    apz.data.loadData("ACHPaymentDetails", "achpay");
}


apz.achpay.ACHConfirmPage.fnApprove = function(){
    debugger;
     var lscreenData = apz.data.buildData("ACHPaymentDetails", "achpay");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.achpay.ACHConfirmPage.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.achpay.ACHConfirmPage.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.achpay.ACHConfirmPage.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "achpay__ACHConfirmPage__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "EXAC000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchApp(lParams);
    }
}

apz.achpay.ACHConfirmPage.workflowMicroServiceCB = function(pNextStageObj){
    debugger;
     apz.currAppId = "achpay";
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
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.lecr01.AddLCApprove.executeServiceTask();
            }
        } else if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            apz.achpay.ACHConfirmPage.executeServiceTask(pNextStageObj);
        }
    }
}


apz.achpay.ACHConfirmPage.executeServiceTask= function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).achpay__ACHPaymentDetails_Req.tbDbmiCorpAchpayments;
   
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "ACHPaymentDetails_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.achpay.ACHConfirmPage.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    req.tbDbmiCorpAchpayments = lTransferDetails;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};

apz.achpay.ACHConfirmPage.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "achpay__ACHConfirmPage__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.achpay.ACHConfirmPage.sTaskObj.currentTask,
                "currentWfDetails": apz.achpay.ACHConfirmPage.sTaskObj.currentWfDetails,
                "callBack": apz.achpay.ACHConfirmPage.submitCB
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

apz.achpay.ACHConfirmPage.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            //if (pRespObj.stageAccess) {
            var lObj = {};
            lObj.referenceId = pRespObj.tbDbmiWorkflowMaster.referenceId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchApp(lParams);
            //}
        }
    }
};