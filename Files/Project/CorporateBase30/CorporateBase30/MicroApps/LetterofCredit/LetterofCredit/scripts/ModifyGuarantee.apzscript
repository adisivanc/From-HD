apz.lecr01.ModifyGuarantee = {};
apz.lecr01.ModifyGuarantee.sCorporateId = "000FTAC4321";
apz.lecr01.ModifyGuarantee.sUserId = "user0001";
apz.app.onLoad_ModifyGuarantee = function(params) {
    debugger;
    $("#lecr01__ModifyGuarantee__guaranteeBrd li").removeClass("active");
    $("#lecr01__ModifyGuarantee__guaranteeBrd li:first").addClass("active");
    var lServerParams = {
        "ifaceName": "GuaranteeDetails_Query",
        "buildReq": "N",
        "appId": "lecr01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.lecr01.ModifyGuarantee.queryGuaranteeCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpGuaranteeIssuance = {};
    req.tbDbmiCorpGuaranteeIssuance.referenceNumber = params.refNo;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.lecr01.ModifyGuarantee.queryGuaranteeCB = function(pResp){
    debugger;
};
apz.lecr01.ModifyGuarantee.showGuarantee = function() {
    apz.hide("lecr01__ModifyGuarantee__beneficaryDetails");
    apz.show("lecr01__ModifyGuarantee__guaranteeDetailsRow");
    $("#lecr01__ModifyGuarantee__guaranteeBrd li").removeClass("active");
    $("#lecr01__ModifyGuarantee__guaranteeBrd li:eq(1)").addClass("active");
};
apz.lecr01.ModifyGuarantee.showVerify = function() {
    debugger;
    var lscreenData = apz.data.buildData("GuaranteeDetails", "lecr01");
    var taskObj = {};
    taskObj.workflowId = "GUID";
    taskObj.stageId = "DETAILS";
    taskObj.status = "U";
    taskObj.userId = "USER001";
    taskObj.taskType = "REQUEST_GUARANTEE_DETAILS";
    taskObj.versionNo = "1";
    taskObj.appId = "lecr01";
    taskObj.screenId = "ModifyGuarantee";
    taskObj.screenData = JSON.stringify(lscreenData);
    taskObj.stageSeqNo = 1;
    taskObj.action = "";
    taskObj.createUserId = "USER001";
    taskObj.referenceId = apz.lecr01.ModifyGuarantee.sCorporateId + "__" + taskObj.userId;
    taskObj.taskDesc = taskObj.referenceId + "'s Letter of Credit details have been submitted";
    var lUserObj = {};
    lUserObj.taskDetails = taskObj;
    lUserObj.callBack = apz.lecr01.ModifyGuarantee.workflowMicroServiceCB;
    lUserObj.operation = "NEWWORKFLOW";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "lecr01__ModifyGuarantee__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
    // }
};
apz.lecr01.ModifyGuarantee.workflowMicroServiceCB = function(pNextStageObj) {
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
                    "div": "lecr01__LCSummary__subScreenLauncher",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "lecr01__LCSummary__subScreenLauncher",
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
apz.lecr01.ModifyGuarantee.calculateExpiryDate = function() {
    debugger;
    var lval = apz.getElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__claimPeriod");
    if (lval != "") {
        var date = new Date();
        date.setMonth(lval);
        apz.setElmValue("lecr01__GuaranteeDetails__i__tbDbmiCorpGuaranteeIssuance__expiryDate", date.toString("dd-MMM-yyyy"));
    }
};
apz.lecr01.ModifyGuarantee.fnCancel = function(){
    apz.show("lecr01__LCSummary__lcRow");
    var params = {};
    params.appId = "lecr01";
    params.scr = "Guarantees";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    apz.launchInDiv(params);
};
