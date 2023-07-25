apz.taxpay.ConfirmTaxPayment = {};

apz.app.onLoad_ConfirmTaxPayment = function(params) {
    debugger;
    apz.taxpay.ConfirmTaxPayment.sCorporateId = apz.Login.sCorporateId;
    apz.taxpay.ConfirmTaxPayment.sUserID = apz.Login.sUserId;
    apz.taxpay.ConfirmTaxPayment.sTaskObj = params;
    apz.data.scrdata.taxpay__TaxPayment_Req = JSON.parse(params.currentWfDetails.screenData).taxpay__TaxPayment_Req;
    apz.data.loadData("TaxPayment", "taxpay");
    
    
}

apz.taxpay.ConfirmTaxPayment.fnApprove = function(){
    debugger;
     var lscreenData = apz.data.buildData("TaxPayment", "taxpay");
     lscreenData.taxpay__TaxPayment_Req.tbDbmiCorpTaxpayments.txnId = Date.now();
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.taxpay.ConfirmTaxPayment.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.taxpay.ConfirmTaxPayment.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.taxpay.ConfirmTaxPayment.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "taxpay__ConfirmTaxPayment__LaunchMicroService",
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

apz.taxpay.ConfirmTaxPayment.workflowMicroServiceCB = function(pNextStageObj){
    debugger;
     apz.currAppId = "taxpay";
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
            apz.taxpay.ConfirmTaxPayment.executeServiceTask(pNextStageObj);
        }
    }
}


apz.taxpay.ConfirmTaxPayment.executeServiceTask= function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).taxpay__TaxPayment_Req.tbDbmiCorpTaxpayments;
   
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "TaxPayment_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.taxpay.ConfirmTaxPayment.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    req.tbDbmiCorpTaxpayments = lTransferDetails;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};

apz.taxpay.ConfirmTaxPayment.executeServiceTaskCB = function(pResp) {
    debugger;
   // if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "taxpay__ConfirmTaxPayment__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.taxpay.ConfirmTaxPayment.sTaskObj.currentTask,
                "currentWfDetails": apz.taxpay.ConfirmTaxPayment.sTaskObj.currentWfDetails,
                "callBack": apz.taxpay.ConfirmTaxPayment.submitCB
            }
        };
        apz.launchApp(lParams);
    // } else {
    //     var msg = {
    //         "code": pResp.errors[0].errorCode
    //     };
    //     apz.dispMsg(msg);
    // }
};

apz.taxpay.ConfirmTaxPayment.submitCB = function(pRespObj) {
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
