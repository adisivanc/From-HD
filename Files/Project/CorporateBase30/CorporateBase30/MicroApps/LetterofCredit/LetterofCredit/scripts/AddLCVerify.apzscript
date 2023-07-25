apz.lecr01.AddLCVerify = {};
apz.app.onLoad_AddLCVerify = function(params) {
    debugger;
    apz.lecr01.AddLCVerify.sTaskObj = params;
    apz.data.scrdata.lecr01__LCDetails_Req = JSON.parse(params.currentWfDetails.screenData).lecr01__LCDetails_Req;
    apz.data.loadData("LCDetails", "lecr01");
    // if(apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.shippmentDelivery == "cross") {
    //     apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentPort");
    //     apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncoterm");
    //     apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsurance");
    //     apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__portOfLoading_ctrl_grp_div");
    //     apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__portOfDischarge_ctrl_grp_div");
    // }
    // if(apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.shippmentIncoterm == "Others") {
    //     apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentIncotermOther_ctrl_grp_div");
    // }
    // if(apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.shippmentDocument.indexOf("Others")>=0) {
    //     apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentDocumentOther_ctrl_grp_div");
    // }
    // if(apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.shippmentInsurance == "Applicant") {
    //     apz.show("lecr01__LCDetails__i__tbDbmiCorpLetterCredit__shippmentInsuranceApplicant");
    // }
};
apz.lecr01.AddLCVerify.fnEdit = function() {
    var lParams = {
        "appId": "lecr01",
        "scr": "AddLC",
        "div": "lecr01__LCSummary__subScreenLauncher",
        "layout": "All",
        "userObj": apz.data.scrdata.lecr01__LCDetails_Req
    };
    apz.launchSubScreen(lParams);
};
apz.lecr01.AddLCVerify.confirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("LCDetails", "lecr01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.lecr01.AddLCVerify.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.lecr01.AddLCVerify.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.lecr01.AddLCVerify.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__AddLCVerify__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
              if (apz.deviceGroup == "Mobile") {
        lParams.layout = "Mobile";
    }
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
            "scr": "AddLCApprove",
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
apz.lecr01.AddLCVerify.workflowMicroServiceCB = function(pNextStageObj) {
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


apz.lecr01.AddLCVerify.fnShowHiderow = function(pthis, rowid) {
    debugger;
    $("#lecr01__AddLCVerify__lettercreditrow").addClass("sno");
    $("#lecr01__AddLCVerify__partydetailsrow").addClass("sno");
    $("#lecr01__AddLCVerify__bankdetailsrow").addClass("sno");
    $("#lecr01__AddLCVerify__shipmentdetailsrow").addClass("sno");
    $("#lecr01__AddLCVerify__docreqrow").addClass("sno");
    $("#lecr01__AddLCVerify__documentrow").addClass("sno");
    
    $("#lecr01__AddLCVerify__" + rowid).removeClass("sno");
    
    $("#lecr01__AddLCVerify__sectionList li").removeClass("current");
    $(pthis).parent().addClass("current");
}
