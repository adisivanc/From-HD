apz.ficl01.VerifyCommitment = {};
apz.app.onLoad_VerifyCommitment = function(params) {
    apz.ficl01.VerifyCommitment.sTaskObj = params;
    apz.data.scrdata.ficl01__AddCommitment_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCommitment_Req;
    apz.data.loadData("AddCommitment", "ficl01");
    //ficl01__AddCommitment__i__tbDbmiCorpCommitment__totalCommitmentValue
    //ficl01__AddCommitment__i__tbDbmiCorpCommitment__availableAmount
    var totalComVal = apz.getElmValue("ficl01__AddCommitment__i__tbDbmiCorpCommitment__totalCommitmentValue");
    apz.setElmValue("ficl01__AddCommitment__i__tbDbmiCorpCommitment__availableAmount", totalComVal);
};
apz.app.onShown_VerifyCommitment = function() {
    $(".adr-ctr").addClass("sno");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__counterPartyname_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__startdate_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__maturitydate").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__currency_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__totalCommitmentValue_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__typeofCommitment_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__maturitydate_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__availableAmount_lbl").removeClass("req");
};
apz.ficl01.VerifyCommitment.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("AddCommitment", "ficl01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.ficl01.VerifyCommitment.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.ficl01.VerifyCommitment.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.ficl01.VerifyCommitment.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__VerifyCommitment__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        
         lReqObj.currentTask = "";
        lReqObj.currentWfDetails = {};
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "ficl01",
            "scr": "ApproveCommitment",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.ficl01.VerifyCommitment.workflowMicroServiceCB = function(pNextStageObj) {
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