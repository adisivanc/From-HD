apz.lecr01.AddLCApprove = {};
apz.app.onLoad_AddLCApprove = function(params) {
    apz.lecr01.AddLCApprove.sTaskObj = params;
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
apz.lecr01.AddLCApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("LCDetails", "lecr01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.lecr01.AddLCApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.lecr01.AddLCApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.lecr01.AddLCApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__AddLCApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        lParams.userObj.taskVariables = [{
            "name": "action",
            "value": "APPROVE",
            "type": "String"
        }]
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "ILOC000FTAC4321";
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "userObj": lObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchApp(lParams);
    }
};
apz.lecr01.AddLCApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
                // apz.lecr01.AddLCApprove.executeServiceTask();
            }
        } else if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            apz.lecr01.AddLCApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.lecr01.AddLCApprove.deleteLC = function() {
    var lServerParams = {
        "ifaceName": "NewLC_Delete",
        "buildReq": "N",
        "appId": "lecr01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.lecr01.AddLCApprove.deleteLCDataCB,
        "callBackObj": "",
    };
    var lRefNo = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.referenceNumber;
    var lCorporateId = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit.corporateId;
    var req = {};
    req.tbDbmiCorpLetterCredit = {};
    req.tbDbmiCorpLetterCreditDocuments = {};
    req.tbDbmiCorpLetterCredit.corporateId = lCorporateId;
    req.tbDbmiCorpLetterCredit.referenceNumber = lRefNo;
    req.tbDbmiCorpLetterCreditDocuments.corporateId = lCorporateId;
    req.tbDbmiCorpLetterCreditDocuments.referenceNumber = lRefNo;
    req.tbDbmiCorpLetterCreditCollateral = {};
    req.tbDbmiCorpLetterCreditCollateral.referenceNumber = lRefNo;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.lecr01.AddLCApprove.deleteLCDataCB = function(pResp) {
    // if (!pResp.errors) {
    var lServerParams = {
        "ifaceName": "NewLC_New",
        "buildReq": "N",
        "appId": "lecr01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.lecr01.AddLCApprove.newLCCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpLetterCredit = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit;
    req.tbDbmiCorpLetterCreditDocuments = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments;
    req.tbDbmiCorpLetterCreditCollateral = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditCollateral;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    // }
};
apz.lecr01.AddLCApprove.newLCCB = function(pResp) {
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__AddLCApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.lecr01.AddLCApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.lecr01.AddLCApprove.sTaskObj.currentWfDetails,
                "callBack": apz.lecr01.AddLCApprove.submitCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.lecr01.AddLCApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lReqJson = {};
    if (apz.lecr01.AddLC.sAction == "edit") {
        lReqJson.modifyLetterDetails = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit;
        lReqJson.modifyLetterDocumentsLists = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments;
    } else {
        lReqJson.addLetterDetails = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCredit;
        lReqJson.addLetterDocumentsLists = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocuments;
        lReqJson.addLetterDraftLists = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDrafts;
        lReqJson.addLetterDocsRequiredLists = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditDocsrequired;
        lReqJson.addLetterCollaterals = apz.data.scrdata.lecr01__LCDetails_Req.tbDbmiCorpLetterCreditCollateral;
        for (var i = 0; i < lReqJson.addLetterCollaterals.length; i++) {
            lReqJson.addLetterCollaterals[i].referenceNumber = lReqJson.addLetterDetails.referenceNumber;
        }
    }
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_letter_credit";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "FetchLetterofCreditsService",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.lecr01.AddLCApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.lecr01.AddLCApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__AddLCApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.lecr01.AddLCApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.lecr01.AddLCApprove.sTaskObj.currentWfDetails,
                "callBack": apz.lecr01.AddLCApprove.submitCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.lecr01.AddLCApprove.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            //if (pRespObj.stageAccess) {
            var lObj = {};
            lObj.referenceId = pRespObj.tbDbmiWorkflowMaster.referenceId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchApp(lParams);
            //}
        }
    }
};
apz.lecr01.AddLCApprove.Reject = function() {
    apz.dispMsg({
        message: "Please enter the reason for rejection",
        type: "P",
        callBack: apz.lecr01.AddLCApprove.rejectMsgConfirmCB
    });
};
apz.lecr01.AddLCApprove.rejectMsgConfirmCB = function(params) {
    if (params.choice) {
        if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__AddLCApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.lecr01.AddLCApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.lecr01.AddLCApprove.sTaskObj.currentWfDetails,
                "callBack": apz.lecr01.AddLCApprove.rejectCB,
                "reject": true
            }
        };
        lParams.userObj.taskVariables = [{
            "name": "action",
            "value": "REJECT",
            "type": "String"
        }]
        apz.launchApp(lParams);
        }
        
        else{
            apz.lecr01.AddLCApprove.rejectCB();
        }
        
    }
}
apz.lecr01.AddLCApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "lecr01";
    apz.dispMsg({
        message: "The LC application has been rejected",
        type: "S",
        callBack: apz.lecr01.AddLCApprove.rejectMsgCB
    });
};
apz.lecr01.AddLCApprove.rejectMsgCB = function(params) {
    var params = {};
    params.appId = "actf01";
    params.scr = "TaskFlow";
    params.layout = "All";
    params.description = "My Tasks";
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
};


apz.lecr01.AddLCApprove.fnShowHiderow = function(pthis, rowid) {
    debugger;
    $("#lecr01__AddLCApprove__lettercreditrow").addClass("sno");
    $("#lecr01__AddLCApprove__partydetailsrow").addClass("sno");
    $("#lecr01__AddLCApprove__bankdetailsrow").addClass("sno");
    $("#lecr01__AddLCApprove__shipmentdetailsrow").addClass("sno");
    $("#lecr01__AddLCApprove__docreqrow").addClass("sno");
    $("#lecr01__AddLCApprove__documentrow").addClass("sno");
    
    $("#lecr01__AddLCApprove__" + rowid).removeClass("sno");
    
    $("#lecr01__AddLCApprove__sectionList li").removeClass("current");
    $(pthis).parent().addClass("current");
}