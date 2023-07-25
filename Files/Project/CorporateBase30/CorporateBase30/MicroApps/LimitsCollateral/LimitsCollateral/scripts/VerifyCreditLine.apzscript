apz.ficl01.VerifyCreditLine = {};
apz.app.onLoad_VerifyCreditLine = function(params){
  
    apz.ficl01.VerifyCreditLine.sTaskObj = params;
    apz.data.scrdata.ficl01__AddCreditLine_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCreditLine_Req;
    apz.data.loadData("AddCreditLine", "ficl01");
    var lineAmount = apz.getElmValue("ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__lineAmount");
    apz.setElmValue("ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__availableAmount", lineAmount);
};


apz.app.onShown_VerifyCreditLine = function() {
    
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__lineAmount_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__startDate_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__endDate_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__cifId_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__lineCurrency_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__mainLine_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__revolvingLine_lbl").removeClass("req");
   
};

apz.ficl01.VerifyCreditLine.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("AddCreditLine", "ficl01");
    var lUserObj = {};
    lUserObj.currentTask = apz.ficl01.VerifyCreditLine.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.ficl01.VerifyCreditLine.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.ficl01.VerifyCreditLine.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "ficl01__VerifyCreditLine__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};

apz.ficl01.VerifyCreditLine.workflowMicroServiceCB = function(pNextStageObj) {
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
                        "referenceId":pNextStageObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};
