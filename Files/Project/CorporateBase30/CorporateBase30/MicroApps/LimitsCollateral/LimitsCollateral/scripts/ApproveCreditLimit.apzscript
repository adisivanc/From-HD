apz.ficl01.ApproveCreditLimit = {};
apz.app.onLoad_ApproveCreditLimit = function(params) {
    apz.ficl01.ApproveCreditLimit.sTaskObj = params;
    apz.data.scrdata.ficl01__ApproveCreditLimit_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__ApproveCreditLimit_Req;
    apz.data.loadData("AddCreditLimit", "ficl01");
};
apz.app.onShown_ApproveCreditLimit = function() {
    $(".adr-ctr").addClass("sno");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__parentLimit_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__startDate_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__endDate_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__limitAmount_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__limitCurrency_lbl").removeClass("req");
    $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__limitType_lbl").removeClass("req");
};
apz.ficl01.ApproveCreditLimit.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("AddCreditLimit", "ficl01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.ficl01.ApproveCreditLimit.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.ficl01.ApproveCreditLimit.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.ficl01.ApproveCreditLimit.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__ApproveCreditLimit__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "CLAC000FTAC4321";
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
apz.ficl01.ApproveCreditLimit.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "ficl01";
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
                // apz.ficl01.ApproveCollateral.executeServiceTask();
            }
        } else if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            apz.ficl01.ApproveCreditLimit.executeServiceTask(pNextStageObj);
        }
    }
};
apz.ficl01.ApproveCreditLimit.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lReqJson = {};
    lReqJson.addCreditLimitDetails = apz.data.scrdata.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimit;
    lReqJson.addLimitCollateralsLists = apz.data.scrdata.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimitCollaterals;
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_credit_limit";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "FetchCreditLimitService",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "false",
        "callBack": apz.ficl01.ApproveCreditLimit.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.ficl01.ApproveCreditLimit.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__ApproveCreditLimit__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.ficl01.ApproveCreditLimit.sTaskObj.currentTask,
                "currentWfDetails": apz.ficl01.ApproveCreditLimit.sTaskObj.currentWfDetails,
                "callBack": apz.ficl01.ApproveCreditLimit.submitCB
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
apz.ficl01.ApproveCreditLimit.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            // if (pRespObj.stageAccess) {
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
            // }
        }
    }
};
apz.ficl01.ApproveCreditLimit.Reject = function() {
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__ApproveCreditLimit__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.ficl01.ApproveCreditLimit.sTaskObj.currentTask,
                "currentWfDetails": apz.ficl01.ApproveCreditLimit.sTaskObj.currentWfDetails,
                "callBack": apz.ficl01.ApproveCreditLimit.rejectCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "CLAC000FTAC4321";
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
apz.ficl01.ApproveCreditLimit.rejectCB = function(pRespObj) {
    debugger;
    apz.currAppId = "ficl01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};