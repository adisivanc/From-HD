apz.bein01.ViewOtherBankINT = {};
apz.app.onLoad_ViewOtherBankINT = function(params) {
    debugger;
    apz.bein01.ViewOtherBankINT.sCurrentTask = params.currentTask;
    apz.bein01.ViewOtherBankINT.sCurrentWfDetails = params.currentWfDetails;
    apz.data.scrdata.bein01__BeneficaryDetails_Req = params.scrData.bein01__BeneficaryDetails_Req;
    apz.data.loadData("BeneficaryDetails", "bein01");
};
apz.bein01.ViewOtherBankINT.Approve = function() {
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.bein01.ViewOtherBankINT.sCurrentTask;
        lUserObj.currentWfDetails = apz.bein01.ViewOtherBankINT.sCurrentWfDetails;
        lUserObj.callBack = apz.bein01.ViewOtherBankINT.fnApproveCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bein01__ViewOtherBankINT__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "BNIB000FTAC4321";
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
apz.bein01.ViewOtherBankINT.fnApproveCB = function(pResp) {
    debugger;
    if (pResp.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
        var lTransferDetails = JSON.parse(pResp.tbDbmiWorkflowDetail.screenData).bein01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary;
        var lReqJson = {};
        lReqJson.addBeneficiaryDetails = lTransferDetails;
        lReqJson.action = "New";
        lReqJson.table = "tb_dbmi_corp_role_beneficary";
        var lReqObj = {};
        apz.bein01.ViewOtherBankINT.sCurrentTask = pResp.tbDbmiWorkflowMaster;
        apz.bein01.ViewOtherBankINT.sCurrentWfDetails = pResp.tbDbmiWorkflowDetail;
        lReqObj.currentTask = pResp.tbDbmiWorkflowMaster;
        lReqObj.currentWfDetails = pResp.tbDbmiWorkflowDetail;
        var lServerParams = {
            "ifaceName": "FetchBeneficaryService",
            "appId": "bein01",
            "buildReq": "N",
            "req": "",
            "paintResp": "N",
            "async": "true",
            "callBack": apz.bein01.ViewOtherBankINT.BeneficaryDetailsCB,
            "callBackObj": {
                "userObj": lReqObj
            }
        };
        var req = {};
        lServerParams.req = lReqJson;
        apz.server.callServer(lServerParams);
    }
};
apz.bein01.ViewOtherBankINT.deleteUserDataCB = function(pResp) {
    debugger;
    var lServerParams = {
        "ifaceName": "NewSameBank_New",
        "buildReq": "N",
        "appId": "bein01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.bein01.ViewOtherBankINT.BeneficaryDetailsCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpRoleBeneficary = apz.data.scrdata.bein01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.bein01.ViewOtherBankINT.Reject = function() {
    debugger;
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bein01__ViewOtherBankINT__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "Reject",
                "currentTask": apz.bein01.ViewOtherBankINT.sCurrentTask,
                "currentWfDetails": apz.bein01.ViewOtherBankINT.sCurrentWfDetails,
                "callBack": apz.bein01.ViewOtherBankINT.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "BNIB000FTAC4321";
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
apz.bein01.ViewOtherBankINT.rejectCB = function() {
    apz.currAppId = "bein01";
    var msg = {
        "code": 'acus_Reject'
    };
    apz.dispMsg(msg);
};
apz.bein01.ViewOtherBankINT.BeneficaryDetailsCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "bein01__ViewOtherBankINT__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.bein01.ViewOtherBankINT.sCurrentTask,
                "currentWfDetails": apz.bein01.ViewOtherBankINT.sCurrentWfDetails,
                "callBack": apz.bein01.ViewOtherBankINT.approveCB
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
apz.bein01.ViewOtherBankINT.approveCB = function(pRespObj) {
    debugger;
    apz.currAppId = "bein01";
    if (pRespObj.tbDbmiWorkflowMaster.status = "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            var lObj = {};
            //lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
            //lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
            lObj.referenceId = pRespObj.tbDbmiWorkflowMaster.referenceId;
            var lParams = {
                "appId": "tscm01",
                "scr": "TaskCompleted",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchApp(lParams);
        }
    }
};