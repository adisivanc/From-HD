apz.acep01.ViewContact = {};
apz.acep01.ViewContact.sCurrentTask = {};
apz.acep01.ViewContact.sCurrentWfDetails = {};
apz.acep01.ViewContact.sDiv = "";
apz.app.onLoad_ViewContact = function(params) {
    debugger;
    apz.acep01.ViewContact.sCurrentTask = params.currentTask;
    apz.acep01.ViewContact.sCurrentWfDetails = params.currentWfDetails;
    apz.acep01.ViewContact.sDiv = params.div;
    apz.data.scrdata.acep01__EntityContactView_Req = JSON.parse(params.currentWfDetails.screenData).acep01__EntityContactModify_Req;
    apz.data.loadData("EntityContactView", "acep01");
};
apz.acep01.ViewContact.Approve = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acep01__ViewContact__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acep01.ViewContact.sCurrentTask,
            "currentWfDetails": apz.acep01.ViewContact.sCurrentWfDetails,
            "callBack": apz.acep01.ViewContact.approveCB
        }
    };
    apz.launchApp(lParams);
};
apz.acep01.ViewContact.approveCB = function(pRespObj) {
    apz.currAppId = 'acep01';
    apz.acep01.ViewContact.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acep01.ViewContact.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acep01.ViewContact.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acep01.ViewContact.deleteContactData();
        }
    }
};
apz.acep01.ViewContact.deleteContactData = function() {
    var lServerParams = {
        "ifaceName": "ExecuteQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acep01.ViewContact.deleteEntityDataCB,
        "callBackObj": "",
    };
    var lCorporateId = apz.data.scrdata.acep01__EntityContactView_Req.tbDbmiCorpEntityMaster.corporateId + "__" + apz.data.scrdata.acep01__EntityContactView_Req
        .tbDbmiCorpEntityMaster.entityId;
    var req = {};
    req.queries = ["DELETE FROM tb_dbmi_corporate_contact WHERE corporate_id = '" + lCorporateId + "'"];
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acep01.ViewContact.deleteEntityDataCB = function(pResp) {
    if (pResp.errors == undefined || pResp.errors[0].errorCode == "APZ_FM_EX_041") {
        var lServerParams = {
            "ifaceName": "EntityContactInsert_New",
            "buildReq": "N",
            "req": "",
            "paintResp": "N",
            "async": "true",
            "callBack": apz.acep01.ViewContact.insertEntityDataCB,
            "callBackObj": "",
        };
        var req = {};
        var lCorpEntityMaster = apz.data.scrdata.acep01__EntityContactView_Req.tbDbmiCorpEntityMaster;
        var lContactArr = apz.data.scrdata.acep01__EntityContactView_Req.tbDbmiCorporateContact;
        var lContactArrLength = lContactArr.length;
        for (var i = 0; i < lContactArrLength; i++) {
            lContactArr[i].corporateId = lCorpEntityMaster.corporateId + "__" + lCorpEntityMaster.entityId;
        }
        req.tbDbmiCorporateContact = lContactArr;
        lServerParams.req = req;
        apz.server.callServer(lServerParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acep01.ViewContact.insertEntityDataCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acep01__ViewContact__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acep01.ViewContact.sCurrentTask,
                "currentWfDetails": apz.acep01.ViewContact.sCurrentWfDetails,
                "callBack": apz.acep01.ViewContact.submitCB
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
apz.acep01.ViewContact.submitCB = function(pRespObj) {
    apz.currAppId = "acep01";
    apz.acep01.ViewContact.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acep01.ViewContact.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acep01.ViewContact.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {}
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
};
apz.acep01.ViewContact.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acep01__ViewContact__LaunchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "NEXTTASK",
    //         "currentTask": apz.acep01.ViewContact.sCurrentTask,
    //         "currentWfDetails": apz.acep01.ViewContact.sCurrentWfDetails,
    //         "callBack": apz.acep01.ViewContact.rejectCB
    //     }
    // };
    // apz.launchApp(lParams);
    $("#acep01__ViewContact__RejectReason_Form").removeClass('sno');
    $("#acep01__ViewContact__Reject_Reason_Confirm").removeClass('sno');
    $("#acep01__ViewContact__ApproveRejectNav").addClass('sno');
};

apz.acep01.ViewContact.cancelReject = function() {
    debugger;
    $("#acep01__ViewContact__RejectReason_Form").addClass('sno');
    $("#acep01__ViewContact__Reject_Reason_Confirm").addClass('sno');
    $("#acep01__ViewContact__ApproveRejectNav").removeClass('sno');
}


apz.acep01.ViewContact.confirmReject = function() {
    debugger;
    var lRejectReason = apz.getElmValue('acep01__ViewContact__reject_reason');
    apz.acep01.ViewContact.sCurrentTask.remarks = lRejectReason;
    apz.acep01.ViewContact.sCurrentWfDetails.remarks = lRejectReason;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acep01__ViewContact__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acep01.ViewContact.sCurrentTask,
            "currentWfDetails": apz.acep01.ViewContact.sCurrentWfDetails,
            "callBack": apz.acep01.ViewContact.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
};
apz.acep01.ViewContact.rejectCB = function(pRespObj) {
    debugger;
    /*
    apz.currAppId = "acep01";
    var msg = {
        "code": 'acep_Reject'
    };
    apz.dispMsg(msg);
    */
    
    apz.currAppId = "acep01";
    apz.acep01.ViewContact.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acep01.ViewContact.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acep01.ViewContact.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div":apz.acep01.ViewContact.sDiv,
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
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {
            apz.acep01.ViewContact.deleteContactData();
        }
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};