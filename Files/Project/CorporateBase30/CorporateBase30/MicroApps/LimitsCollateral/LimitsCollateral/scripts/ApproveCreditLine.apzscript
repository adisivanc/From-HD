apz.ficl01.ApproveCreditLine = {};
apz.app.onLoad_ApproveCreditLine = function(params) {
    apz.ficl01.ApproveCreditLine.sTaskObj = params;
    apz.data.scrdata.ficl01__ApproveCreditLine_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCreditLine_Req;
    apz.data.loadData("AddCreditLine", "ficl01");
    var lineAmount = apz.getElmValue("ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__lineAmount");
    apz.setElmValue("ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__availableAmount", lineAmount);
};

apz.app.onShown_ApproveCreditLine = function() {
    
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__lineAmount_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__startDate_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__endDate_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__cifId_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__lineCurrency_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__mainLine_lbl").removeClass("req");
    $("#ficl01__AddCreditLine__i__tbDbmiCorpCreditLine__revolvingLine_lbl").removeClass("req");
   
};

apz.ficl01.ApproveCreditLine.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("AddCreditLine", "ficl01");
    var lUserObj = {};
    lUserObj.currentTask = apz.ficl01.ApproveCreditLine.sTaskObj.currentTask;
    lUserObj.currentWfDetails = apz.ficl01.ApproveCreditLine.sTaskObj.currentWfDetails;
    lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
    lUserObj.callBack = apz.ficl01.ApproveCreditLine.workflowMicroServiceCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "ficl01__ApproveCreditLine__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.ficl01.ApproveCreditLine.workflowMicroServiceCB = function(pNextStageObj) {
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
            apz.ficl01.ApproveCreditLine.executeServiceTask(pNextStageObj);
        }
    }
};

apz.ficl01.ApproveCreditLine.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lReqJson = {};
    lReqJson.addCreditLineDetails = apz.data.scrdata.ficl01__ApproveCreditLine_Req.tbDbmiCorpCreditLine;
    
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_credit_line";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "FetchCreditLineService",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "false",
        "callBack": apz.ficl01.ApproveCreditLine.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.ficl01.ApproveCreditLine.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__ApproveCreditLine__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.ficl01.ApproveCreditLine.sTaskObj.currentTask,
                "currentWfDetails": apz.ficl01.ApproveCreditLine.sTaskObj.currentWfDetails,
                "callBack": apz.ficl01.ApproveCreditLine.submitCB
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
apz.ficl01.ApproveCreditLine.submitCB = function(pRespObj) {
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

apz.ficl01.ApproveCreditLine.Reject = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "ficl01__ApproveCreditLine__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.ficl01.ApproveCreditLine.sTaskObj.currentTask,
            "currentWfDetails": apz.ficl01.ApproveCreditLine.sTaskObj.currentWfDetails,
            "callBack": apz.ficl01.ApproveCreditLine.rejectCB
        }
    };
    apz.launchApp(lParams);
};
apz.ficl01.ApproveCreditLine.rejectCB = function(pRespObj) {
    debugger;
    apz.currAppId = "ficl01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};
