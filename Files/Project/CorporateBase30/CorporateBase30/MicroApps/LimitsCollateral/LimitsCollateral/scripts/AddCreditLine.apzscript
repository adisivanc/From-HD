apz.ficl01.AddCreditLine = {};
apz.app.onLoad_AddCreditLine = function(params) {
    debugger;
    apz.ficl01.AddCreditLine.sCorporateId = apz.Login.sCorporateId;
    apz.ficl01.AddCreditLine.sUserId = apz.Login.sUserId;
    apz.setElmValue("ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__corporateId", apz.ficl01.AddCreditLine.sCorporateId);
    apz.setElmValue("ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__userId", apz.ficl01.AddCreditLine.sUserId);
};
apz.ficl01.AddCreditLine.fnCancel = function() {
    // apz.show("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__limitsHeaderRow");
    // apz.hide("ficl01__FCSummary__subScreenLauncher");
    // apz.ficl01.FCSummary.showCreditLine();
    
    apz.show("ficl01__CreditLineList__lineHeader");
     apz.hide("ficl01__CreditLineList__subScreenLauncher");
     apz.show("ficl01__CreditLineList__lineListRow");
};
apz.ficl01.AddCreditLine.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer("ficl01__AddCreditLine__lineAddform")) {
        var lscreenData = apz.data.buildData("AddCreditLine", "ficl01");
        var taskObj = {};
        taskObj.workflowId = "CRLI";
        //taskObj.stageId = "INPUT";
        taskObj.status = "U";
        //taskObj.userId = apz.Login.sUserId;
        taskObj.taskType = "NEW_LINE_REQUEST";
        taskObj.versionNo = "1";
        //taskObj.appId = "ficl01";
        //taskObj.screenId = "AddCreditLine";
        taskObj.screenData = JSON.stringify(lscreenData);
        //taskObj.stageSeqNo = 1;
        taskObj.action = "";
        taskObj.referenceId = lscreenData.ficl01__AddCreditLine_Req.tbDbmiCorpCreditLine.corporateId + "__" + lscreenData.ficl01__AddCreditLine_Req.tbDbmiCorpCreditLine.cifId;
        taskObj.taskDesc = "New line request has been added with referenceId" + taskObj.referenceId;
        //taskObj.createUserId = apz.Login.sUserId;
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.ficl01.AddCreditLine.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__AddCreditLine__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    }
};
apz.ficl01.AddCreditLine.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "ficl01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
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
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
}
