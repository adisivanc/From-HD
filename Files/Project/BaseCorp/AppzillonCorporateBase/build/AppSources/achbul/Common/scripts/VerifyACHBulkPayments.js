apz.achbul.VerifyACHBulkPayments = {};
apz.app.onLoad_VerifyACHBulkPayments = function(params) {
    debugger;
    apz.achbul.VerifyACHBulkPayments.sTaskObj = params;
    apz.data.scrdata.achbul__ACHBulkPayments_Req = JSON.parse(params.currentWfDetails.screenData).achbul__ACHBulkPayments_Req;
    apz.data.loadData("ACHBulkPayments", "achbul");
    if(apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments.length !=0){
    var fromAcctNo = apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments[0].fromAccount;
    apz.setElmValue("achbul__VerifyACHBulkPayments__inpFromAcct",fromAcctNo);
    var llength = apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments.length;
    for(var i=0;i<llength;i++){
        $("#achbul__ACHBulkPayments__i__tbDbmiCorpAchbulkpayments__toAccount_"+ i).val(apz.data.scrdata.achbul__ACHBulkPayments_Req.tbDbmiCorpAchbulkpayments[i].toAccount);
    }
    }
}

apz.achbul.VerifyACHBulkPayments.fnContinue = function() {
    debugger;
    var lscreenData =  apz.data.buildData("ACHBulkPayments", "achbul");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.achbul.VerifyACHBulkPayments.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.achbul.VerifyACHBulkPayments.sTaskObj.currentWfDetails;
        //lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.achbul.VerifyACHBulkPayments.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "achbul__VerifyACHBulkPayments__LaunchMicroService",
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
            "appId": "achbul",
            "scr": "ApproveACHBulkPayments",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.achbul.VerifyACHBulkPayments.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "achbul";
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
