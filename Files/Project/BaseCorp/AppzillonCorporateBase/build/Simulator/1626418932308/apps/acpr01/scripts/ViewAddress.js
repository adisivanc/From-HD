apz.acpr01.ViewAddress = {};
apz.acpr01.ViewAddress.sCurrentTask = {};
apz.acpr01.ViewAddress.sCurrentWfDetails = {};
apz.acpr01.ViewAddress.sDiv = "";
apz.acpr01.ViewAddress.sCorporateId = "000FTAC4321";
apz.app.onLoad_ViewAddress = function(params) {
    apz.acpr01.ViewAddress.sCurrentTask = params.currentTask;
    apz.acpr01.ViewAddress.sCurrentWfDetails = params.currentWfDetails;
    apz.acpr01.ViewAddress.sDiv = params.div;
    apz.data.scrdata.acpr01__CorporateAddressView_Req = JSON.parse(params.currentWfDetails.screenData).acpr01__CorporateAddressModify_Req;
    apz.data.loadData("CorporateAddressView", "acpr01");
};
apz.acpr01.ViewAddress.Cancel = function() {
    var params = {
        "targetId": "acpr01__CorporateInfo__ModifyModal"
    };
    apz.toggleModal(params);
};
apz.acpr01.ViewAddress.Approve = function() {
    //code for next task
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acpr01__ViewAddress__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acpr01.ViewAddress.sCurrentTask,
            "currentWfDetails": apz.acpr01.ViewAddress.sCurrentWfDetails,
            "callBack": apz.acpr01.ViewAddress.approveCB,
            "taskVariables": [{
                "name": "action",
                "value": "approve",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
};
apz.acpr01.ViewAddress.approveCB = function(pRespObj) {
    debugger;
    apz.currAppId = 'acpr01';
    apz.acpr01.ViewAddress.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acpr01.ViewAddress.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
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
                    "div": apz.acpr01.ViewAddress.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acpr01.ViewAddress.deleteAddressData();
        }
    }
};
apz.acpr01.ViewAddress.deleteAddressData = function() {
    var lServerParams = {
        "ifaceName": "ExecuteQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acpr01.ViewAddress.deleteCorpDataCB,
        "callBackObj": "",
    };
    var lCorporateId = apz.data.scrdata.acpr01__CorporateAddressView_Req.tbDbmiCorporateMaster.corporateId;
    var req = {};
    req.queries = ["DELETE FROM tb_dbmi_corporate_address WHERE corporate_id = '" + lCorporateId + "'"];
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acpr01.ViewAddress.deleteCorpDataCB = function(pResp) {
    debugger;
    //if (!pResp.errors) {
    var lServerParams = {
        "ifaceName": "CorporateAddressInsert_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acpr01.ViewAddress.insertCorpDataCB,
        "callBackObj": "",
    };
    var req = {};
    var lCorpProfileMaster = apz.data.scrdata.acpr01__CorporateAddressView_Req.tbDbmiCorporateMaster;
    var lAddrArr = apz.data.scrdata.acpr01__CorporateAddressView_Req.tbDbmiCorporateAddress;
    var lAddrLength = lAddrArr.length;
    for (var i = 0; i < lAddrLength; i++) {
        lAddrArr[i].corporateId = lCorpProfileMaster.corporateId;
    }
    req.tbDbmiCorporateAddress = lAddrArr;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
    // }
};
apz.acpr01.ViewAddress.insertCorpDataCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acpr01__ViewAddress__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acpr01.ViewAddress.sCurrentTask,
                "currentWfDetails": apz.acpr01.ViewAddress.sCurrentWfDetails,
                "callBack": apz.acpr01.ViewAddress.submitCB
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
apz.acpr01.ViewAddress.submitCB = function(pRespObj) {
    debugger;
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
                    "div": apz.acpr01.ViewAddress.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {}
    } else {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acpr01.ViewAddress.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acpr01.ViewAddress.Reject = function() {
    $("#acpr01__ViewAddress__RejectReason_Form").removeClass('sno');
    $("#acpr01__ViewAddress__Reject_Reason_Confirm").removeClass('sno');
    $("#acpr01__ViewAddress__ApproveRejectNav").addClass('sno');
};
apz.acpr01.ViewAddress.fnCancelDiscard = function(pType) {
    debugger;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acpr01__ViewAddress__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": pType,
            "currentTask": apz.acpr01.ViewAddress.sCurrentTask,
            "currentWfDetails": apz.acpr01.ViewAddress.sCurrentWfDetails,
            "callBack": apz.acpr01.ViewAddress.fnCancelDiscardCB
        }
    };
    apz.launchApp(lParams);
};
apz.acpr01.ViewAddress.fnCancelDiscardCB = function(pResp) {
    debugger;
    $("#acpr01__CorporateInfo__ProfileMain").removeClass("sno");
    $("#acpr01__CorporateInfo__ModifyScreen").addClass("sno");
    $("#acpr01__CorporateInfo__Corporate_Main_Header").removeClass("sno");
    $("#acpr01__CorporateInfo__Corporate_Sub_Header").removeClass("sno");
    $("#acpr01__CorporateInfo__RegistrationDetails").removeClass("sno");
    var params = {};
    params.message = "Task has been completed";
    apz.dispMsg(params);
}
apz.acpr01.ViewAddress.confirmReject = function() {
    debugger;
    var lRejectReason = apz.getElmValue('acpr01__ViewAddress__reject_reason');
    apz.acpr01.ViewAddress.sCurrentTask.remarks = lRejectReason;
    apz.acpr01.ViewAddress.sCurrentWfDetails.remarks = lRejectReason;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acpr01__ViewAddress__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acpr01.ViewAddress.sCurrentTask,
            "currentWfDetails": apz.acpr01.ViewAddress.sCurrentWfDetails,
            "callBack": apz.acpr01.ViewAddress.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
};
apz.acpr01.ViewAddress.rejectCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acpr01";
    apz.acpr01.ViewAddress.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acpr01.ViewAddress.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acpr01.ViewAddress.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acpr01.ViewAddress.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acpr01.ViewAddress.sDiv,
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {
            apz.acpr01.ViewAddress.deleteAddressData();
        }
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acpr01.ViewAddress.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acpr01.ViewAddress.cancelReject = function() {
    debugger;
    $("#acpr01__ViewAddress__RejectReason_Form").addClass('sno');
    $("#acpr01__ViewAddress__Reject_Reason_Confirm").addClass('sno');
    $("#acpr01__ViewAddress__ApproveRejectNav").removeClass('sno');
}