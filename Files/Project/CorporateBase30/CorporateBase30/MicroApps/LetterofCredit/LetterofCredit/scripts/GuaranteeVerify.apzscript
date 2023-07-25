apz.lecr01.GuaranteeVerify = {};
apz.app.onLoad_GuaranteeVerify = function(params) {
    apz.lecr01.GuaranteeVerify.sTaskObj = params;
    apz.data.scrdata.lecr01__GuaranteeDetails_Req = JSON.parse(params.currentWfDetails.screenData).lecr01__GuaranteeDetails_Req;
    apz.data.loadData("GuaranteeDetails", "lecr01");
    if (apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance.guaranteeFormat == "upload") {
        apz.show("lecr01__GuaranteeVerify__docsUpload");
    } else {
        apz.hide("lecr01__GuaranteeVerify__docsUpload");
    }
};
apz.lecr01.GuaranteeVerify.fnEdit = function() {
    var lParams = {
        "appId": "lecr01",
        "scr": "AddGuarantee",
        "div": "lecr01__LCSummary__subScreenLauncher",
        "layout": "All",
        "userObj": apz.data.scrdata.lecr01__GuaranteeDetails_Req
    };
    apz.launchSubScreen(lParams);
};
apz.lecr01.GuaranteeVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("GuaranteeDetails", "lecr01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.lecr01.GuaranteeVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.lecr01.GuaranteeVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.lecr01.GuaranteeVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__GuaranteeVerify__launchMicroServiceHere",
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
            "appId": "lecr01",
            "scr": "GuaranteeApprove",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
                       if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
        apz.launchSubScreen(lParams);
    }
};
apz.lecr01.GuaranteeVerify.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "lecr01";
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
                  if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
                
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
apz.lecr01.GuaranteeVerify.fnShowHiderow = function(pthis, rowid) {
    debugger;
    $("#lecr01__GuaranteeVerify__bendetailrow").addClass("sno");
    $("#lecr01__GuaranteeVerify__guaranteedetrow").addClass("sno");
    $("#lecr01__GuaranteeVerify__bankdetrow").addClass("sno");
   
    $("#lecr01__GuaranteeVerify__" + rowid).removeClass("sno");
    
    $("#lecr01__GuaranteeVerify__sectionList li").removeClass("current");
    $(pthis).parent().addClass("current");
}
