apz.acpr01.ViewDirectors = {};
apz.acpr01.ViewDirectors.sCurrentTask = {};
apz.acpr01.ViewDirectors.sCurrentWfDetails = {};
apz.acpr01.ViewDirectors.sDiv = "";
apz.app.onLoad_ViewDirectors = function(params) {
    debugger;
    apz.acpr01.ViewDirectors.sCurrentTask = params.currentTask;
    apz.acpr01.ViewDirectors.sCurrentWfDetails = params.currentWfDetails;
    apz.acpr01.ViewDirectors.sDiv = params.div;
    apz.data.scrdata.acpr01__CorporateDirectorsView_Req = JSON.parse(params.currentWfDetails.screenData).acpr01__CorporateDirectorsModify_Req;
    apz.data.loadData("CorporateDirectorsView", "acpr01");
};
apz.acpr01.ViewDirectors.Approve = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acpr01__ViewDirectors__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acpr01.ViewDirectors.sCurrentTask,
            "currentWfDetails": apz.acpr01.ViewDirectors.sCurrentWfDetails,
            "callBack": apz.acpr01.ViewDirectors.approveCB
        }
    };
    apz.launchApp(lParams);
};
apz.acpr01.ViewDirectors.approveCB = function(pRespObj) {
    apz.currAppId = 'acpr01';
    apz.acpr01.ViewDirectors.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acpr01.ViewDirectors.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
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
                    "div": apz.acpr01.ViewDirectors.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acpr01.ViewDirectors.deleteDirectorsData();
        }
    }
};
apz.acpr01.ViewDirectors.deleteDirectorsData = function() {
    var lServerParams = {
        "ifaceName": "ExecuteQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acpr01.ViewDirectors.deleteCorpDataCB,
        "callBackObj": "",
    };
    var lCorporateId = apz.data.scrdata.acpr01__CorporateDirectorsView_Req.tbDbmiCorporateMaster.corporateId;
    var req = {};
    req.queries = ["DELETE FROM tb_dbmi_corporate_directors WHERE corporate_id = '" + lCorporateId + "'"];
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acpr01.ViewDirectors.deleteCorpDataCB = function(pResp) {
    // if (!pResp.errors) {
    var lServerParams = {
        "ifaceName": "CorporateDirectorsInsert_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acpr01.ViewDirectors.insertCorpDataCB,
        "callBackObj": "",
    };
    var req = {};
    var lCorpProfileMaster = apz.data.scrdata.acpr01__CorporateDirectorsView_Req.tbDbmiCorporateMaster;
    var lDirecArr = apz.data.scrdata.acpr01__CorporateDirectorsView_Req.tbDbmiCorporateDirectors;
    var lDirecArrLength = lDirecArr.length;
    for (var i = 0; i < lDirecArrLength; i++) {
        lDirecArr[i].corporateId = lCorpProfileMaster.corporateId;
    }
    req.tbDbmiCorporateDirectors = lDirecArr;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acpr01.ViewDirectors.insertCorpDataCB = function(pResp) {
    if (!pResp.errors) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acpr01__ViewDirectors__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acpr01.ViewDirectors.sCurrentTask,
                "currentWfDetails": apz.acpr01.ViewDirectors.sCurrentWfDetails,
                "callBack": apz.acpr01.ViewDirectors.submitCB
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
apz.acpr01.ViewDirectors.submitCB = function(pRespObj) {
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
                    "div": apz.acpr01.ViewDirectors.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {}
    }
    else{
        var lParams = {
        "appId": "tscm01",
        "scr": "TaskCompleted",
        "div": apz.acpr01.ViewDirectors.sDiv,
        "layout": "All",
        "type": "CF",
        "userObj": {
            "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
        }
    };
    apz.launchApp(lParams);
    }
};
apz.acpr01.ViewDirectors.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acpr01__ViewDirectors__LaunchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "NEXTTASK",
    //         "currentTask": apz.acpr01.ViewDirectors.sCurrentTask,
    //         "currentWfDetails": apz.acpr01.ViewDirectors.sCurrentWfDetails,
    //         "callBack": apz.acpr01.ViewDirectors.rejectCB
    //     }
    // };
    // apz.launchApp(lParams);
    
    $("#acpr01__ViewDirectors__RejectReason_Form").removeClass('sno');
    $("#acpr01__ViewDirectors__Reject_Reason_Confirm").removeClass('sno');
    $("#acpr01__ViewDirectors__ApproveRejectNav").addClass('sno');
};
apz.acpr01.ViewDirectors.rejectCB = function(pRespObj) {
    debugger;
    // apz.currAppId = "acpr01";
    // var msg = {
    //     "code": 'DIR_REJECT'
    // };
    // apz.dispMsg(msg);
    
     apz.currAppId = "acpr01";
    apz.acpr01.ViewDirectors.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acpr01.ViewDirectors.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acpr01.ViewDirectors.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acpr01.ViewDirectors.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acpr01.ViewDirectors.sDiv,
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {
            apz.acpr01.ViewAddress.deleteDirectorsData();
        }
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acpr01.ViewDirectors.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};

apz.acpr01.ViewDirectors.cancelReject = function() {
    debugger;
    $("#acpr01__ViewDirectors__RejectReason_Form").addClass('sno');
    $("#acpr01__ViewDirectors__Reject_Reason_Confirm").addClass('sno');
    $("#acpr01__ViewDirectors__ApproveRejectNav").removeClass('sno');
}

apz.acpr01.ViewDirectors.confirmReject = function() {
    debugger;
    var lRejectReason = apz.getElmValue('acpr01__ViewDirectors__reject_reason');
    apz.acpr01.ViewDirectors.sCurrentTask.remarks = lRejectReason;
    apz.acpr01.ViewDirectors.sCurrentWfDetails.remarks = lRejectReason;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acpr01__ViewDirectors__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acpr01.ViewDirectors.sCurrentTask,
            "currentWfDetails": apz.acpr01.ViewDirectors.sCurrentWfDetails,
            "callBack": apz.acpr01.ViewDirectors.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
};
