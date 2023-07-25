apz.bein01.VerifyOtherBankINT = {};
apz.app.onLoad_VerifyOtherBankINT = function(params) {
    debugger;
    apz.bein01.VerifyOtherBankINT.sCurrentTask = params.currentTask;
    apz.bein01.VerifyOtherBankINT.sCurrentWfDetails = params.currentWfDetails;
    apz.data.scrdata.bein01__BeneficaryDetails_Req = params.scrData.bein01__BeneficaryDetails_Req;
    apz.data.loadData("BeneficaryDetails", "bein01");
};
apz.bein01.VerifyOtherBankINT.edit = function() {
    debugger;
    var lParams = {
        "appId": "bein01",
        "scr": "NewOtherBank",
        "div": "bein01__Beneficiary__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.bein01__BeneficaryDetails_Req
    };
    apz.launchSubScreen(lParams);
};
apz.bein01.VerifyOtherBankINT.Confirm = function() {
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.bein01.VerifyOtherBankINT.sCurrentTask;
        lUserObj.currentWfDetails = apz.bein01.VerifyOtherBankINT.sCurrentWfDetails;
        lUserObj.callBack = apz.bein01.VerifyOtherBankINT.fnConfirmCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bein01__VerifyOtherBankINT__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.scrData = {};
        lObj.scrData = apz.data.buildData("BeneficaryDetails", "bein01");
        // lObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lObj.currentTask = {};
        lObj.currentWfDetails = {};
        var lParams = {
            "appId": "bein01",
            "scr": "ViewOtherBankINT",
            "userObj": lObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.bein01.VerifyOtherBankINT.fnConfirmCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "bein01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData);
                lObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": pNextStageObj.tbDbmiWorkflowDetail.appId,
                    "scr": pNextStageObj.tbDbmiWorkflowDetail.screenId,
                    "userObj": lObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // apz.acft01.ownAccountApprove.executeServiceTask();
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