apz.taxpay.VerifyTaxPayment = {};

apz.app.onLoad_VerifyTaxPayment = function(params) {
    debugger;
    apz.taxpay.VerifyTaxPayment.sTaskObj = params;
    apz.data.scrdata.taxpay__TaxPayment_Req = JSON.parse(params.currentWfDetails.screenData).taxpay__TaxPayment_Req;
    apz.data.loadData("TaxPayment", "taxpay");
    
}

apz.taxpay.VerifyTaxPayment.fnContinue = function() {
    debugger;
    var lscreenData = apz.data.buildData("TaxPayment", "taxpay");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.taxpay.VerifyTaxPayment.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.taxpay.VerifyTaxPayment.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.taxpay.VerifyTaxPayment.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "taxpay__VerifyTaxPayment__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        //lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        //lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        // lReqObj.div = apz.acft01.ownAccountVerify.sDiv;
        var lParams = {
            "appId": "taxpay",
            "scr": "ConfirmTaxPayment",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.taxpay.VerifyTaxPayment.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "taxpay";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                // lReqObj.div = apz.acft01.ownAccountVerify.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
};
