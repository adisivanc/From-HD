apz.lecr01.ModifyLC = {};
apz.lecr01.ModifyLC.sCorporateId = "000FTAC4321";
apz.lecr01.ModifyLC.sUserId = "user0001";
apz.app.onLoad_ModifyLC = function(params) {
    debugger;
    $("#lecr01__ModifyLC__lcBrd li").removeClass("active");
    $("#lecr01__ModifyLC__lcBrd li:first").addClass("active");
    var lServerParams = {
        "ifaceName": "LCDetails_Query",
        "buildReq": "N",
        "appId": "lecr01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.lecr01.ModifyLC.queryLCCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpLetterCredit = {};
    req.tbDbmiCorpLetterCredit.referenceNumber = params.refNo;
    req.tbDbmiCorpLetterCreditDocuments = {};
    req.tbDbmiCorpLetterCreditDocuments.referenceNumber = params.refNo;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.lecr01.ModifyLC.queryLCCB = function(pResp){
    debugger;
};
apz.lecr01.ModifyLC.showBeneficary = function() {
    apz.hide("lecr01__ModifyLC__lcDetailsRow");
    apz.show("lecr01__ModifyLC__beneficaryDetailsRow");
    $("#lecr01__ModifyLC__lcBrd li").removeClass("active");
    $("#lecr01__ModifyLC__lcBrd li:eq(1)").addClass("active");
};
apz.lecr01.ModifyLC.showShipping = function() {
    apz.hide("lecr01__ModifyLC__beneficaryDetailsRow");
    apz.show("lecr01__ModifyLC__shippmentDetailsRow");
    $("#lecr01__ModifyLC__lcBrd li").removeClass("active");
    $("#lecr01__ModifyLC__lcBrd li:eq(2)").addClass("active");
};
apz.lecr01.ModifyLC.showDocuments = function() {
    apz.hide("lecr01__ModifyLC__shippmentDetailsRow");
    apz.show("lecr01__ModifyLC__docsRow");
    $("#lecr01__ModifyLC__lcBrd li").removeClass("active");
    $("#lecr01__ModifyLC__lcBrd li:eq(3)").addClass("active");
};
apz.lecr01.ModifyLC.showVerify = function() {
    // if (apz.val.validateContainer('acft01__OwnAccount__OwnAccDetails') == false) {
    //     var msg = {
    //         "code": 'APZ_ACFT01_MANDATORY'
    //     };
    //     apz.dispMsg(msg);
    // } else {
    debugger;
    var lscreenData = apz.data.buildData("LCDetails", "lecr01");
    var taskObj = {};
    taskObj.workflowId = "ILOC";
    taskObj.stageId = "DETAILS";
    taskObj.status = "U";
    taskObj.userId = "USER001";
    taskObj.taskType = "REQUEST_LETTER_OF_CREDIT";
    taskObj.versionNo = "1";
    taskObj.appId = "lecr01";
    taskObj.screenId = "ModifyLC";
    taskObj.screenData = JSON.stringify(lscreenData);
    taskObj.stageSeqNo = 1;
    taskObj.action = "";
    taskObj.createUserId = "USER001";
    taskObj.referenceId = apz.lecr01.ModifyLC.sCorporateId + "__" + taskObj.userId;
    taskObj.taskDesc = taskObj.referenceId + "'s Letter of Credit details have been submitted";
    var lUserObj = {};
    lUserObj.taskDetails = taskObj;
    lUserObj.callBack = apz.lecr01.ModifyLC.workflowMicroServiceCB;
    lUserObj.operation = "NEWWORKFLOW";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "lecr01__ModifyLC__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
    // }
};
apz.lecr01.ModifyLC.workflowMicroServiceCB = function(pNextStageObj) {
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
apz.lecr01.ModifyLC.showDocumentReqOther = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDocument");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDocumentOther_ul");
    if (lval == "Others") {
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDocumentOther_ul");
    }
};
apz.lecr01.ModifyLC.showCrossDeliveryOptions = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDelivery");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentPort_ul");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncoterm_ul");
    // apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncotermOther_ul");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsurance_ul");
    // apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsuranceApplicant_ul");
    if (lval == "cross") {
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentPort_ul");
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncoterm_ul");
        // apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncotermOther_ul");
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsurance_ul");
        // apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsuranceApplicant_ul");
    }
};
apz.lecr01.ModifyLC.showIncotermOther = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncoterm");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncotermOther_ul");
    if (lval == "Others") {
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncotermOther_ul");
    }
};
apz.lecr01.ModifyLC.showApplicantOther = function() {
    var lval = apz.getElmValue("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsurance");
    apz.hide("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsuranceApplicant_ul");
    if (lval == "Applicant") {
        apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsuranceApplicant_ul");
    }
};
apz.lecr01.ModifyLC.fnCancel = function(){
    apz.show("lecr01__LCSummary__lcRow");
    var params = {};
    params.appId = "lecr01";
    params.scr = "ImportLC";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    apz.launchInDiv(params);
};
