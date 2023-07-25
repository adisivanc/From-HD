apz.acep01.ViewAddress = {};
apz.acep01.ViewAddress.sCurrentTask = {};
apz.acep01.ViewAddress.sCurrentWfDetails = {};
apz.acep01.ViewAddress.sDiv = "";
apz.app.onLoad_ViewAddress = function(params) {
    debugger;
    debugger;
    apz.acep01.ViewAddress.sCurrentTask = params.currentTask;
    apz.acep01.ViewAddress.sCurrentWfDetails = params.currentWfDetails;
    apz.acep01.ViewAddress.sDiv = params.div;
    apz.data.scrdata.acep01__EntityAddressView_Req = JSON.parse(params.currentWfDetails.screenData).acep01__EntityAddressModify_Req;
    apz.data.loadData("EntityAddressView", "acep01");
};
apz.acep01.ViewAddress.Approve = function() {
    debugger;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acep01__ViewAddress__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acep01.ViewAddress.sCurrentTask,
            "currentWfDetails": apz.acep01.ViewAddress.sCurrentWfDetails,
            "callBack": apz.acep01.ViewAddress.approveCB
        }
    };
    apz.launchApp(lParams);
};
apz.acep01.ViewAddress.approveCB = function(pRespObj) {
    apz.currAppId = 'acep01';
    apz.acep01.ViewAddress.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acep01.ViewAddress.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
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
                    "div": apz.acep01.ViewAddress.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            apz.acep01.ViewAddress.deleteAddressData();
        }
    }
};
apz.acep01.ViewAddress.deleteAddressData = function() {
    var lServerParams = {
        "ifaceName": "ExecuteQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acep01.ViewAddress.deleteEntityDataCB,
        "callBackObj": "",
    };
    var lCorporateId = apz.data.scrdata.acep01__EntityAddressView_Req.tbDbmiCorpEntityMaster.corporateId + "__" + apz.data.scrdata.acep01__EntityAddressView_Req
        .tbDbmiCorpEntityMaster.entityId;
    var req = {};
    req.queries = ["DELETE FROM tb_dbmi_corporate_address WHERE corporate_id = '" + lCorporateId + "'"];
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acep01.ViewAddress.deleteEntityDataCB = function(pResp) {
    debugger;
    if (pResp.errors == undefined || pResp.errors[0].errorCode == "APZ_FM_EX_041") {
        var lServerParams = {
            "ifaceName": "EntityAddressInsert_New",
            "buildReq": "N",
            "req": "",
            "paintResp": "N",
            "async": "true",
            "callBack": apz.acep01.ViewAddress.insertEntityDataCB,
            "callBackObj": "",
        };
        var req = {};
        var lCorpEntityMaster = apz.data.scrdata.acep01__EntityAddressView_Req.tbDbmiCorpEntityMaster;
        var lAddrArr = apz.data.scrdata.acep01__EntityAddressView_Req.tbDbmiCorporateAddress;
        var lAddrLength = lAddrArr.length;
        for (var i = 0; i < lAddrLength; i++) {
            lAddrArr[i].corporateId = lCorpEntityMaster.corporateId + "__" + lCorpEntityMaster.entityId;
        }
        req.tbDbmiCorporateAddress = lAddrArr;
        lServerParams.req = req;
        apz.server.callServer(lServerParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acep01.ViewAddress.insertEntityDataCB = function(pResp) {
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acep01__ViewAddress__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acep01.ViewAddress.sCurrentTask,
                "currentWfDetails": apz.acep01.ViewAddress.sCurrentWfDetails,
                "callBack": apz.acep01.ViewAddress.submitCB
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
apz.acep01.ViewAddress.submitCB = function(pRespObj) {
    apz.currAppId = "acep01";
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
                    "div": apz.acep01.ViewAddress.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            
        }
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
apz.acep01.ViewAddress.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acep01__ViewAddress__LaunchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "NEXTTASK",
    //         "currentTask": apz.acep01.ViewAddress.sCurrentTask,
    //         "currentWfDetails": apz.acep01.ViewAddress.sCurrentWfDetails,
    //         "callBack": apz.acep01.ViewAddress.approveCB
    //     }
    // };
    // apz.launchApp(lParams);
    
    $("#acep01__ViewAddress__RejectReason_Form").removeClass('sno');
    $("#acep01__ViewAddress__Reject_Reason_Confirm").removeClass('sno');
    $("#acep01__ViewAddress__ApproveRejectNav").addClass('sno');
};

apz.acep01.ViewAddress.cancelReject = function() {
    debugger;
    $("#acep01__ViewAddress__RejectReason_Form").addClass('sno');
    $("#acep01__ViewAddress__Reject_Reason_Confirm").addClass('sno');
    $("#acep01__ViewAddress__ApproveRejectNav").removeClass('sno');
}

apz.acep01.ViewAddress.confirmReject = function() {
    debugger;
    var lRejectReason = apz.getElmValue('acep01__ViewAddress__reject_reason');
    apz.acep01.ViewAddress.sCurrentTask.remarks = lRejectReason;
    apz.acep01.ViewAddress.sCurrentWfDetails.remarks = lRejectReason;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acep01__ViewAddress__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acep01.ViewAddress.sCurrentTask,
            "currentWfDetails": apz.acep01.ViewAddress.sCurrentWfDetails,
            "callBack": apz.acep01.ViewAddress.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
};
apz.acep01.ViewAddress.rejectCB = function(pRespObj) {
    debugger;
    /*
    apz.currAppId = "acep01";
    var msg = {
        "code": 'acep_Reject'
    };
    apz.dispMsg(msg);
    */
    
    apz.currAppId = "acep01";
    apz.acep01.ViewAddress.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acep01.ViewAddress.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acep01.ViewAddress.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div":apz.acep01.ViewAddress.sDiv,
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
            apz.acep01.ViewAddress.deleteAddressData();
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
