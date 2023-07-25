apz.achpay.ACHVerifyPage = {};
apz.app.onLoad_ACHVerifyPage = function(params) {
    debugger;
    apz.achpay.ACHVerifyPage.sTaskObj = params;
    apz.data.scrdata.achpay__ACHPaymentDetails_Req = JSON.parse(params.currentWfDetails.screenData).achpay__ACHPaymentDetails_Req;
    apz.data.loadData("ACHPaymentDetails", "achpay");
}
apz.achpay.ACHVerifyPage.fnContinue = function() {
    debugger;
    var lscreenData = apz.data.buildData("ACHPaymentDetails", "achpay");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.achpay.ACHVerifyPage.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.achpay.ACHVerifyPage.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.achpay.ACHVerifyPage.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "achpay__ACHVerifyPage__LaunchMicroService",
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
            "appId": "achpay",
            "scr": "ACHConfirmPage",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.achpay.ACHVerifyPage.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "achpay";
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
