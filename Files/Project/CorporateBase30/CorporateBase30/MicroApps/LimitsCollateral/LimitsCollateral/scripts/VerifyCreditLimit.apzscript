apz.ficl01.VerifyCreditLimit = {};
apz.app.onLoad_VerifyCreditLimit = function(params) {
    apz.ficl01.VerifyCreditLimit.sTaskObj = params;
    apz.data.scrdata.ficl01__AddCreditLimit_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCreditLimit_Req;
    apz.data.loadData("AddCreditLimit", "ficl01");
};
apz.app.onShown_VerifyCreditLimit = function() {
    $(".adr-ctr").addClass("sno");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__parentLimit_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__startDate_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__endDate_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__limitAmount_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__limitCurrency_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__limitType_lbl").removeClass("req");
};
apz.ficl01.VerifyCreditLimit.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("AddCreditLimit", "ficl01");
    if(!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.ficl01.VerifyCreditLimit.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.ficl01.VerifyCreditLimit.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.ficl01.VerifyCreditLimit.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__VerifyCreditLimit__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "ficl01",
            "scr": "ApproveCreditLimit",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.ficl01.VerifyCreditLimit.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "ficl01";
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
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pNextStageObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};