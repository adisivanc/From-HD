apz.acru01.ViewRules = {};
apz.acru01.ViewRules.sRuleMasterData = {};
apz.acru01.ViewRules.sRuleDetails = [];
apz.acru01.ViewRules.sCurrentTask = {};
apz.acru01.ViewRules.sDiv = "";
apz.acru01.ViewRules.sAction = "";
apz.acru01.ViewRules.sCurrentWfDetails = {};
apz.app.onLoad_ViewRules = function(params) {
    apz.acru01.ViewRules.sRuleMasterData = params.scrData.tbDbmiWorkflowRuleMaster;
    apz.acru01.ViewRules.sRuleDetails = params.scrData.tbDbmiWorkflowRuleDetail;
    apz.acru01.ViewRules.sCurrentTask = params.currentTask;
    apz.acru01.ViewRules.sCurrentWfDetails = params.currentWfDetails;
    apz.acru01.ViewRules.sDiv = params.div;
    apz.acru01.ViewRules.sAction = params.action;
    $("#acru01__ViewRules__functionId").text(apz.acru01.ViewRules.sRuleMasterData.functionId);
    $("#acru01__ViewRules__functionId").text(apz.acru01.ViewRules.sRuleMasterData.functionDesc);
    // $("#acru01__ViewRules__Rule_MakerId").val(apz.acru01.ViewRules.sRuleMasterData.makerId);
    // $("#acru01__ViewRules__Rule_MakerTs").val(apz.acru01.ViewRules.sRuleMasterData.makerTs);
    apz.data.scrdata.acru01__RuleDetails_Req = {};
    apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail = apz.acru01.ViewRules.sRuleDetails;
    apz.data.loadData("RuleDetails", 'acru01');
};
apz.acru01.ViewRules.Approve = function() {
    debugger;
    var lUserObj = {};
    lUserObj.currentTask = apz.acru01.ViewRules.sCurrentTask;
    lUserObj.currentWfDetails = apz.acru01.ViewRules.sCurrentWfDetails;
    lUserObj.callBack = apz.acru01.ViewRules.fnApproveCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acru01__ViewRules__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.acru01.ViewRules.fnApproveCB = function(pResp) {
    debugger;
    if (pResp.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pResp.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            var lServerParams = {
                "ifaceName": "RuleDelete_Delete",
                "buildReq": "N",
                "appId": "acru01",
                "req": "",
                "paintResp": "Y",
                "async": "true",
                "callBack": apz.acru01.ViewRules.deleteRuleDataCB,
                "callBackObj": "",
            };
            var lFunctionId = apz.acru01.ViewRules.sRuleMasterData.functionId;
            var lCorporateId = apz.acru01.ViewRules.sRuleMasterData.corporateId;
            var req = {};
            req.tbDbmiWorkflowRuleMaster = {};
            req.tbDbmiWorkflowRuleMaster.corporateId = lCorporateId;
            req.tbDbmiWorkflowRuleMaster.functionId = lFunctionId;
            lServerParams.req = req;
            apz.server.callServer(lServerParams);
        }
    } else {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pResp.tbDbmiWorkflowMaster.referenceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acru01.ViewRules.deleteRuleDataCB = function(pResp) {
    debugger;
    if (pResp.errors == undefined || pResp.errors[0].errorCode == "APZ_FM_EX_041") {
        var lServerParams = {
            "ifaceName": "RuleInsert_New",
            "buildReq": "N",
            "appId": "acru01",
            "req": "",
            "paintResp": "N",
            "callBack": apz.acru01.ViewRules.insertRuleDataCB,
        };
        //apz.acru01.ViewRules.sRuleMasterData.checkerId = "USER002";
        apz.acru01.ViewRules.sRuleMasterData.checkerTs = apz.acru01.ViewRules.convertToMySQLTS();
        var req = {};
        req.tbDbmiWorkflowRuleMaster = apz.acru01.ViewRules.sRuleMasterData;
        req.tbDbmiWorkflowRuleDetail = apz.acru01.ViewRules.sRuleDetails;
        lServerParams.req = req;
        apz.server.callServer(lServerParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acru01.ViewRules.insertRuleDataCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acru01__ViewRules__launchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acru01.ViewRules.sCurrentTask,
                "currentWfDetails": apz.acru01.ViewRules.sCurrentWfDetails,
                "callBack": apz.acru01.ViewRules.approveCB
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
apz.acru01.ViewRules.approveCB = function(pResp) {
    debugger;
    apz.currAppId = "acru01";
    if (pResp.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pResp.tbDbmiWorkflowMaster.referenceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acru01.ViewRules.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acru01__ViewRules__launchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "Reject",
    //         "currentTask": apz.acru01.ViewRules.sCurrentTask,
    //         "currentWfDetails": apz.acru01.ViewRules.sCurrentWfDetails,
    //         "callBack": apz.acru01.ViewRules.rejectCB
    //     }
    // };
    // apz.launchApp(lParams);
    $("#acru01__ViewRules__RejectReason_Form").removeClass('sno');
    $("#acru01__ViewRules__Reject_Reason_Confirm").removeClass('sno');
    $("#acru01__ViewRules__ApproveRejectNav").addClass('sno');
};
apz.acru01.ViewRules.cancelReject = function() {
    debugger;
    $("#acru01__ViewRules__RejectReason_Form").addClass('sno');
    $("#acru01__ViewRules__Reject_Reason_Confirm").addClass('sno');
    $("#acru01__ViewRules__ApproveRejectNav").removeClass('sno');
}
apz.acru01.ViewRules.confirmReject = function() {
    debugger;
    var lRejectReason = apz.getElmValue('acru01__ViewRules__reject_reason');
    apz.acru01.ViewRules.sCurrentTask.remarks = lRejectReason;
    apz.acru01.ViewRules.sCurrentWfDetails.remarks = lRejectReason;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acru01__ViewRules__launchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acru01.ViewRules.sCurrentTask,
            "currentWfDetails": apz.acru01.ViewRules.sCurrentWfDetails,
            "callBack": apz.acru01.ViewRules.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
};
apz.acru01.ViewRules.rejectCB = function(pRespObj) {
    apz.currAppId = "acru01";
    // var msg = {
    //     "code": 'RULE_REJSUCS'
    // };
    // apz.dispMsg(msg);
    apz.acru01.ViewRules.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acru01.ViewRules.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acru01.ViewRules.sDiv;
                lObj.action = apz.acru01.ViewRules.sAction;
                var lRuleMaster = {};
                lRuleMaster.corporateId = apz.acru01.RulesSummary.sCorporateId;
                lRuleMaster.functionId = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData).tbDbmiWorkflowRuleDetail[0].functionId;
                lRuleMaster.functionDesc = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData).tbDbmiWorkflowRuleDetail[0].functionId;;
                lRuleMaster.makerId = "USER001";
                lRuleMaster.makerTs = apz.acru01.ViewRules.convertToMySQLTS();
                lObj.ruleMasterData = lRuleMaster
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acru01.ViewRules.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acru01.ViewRules.sDiv,
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {}
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acru01.ViewRules.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acru01.ViewRules.convertToMySQLTS = function() {
    var starttime = new Date();
    var isotime = new Date((new Date(starttime)).toISOString());
    var fixedtime = new Date(isotime.getTime() - (starttime.getTimezoneOffset() * 60000));
    var formatedMysqlString = fixedtime.toISOString().slice(0, 19).replace('T', ' ');
    console.log(formatedMysqlString);
    return formatedMysqlString;
};