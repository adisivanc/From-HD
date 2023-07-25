apz.ficl01.ApproveCollateral = {};
apz.app.onLoad_ApproveCollateral = function(params) {
    apz.ficl01.ApproveCollateral.sTaskObj = params;
    apz.data.scrdata.ficl01__AddCollaterals_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCollaterals_Req;
    apz.data.loadData("AddCollaterals", "ficl01");
};
apz.app.onShown_ApproveCollateral = function() {
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralCode_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralName_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__startDate_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__endDate_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralType_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralCurrency_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__collateralValue_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__limitContribution_lbl").removeClass("req");
    $("#ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__margin_lbl").removeClass("req");
};
apz.ficl01.ApproveCollateral.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("AddCollaterals", "ficl01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.ficl01.ApproveCollateral.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.ficl01.ApproveCollateral.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.ficl01.ApproveCollateral.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__ApproveCollateral__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "LCNC000FTAC4321";
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
apz.ficl01.ApproveCollateral.workflowMicroServiceCB = function(pNextStageObj) {
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
            apz.ficl01.ApproveCollateral.executeServiceTask(pNextStageObj);
        }
    }
};
apz.ficl01.ApproveCollateral.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lReqJson = {};
    lReqJson.addCollateralsDetails = apz.data.scrdata.ficl01__AddCollaterals_Req.tbDbmiCorpCollaterals;
    // lReqJson.addLetterDocumentsLists = apz.data.scrdata.ficl01__AddCollaterals_Req.tbDbmiCorpLetterCreditDocuments;
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_collaterals";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "FetchCollateralsService",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "false",
        "callBack": apz.ficl01.ApproveCollateral.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.ficl01.ApproveCollateral.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__ApproveCollateral__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.ficl01.ApproveCollateral.sTaskObj.currentTask,
                "currentWfDetails": apz.ficl01.ApproveCollateral.sTaskObj.currentWfDetails,
                "callBack": apz.ficl01.ApproveCollateral.submitCB
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
apz.ficl01.ApproveCollateral.submitCB = function(pRespObj) {
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
apz.ficl01.ApproveCollateral.Reject = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "ficl01__ApproveCollateral__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.ficl01.ApproveCollateral.sTaskObj.currentTask,
            "currentWfDetails": apz.ficl01.ApproveCollateral.sTaskObj.currentWfDetails,
            "callBack": apz.ficl01.ApproveCollateral.rejectCB
        }
    };
    apz.launchApp(lParams);
};
apz.ficl01.ApproveCollateral.rejectCB = function(pRespObj) {
    debugger;
    apz.currAppId = "ficl01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};
