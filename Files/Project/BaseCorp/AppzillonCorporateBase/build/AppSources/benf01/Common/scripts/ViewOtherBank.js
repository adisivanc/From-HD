apz.benf01.ViewOtherBank = {};
apz.app.onLoad_ViewOtherBank = function(params) {
    debugger;
    apz.benf01.ViewOtherBank.sCurrentTask = params.currentTask;
    apz.benf01.ViewOtherBank.sCurrentWfDetails = params.currentWfDetails;
    apz.data.scrdata.benf01__BeneficaryDetails_Req = params.scrData.benf01__BeneficaryDetails_Req;
    apz.data.loadData("BeneficaryDetails", "benf01");
    var transfetlmit = apz.getElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__transferLimit");
    apz.setElmValue("benf01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__transferlimitwithCurrency", "USD "+transfetlmit);
};
apz.benf01.ViewOtherBank.Approve = function() {
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.benf01.ViewOtherBank.sCurrentTask;
        lUserObj.currentWfDetails = apz.benf01.ViewOtherBank.sCurrentWfDetails;
        lUserObj.callBack = apz.benf01.ViewOtherBank.fnApproveCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "benf01__ViewOtherBank__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "BNOB000FTAC4321";
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
apz.benf01.ViewOtherBank.fnApproveCB = function(pResp) {
    debugger;
    if (pResp.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
        var lTransferDetails = JSON.parse(pResp.tbDbmiWorkflowDetail.screenData).benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary;
        var lReqJson = {};
        lReqJson.addBeneficiaryDetails = lTransferDetails;
        lReqJson.action = "New";
        lReqJson.table = "tb_dbmi_corp_role_beneficary";
        var lReqObj = {};
        apz.benf01.ViewOtherBank.sCurrentTask = pResp.tbDbmiWorkflowMaster;
        apz.benf01.ViewOtherBank.sCurrentWfDetails = pResp.tbDbmiWorkflowDetail;
        lReqObj.currentTask = pResp.tbDbmiWorkflowMaster;
        lReqObj.currentWfDetails = pResp.tbDbmiWorkflowDetail;
        var lServerParams = {
            "ifaceName": "FetchBeneficaryService",
            "appId": "benf01",
            "buildReq": "N",
            "req": "",
            "paintResp": "N",
            "async": "true",
            "callBack": apz.benf01.ViewOtherBank.BeneficaryDetailsCB,
            "callBackObj": {
                "userObj": lReqObj
            }
        };
        var req = {};
        lServerParams.req = lReqJson;
        apz.server.callServer(lServerParams);
    }
};
apz.benf01.ViewOtherBank.deleteUserDataCB = function(pResp) {
    debugger;
    var lServerParams = {
        "ifaceName": "NewSameBank_New",
        "buildReq": "N",
        "appId": "benf01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.benf01.ViewOtherBank.BeneficaryDetailsCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpRoleBeneficary = apz.data.scrdata.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.benf01.ViewOtherBank.Reject = function() {
    debugger;
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "benf01__ViewOtherBank__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "Reject",
                "currentTask": apz.benf01.ViewOtherBank.sCurrentTask,
                "currentWfDetails": apz.benf01.ViewOtherBank.sCurrentWfDetails,
                "callBack": apz.benf01.ViewOtherBank.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "BNOB000FTAC4321";
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
apz.benf01.ViewOtherBank.rejectCB = function() {
    apz.currAppId = "benf01";
    var msg = {
        "code": 'acus_Reject'
    };
    apz.dispMsg(msg);
};
apz.benf01.ViewOtherBank.BeneficaryDetailsCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "benf01__ViewOtherBank__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.benf01.ViewOtherBank.sCurrentTask,
                "currentWfDetails": apz.benf01.ViewOtherBank.sCurrentWfDetails,
                "callBack": apz.benf01.ViewOtherBank.approveCB
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
apz.benf01.ViewOtherBank.approveCB = function(pRespObj) {
    apz.currAppId = "benf01";
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
