apz.lecr01.GuaranteeApprove = {};
apz.app.onLoad_GuaranteeApprove = function(params) {
    apz.lecr01.GuaranteeApprove.sTaskObj = params;
    apz.data.scrdata.lecr01__GuaranteeDetails_Req = JSON.parse(params.currentWfDetails.screenData).lecr01__GuaranteeDetails_Req;
    apz.data.loadData("GuaranteeDetails", "lecr01");
    if (apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance.guaranteeFormat == "upload") {
        apz.show("lecr01__GuaranteeApprove__docsUpload");
    } else {
        apz.hide("lecr01__GuaranteeApprove__docsUpload");
    }
};
apz.lecr01.GuaranteeApprove.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("GuaranteeDetails", "lecr01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.lecr01.GuaranteeApprove.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.lecr01.GuaranteeApprove.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.lecr01.GuaranteeApprove.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__GuaranteeApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "GUID000FTAC4321";
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
apz.lecr01.GuaranteeApprove.workflowMicroServiceCB = function(pNextStageObj) {
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
                // apz.lecr01.GuaranteeApprove.executeServiceTask();
            }
        } else if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            apz.lecr01.GuaranteeApprove.executeServiceTask(pNextStageObj);
        }
    }
};
apz.lecr01.GuaranteeApprove.deleteGuarantee = function() {
    var lServerParams = {
        "ifaceName": "NewGuarantee_Delete",
        "buildReq": "N",
        "appId": "lecr01",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.lecr01.GuaranteeApprove.deleteGuaranteeDataCB,
        "callBackObj": "",
    };
    var lRefNo = apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance.referenceNumber;
    var req = {};
    req.tbDbmiCorpGuaranteeIssuance = {};
    req.tbDbmiCorpGuaranteeIssuance.referenceNumber = lRefNo;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.lecr01.GuaranteeApprove.deleteGuaranteeDataCB = function(pResp) {
    // if (!pResp.errors) {
    var lServerParams = {
        "ifaceName": "NewGuarantee_New",
        "buildReq": "N",
        "appId": "lecr01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.lecr01.GuaranteeApprove.newGuaranteeCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpGuaranteeIssuance = apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    // }
};
apz.lecr01.GuaranteeApprove.newGuaranteeCB = function(pResp) {
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__GuaranteeApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.lecr01.GuaranteeApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.lecr01.GuaranteeApprove.sTaskObj.currentWfDetails,
                "callBack": apz.lecr01.GuaranteeApprove.submitCB
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
apz.lecr01.GuaranteeApprove.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lGuaranteeDetails = apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeIssuance;
    var lReqJson = {};
    if (apz.lecr01.AddGuarantee.sAction == "edit") {
        lReqJson.modifyGuaranteeDetails = lGuaranteeDetails;
        lReqJson.modifyGuaranteeDocuments = apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeDocuments;
    } else {
        lReqJson.addGuaranteeDetails = lGuaranteeDetails;
        lReqJson.addGuaranteeDocuments = apz.data.scrdata.lecr01__GuaranteeDetails_Req.tbDbmiCorpGuaranteeDocuments;
    }
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_guarantee_issuance";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "FetchGuaranteeDetails",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.lecr01.GuaranteeApprove.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.lecr01.GuaranteeApprove.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__GuaranteeApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.lecr01.GuaranteeApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.lecr01.GuaranteeApprove.sTaskObj.currentWfDetails,
                "callBack": apz.lecr01.GuaranteeApprove.submitCB
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
apz.lecr01.GuaranteeApprove.submitCB = function(pRespObj) {
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
apz.lecr01.GuaranteeApprove.Reject = function() {
    if (!aapz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "lecr01__GuaranteeApprove__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.lecr01.GuaranteeApprove.sTaskObj.currentTask,
                "currentWfDetails": apz.lecr01.GuaranteeApprove.sTaskObj.sCurrentWfDetails,
                "callBack": apz.lecr01.GuaranteeApprove.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "GUID000FTAC4321";
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
apz.lecr01.GuaranteeApprove.rejectCB = function(pRespObj) {
    apz.currAppId = "lecr01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};


apz.lecr01.GuaranteeApprove.fnShowHiderow = function(pthis, rowid) {
    debugger;
    $("#lecr01__GuaranteeApprove__bendetailrow").addClass("sno");
    $("#lecr01__GuaranteeApprove__guaranteedetrow").addClass("sno");
    $("#lecr01__GuaranteeApprove__bankdetrow").addClass("sno");
   
    $("#lecr01__GuaranteeApprove__" + rowid).removeClass("sno");
    
    $("#lecr01__GuaranteeApprove__sectionList li").removeClass("current");
    $(pthis).parent().addClass("current");
}