apz.benf01.VerifyOtherBank = {};
apz.app.onLoad_VerifyOtherBank = function(params){
    debugger;
    apz.benf01.VerifyOtherBank.sCurrentTask = params.currentTask;
    apz.benf01.VerifyOtherBank.sCurrentWfDetails = params.currentWfDetails;
    apz.data.scrdata.benf01__BeneficaryDetails_Req = params.scrData.benf01__BeneficaryDetails_Req;
    
    apz.data.loadData("BeneficaryDetails", "benf01");
    var transfetlmit = apz.getElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__transferLimit");
    apz.setElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__transferlimitwithCurrency", "USD "+transfetlmit);
};
apz.benf01.VerifyOtherBank.edit = function() {
    debugger;
    var lParams = {
        "appId": "benf01",
        "scr": "NewOtherBank",
        "div": "benf01__Beneficiary__launchPad",
        "layout": "All",
        "userObj": apz.data.scrdata.benf01__BeneficaryDetails_Req
    };
    apz.launchSubScreen(lParams);
};
apz.benf01.VerifyOtherBank.Confirm = function() {
    var lUserObj = {};
    
    if (!apz.mockServer) {
    lUserObj.currentTask = apz.benf01.VerifyOtherBank.sCurrentTask;
    lUserObj.currentWfDetails = apz.benf01.VerifyOtherBank.sCurrentWfDetails;
    lUserObj.callBack = apz.benf01.VerifyOtherBank.fnConfirmCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "benf01__VerifyOtherBank__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
    }
    else{
     var lObj = {};
                lObj.scrData = {};
                lObj.scrData = apz.data.buildData("BeneficaryDetails", "benf01");
                // lObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                // lObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                
                lObj.currentTask = "";
                lObj.currentWfDetails = {};
                var lParams = {
                    "appId": "benf01",
                    "scr": "ViewOtherBank",
                    "userObj": lObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
    }
};
apz.benf01.VerifyOtherBank.fnConfirmCB = function(pNextStageObj) {
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
