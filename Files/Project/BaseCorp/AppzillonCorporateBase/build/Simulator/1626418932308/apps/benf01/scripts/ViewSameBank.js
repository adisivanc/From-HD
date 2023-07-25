apz.benf01.ViewSameBank = {};
apz.app.onLoad_ViewSameBank = function(params) {
    debugger;
    apz.benf01.ViewSameBank.sCurrentTask = params.currentTask;
    apz.benf01.ViewSameBank.sCurrentWfDetails = params.currentWfDetails;
    apz.data.scrdata.benf01__BeneficaryDetails_Req = params.scrData.benf01__BeneficaryDetails_Req;
    apz.data.loadData("BeneficaryDetails", "benf01");
};
apz.benf01.ViewSameBank.Approve = function() {
    var lUserObj = {};
    lUserObj.currentTask = apz.benf01.ViewSameBank.sCurrentTask;
    lUserObj.currentWfDetails = apz.benf01.ViewSameBank.sCurrentWfDetails;
    lUserObj.callBack = apz.benf01.ViewSameBank.fnApproveCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "benf01__ViewSameBank__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.benf01.ViewSameBank.fnApproveCB = function(pResp) {
    debugger;
    if (pResp.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
        var lTransferDetails = JSON.parse(pResp.tbDbmiWorkflowDetail.screenData).benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary;
        var lReqJson = {};
        lReqJson.addBeneficiaryDetails = lTransferDetails;
        lReqJson.action = "New";
        lReqJson.table = "tb_dbmi_corp_role_beneficary";
        var lReqObj = {};
        apz.benf01.ViewSameBank.sCurrentTask = pResp.tbDbmiWorkflowMaster;
        apz.benf01.ViewSameBank.sCurrentWfDetails = pResp.tbDbmiWorkflowDetail;
        lReqObj.currentTask = pResp.tbDbmiWorkflowMaster;
        lReqObj.currentWfDetails = pResp.tbDbmiWorkflowDetail;
        var lServerParams = {
            "ifaceName": "FetchBeneficaryService",
            "appId":"benf01",
            "buildReq": "N",
            "req": "",
            "paintResp": "N",
            "async": "true",
            "callBack": apz.benf01.ViewSameBank.BeneficaryDetailsCB,
            "callBackObj": {
                "userObj": lReqObj
            }
        };
        var req = {};
        lServerParams.req = lReqJson;
        apz.server.callServer(lServerParams);
    }
};
apz.benf01.ViewSameBank.deleteUserDataCB = function(pResp) {
    debugger;
    var lServerParams = {
        "ifaceName": "NewSameBank_New",
        "buildReq": "N",
        "appId": "benf01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.benf01.ViewSameBank.BeneficaryDetailsCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpRoleBeneficary = apz.data.scrdata.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.benf01.ViewSameBank.Reject = function() {
    debugger;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "benf01__ViewSameBank__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "Reject",
            "currentTask": apz.benf01.ViewSameBank.sCurrentTask,
            "currentWfDetails": apz.benf01.ViewSameBank.sCurrentWfDetails,
            "callBack": apz.benf01.ViewSameBank.rejectCB
        }
    };
    apz.launchApp(lParams);
};
apz.benf01.ViewSameBank.rejectCB = function() {
    apz.currAppId = "benf01";
    var msg = {
        "code": 'acus_Reject'
    };
    apz.dispMsg(msg);
};
apz.benf01.ViewSameBank.BeneficaryDetailsCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "benf01__ViewSameBank__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.benf01.ViewSameBank.sCurrentTask,
                "currentWfDetails": apz.benf01.ViewSameBank.sCurrentWfDetails,
                "callBack": apz.benf01.ViewSameBank.approveCB
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
apz.benf01.ViewSameBank.approveCB = function(pRespObj) {
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
