apz.acpr01.ViewContact = {};
apz.acpr01.ViewContact.sCurrentTask = {};
apz.acpr01.ViewContact.sCurrentWfDetails = {};
apz.acpr01.ViewContact.sDiv = "";
apz.app.onLoad_ViewContact = function(params) {
    apz.acpr01.ViewContact.sCurrentTask = params.currentTask;
    apz.acpr01.ViewContact.sCurrentWfDetails = params.currentWfDetails;
    apz.acpr01.ViewContact.sDiv = params.div;
    apz.data.scrdata.acpr01__CorporateContactView_Req = JSON.parse(params.currentWfDetails.screenData).acpr01__CorporateContactModify_Req;
    apz.data.loadData("CorporateContactView", "acpr01");
};
apz.acpr01.ViewContact.Approve = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acpr01__ViewContact__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acpr01.ViewContact.sCurrentTask,
            "currentWfDetails": apz.acpr01.ViewContact.sCurrentWfDetails,
            "callBack": apz.acpr01.ViewContact.approveCB
        }
    };
    apz.launchApp(lParams);
};
apz.acpr01.ViewContact.approveCB = function(pRespObj) {
    debugger;
    apz.currAppId = 'acpr01';
    apz.acpr01.ViewContact.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acpr01.ViewContact.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
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
                    "div": apz.acpr01.ViewContact.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acpr01.ViewContact.deleteContactData();
        }
    }
};
apz.acpr01.ViewContact.deleteContactData = function() {
    var lServerParams = {
        "ifaceName": "ExecuteQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acpr01.ViewContact.deleteCorpDataCB,
        "callBackObj": "",
    };
    // var lUserId = apz.data.scrdata.acpr01__UserDetails_Req.tbDbmiCorpUserMaster.userId;
    var lCorporateId = apz.data.scrdata.acpr01__CorporateContactView_Req.tbDbmiCorporateMaster.corporateId;
    var req = {};
    req.queries = ["DELETE FROM tb_dbmi_corporate_contact WHERE corporate_id = '" + lCorporateId + "'"];
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
}
apz.acpr01.ViewContact.deleteCorpDataCB = function(pResp) {
    // if (!pResp.errors) {
    var lServerParams = {
        "ifaceName": "CorporateContactInsert_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acpr01.ViewContact.insertCorpDataCB,
        "callBackObj": "",
    };
    var req = {};
    var lCorpProfileMaster = apz.data.scrdata.acpr01__CorporateContactView_Req.tbDbmiCorporateMaster;
    var lContactArr = apz.data.scrdata.acpr01__CorporateContactView_Req.tbDbmiCorporateContact;
    var lContactArrLength = lContactArr.length;
    for (var i = 0; i < lContactArrLength; i++) {
        lContactArr[i].corporateId = lCorpProfileMaster.corporateId;
    }
    req.tbDbmiCorporateContact = lContactArr;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acpr01.ViewContact.insertCorpDataCB = function(pResp) {
    if (!pResp.errors) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acpr01__ViewContact__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acpr01.ViewContact.sCurrentTask,
                "currentWfDetails": apz.acpr01.ViewContact.sCurrentWfDetails,
                "callBack": apz.acpr01.ViewContact.submitCB
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
apz.acpr01.ViewContact.submitCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acpr01";
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
                    "div": "acpr01__CorporateInfo__ModifyScreen",
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
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acpr01.ViewContact.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acpr01__ViewContact__LaunchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "NEXTTASK",
    //         "currentTask": apz.acpr01.ViewContact.sCurrentTask,
    //         "currentWfDetails": apz.acpr01.ViewContact.sCurrentWfDetails,
    //         "callBack": apz.acpr01.ViewContact.rejectCB
    //     }
    // };
    // apz.launchApp(lParams);
    
     $("#acpr01__ViewContact__RejectReason_Form").removeClass('sno');
    $("#acpr01__ViewContact__Reject_Reason_Confirm").removeClass('sno');
    $("#acpr01__ViewContact__ApproveRejectNav").addClass('sno');
    
};
apz.acpr01.ViewContact.rejectCB = function(pRespObj) {
    debugger;
    /*apz.currAppId = "acpr01";
    var msg = {
        "code": 'CON_REJECT'
    };
    apz.dispMsg(msg);
    */
    
    debugger;
    apz.currAppId = "acpr01";
    apz.acpr01.ViewContact.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acpr01.ViewContact.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acpr01.ViewContact.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acpr01.ViewContact.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acpr01.ViewContact.sDiv,
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {
            apz.acpr01.ViewContact.deleteContactData();
        }
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acpr01.ViewContact.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};

apz.acpr01.ViewContact.confirmReject = function() {
    debugger;
    var lRejectReason = apz.getElmValue('acpr01__ViewContact__reject_reason');
        apz.acpr01.ViewContact.sCurrentTask.remarks = lRejectReason;
        apz.acpr01.ViewContact.sCurrentWfDetails.remarks = lRejectReason;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acpr01__ViewContact__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acpr01.ViewContact.sCurrentTask,
            "currentWfDetails": apz.acpr01.ViewContact.sCurrentWfDetails,
            "callBack": apz.acpr01.ViewContact.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type":"String"
            }]
        }
    };
    apz.launchApp(lParams);
};

apz.acpr01.ViewContact.cancelReject = function() {
    debugger;
    $("#acpr01__ViewContact__RejectReason_Form").addClass('sno');
    $("#acpr01__ViewContact__Reject_Reason_Confirm").addClass('sno');
    $("#acpr01__ViewContact__ApproveRejectNav").removeClass('sno');
}
