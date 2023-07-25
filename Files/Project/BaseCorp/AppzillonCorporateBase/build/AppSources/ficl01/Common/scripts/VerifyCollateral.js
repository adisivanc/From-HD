apz.ficl01.VerifyCollateral = {};
apz.app.onLoad_VerifyCollateral = function(params) {
    debugger;
    apz.ficl01.VerifyCollateral.sTaskObj = params;
    apz.data.scrdata.ficl01__AddCollaterals_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCollaterals_Req;
    apz.data.loadData("AddCollaterals", "ficl01");
};
apz.app.onShown_VerifyCollateral = function() {
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralCode_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralName_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__startDate_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__endDate_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralType_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralCurrency_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralValue_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__limitContribution_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__margin_lbl").removeClass("req");
};
apz.ficl01.VerifyCollateral.fnEdit = function() {
    var lParams = {
        "appId": "ficl01",
        "scr": "AddLC",
        "div": "ficl01__LCSummary__subScreenLauncher",
        "layout": "All",
        "userObj": apz.data.scrdata.ficl01__LCDetails_Req
    };
    apz.launchSubScreen(lParams);
};
apz.ficl01.VerifyCollateral.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("AddCollaterals", "ficl01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.ficl01.VerifyCollateral.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.ficl01.VerifyCollateral.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.ficl01.VerifyCollateral.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__VerifyCollateral__LaunchMicroService",
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
            "scr": "ApproveCollateral",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.ficl01.VerifyCollateral.workflowMicroServiceCB = function(pNextStageObj) {
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