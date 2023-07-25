apz.benf01.VerifySameBank = {};
apz.app.onLoad_VerifySameBank = function(params){
    debugger;
    apz.benf01.VerifySameBank.sCurrentTask = params.currentTask;
    apz.benf01.VerifySameBank.sCurrentWfDetails = params.currentWfDetails;
    apz.data.scrdata.benf01__BeneficaryDetails_Req = params.scrData.benf01__BeneficaryDetails_Req;
    apz.data.loadData("BeneficaryDetails", "benf01");
};
apz.benf01.VerifySameBank.edit = function() {
    debugger;
    var lParams = {
        "appId": "benf01",
        "scr": "NewSameBank",
        "div": "benf01__Beneficiary__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.benf01__BeneficaryDetails_Req
    };
    apz.launchSubScreen(lParams);
};
apz.benf01.VerifySameBank.Confirm = function() {
    var lUserObj = {};
    lUserObj.currentTask = apz.benf01.VerifySameBank.sCurrentTask;
    lUserObj.currentWfDetails = apz.benf01.VerifySameBank.sCurrentWfDetails;
    lUserObj.callBack = apz.benf01.VerifySameBank.fnConfirmCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "benf01__VerifySameBank__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.benf01.VerifySameBank.fnConfirmCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "benf01";
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
