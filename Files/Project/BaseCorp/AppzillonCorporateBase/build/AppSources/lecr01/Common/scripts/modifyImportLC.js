apz.lecr01.modifyImportLC = {};
apz.app.onLoad_modifyImportLC = function(params) {
    debugger;
    apz.lecr01.modifyImportLC.sCorporateId = apz.Login.sCorporateId;
    apz.lecr01.modifyImportLC.sUserId = apz.Login.sUserId;
    //apz.data.scrdata.lecr01__LCDetailsAmendment_Req = {};
    //apz.data.scrdata.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment = params.lecr01__FetchLetterofCreditsService_Res.letterDetails;
    //apz.data.loadData("LCDetailsAmendment", "lecr01");
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__expiryDateOld").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .expiryDate);
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__amountOld").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .amount)
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__toleranceAboveOld").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .toleranceAbove)
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__toleranceBelowOld").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .toleranceBelow)
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__shippmentDateOld").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .latestShipmentDate)
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__referenceNumber").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .referenceNumber);
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__applicantName").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .applicantName);
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__beneficiaryName").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .beneficiaryName);
    $("#lecr01__LCDetailsAmendment__i__tbDbmiCorpLetterCreditAmedntment__customerRefno").val(params.lecr01__FetchLetterofCreditsService_Res.letterDetails
        .customerRefno);
}
apz.lecr01.modifyImportLC.fnCancel = function() {
    apz.show("lecr01__LCSummary__lcRow");
    apz.show("lecr01__LCSummary__tradefinancerow");
    apz.show("lecr01__LCSummary__Mobtradefinancerow");
    apz.hide("lecr01__LCSummary__tradeIcon");
    $("#lecr01__LCSummary__subScreenLauncher").html("");
    var params = {};
    params.appId = "lecr01";
    params.scr = "ImportLC";
    params.layout = "All";
    params.div = "lecr01__LCSummary__tradeDivLauncher";
    apz.launchInDiv(params);
}
apz.lecr01.modifyImportLC.fnVerify = function() {
    debugger;
    var lscreenData = apz.data.buildData("LCDetailsAmendment", "lecr01");
    lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.corporateId = apz.lecr01.modifyImportLC.sCorporateId;
    lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.userId = apz.lecr01.modifyImportLC.sUserId;
    if (lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.amountNew == "") {
        lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.amountNew = lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment
            .amountOld
    }
    if (lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.expiryDateNew == "") {
        lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.expiryDateNew = lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment
            .expiryDateOld
    }
    if (lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.shippmentDateNew == "") {
        lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.shippmentDateNew = lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment
            .shippmentDateOld
    }
    if (lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.toleranceAboveNew == "") {
        lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.toleranceAboveNew = lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment
            .toleranceAboveOld
    }
    if (lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.toleranceBelowNew == "") {
        lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment.toleranceBelowNew = lscreenData.lecr01__LCDetailsAmendment_Req.tbDbmiCorpLetterCreditAmedntment
            .toleranceBelowOld
    }
    if (!apz.mockServer) {
        var taskObj = {};
        taskObj.workflowId = "ILCM";
        taskObj.status = "U";
        //taskObj.userId = apz.Login.sUserId;
        taskObj.taskType = "MODIFY_LC_REQUEST";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        //taskObj.stageSeqNo = 1;
        taskObj.action = "";
        taskObj.referenceId = apz.lecr01.modifyImportLC.sCorporateId + "__" + apz.lecr01.modifyImportLC.sUserId;
        taskObj.taskDesc = "Modify Import LC request has been added with referenceId" + taskObj.referenceId;
        //taskObj.createUserId = apz.Login.sUserId;
        var lUserObj = {};
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.lecr01.modifyImportLC.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__modifyImportLC__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.currentWfDetails = {};
        // lObj.scrData = {};
        // lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
        // lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
        // lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
        lObj.currentTask = "";
        lObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "lecr01",
            "scr": "modifyImportLCVerify",
            "userObj": lObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
}
apz.lecr01.modifyImportLC.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "lecr01";
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
