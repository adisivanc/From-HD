apz.ficl01.ApproveCommitment = {};
apz.app.onLoad_ApproveCommitment = function(params) {
    apz.ficl01.ApproveCommitment.sTaskObj = params;
    apz.data.scrdata.ficl01__ApproveCommitment_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCommitment_Req;
    apz.data.loadData("AddCommitment", "ficl01");
    var totalComVal = apz.getElmValue("ficl01__AddCommitment__i__tbDbmiCorpCommitment__totalCommitmentValue");
    apz.setElmValue("ficl01__AddCommitment__i__tbDbmiCorpCommitment__availableAmount", totalComVal);
};
apz.app.onShown_ApproveCommitment = function() {
    $(".adr-ctr").addClass("sno");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__counterPartyname_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__startdate_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__maturitydate").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__currency_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__totalCommitmentValue_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__typeofCommitment_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__maturitydate_lbl").removeClass("req");
    $("#ficl01__AddCommitment__i__tbDbmiCorpCommitment__availableAmount_lbl").removeClass("req");
};
apz.ficl01.ApproveCommitment.approve = function() {
    debugger;
    var lscreenData = apz.data.buildData("AddCommitment", "ficl01");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.ficl01.ApproveCommitment.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.ficl01.ApproveCommitment.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.ficl01.ApproveCommitment.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__ApproveCommitment__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "COMM000FTAC4321";
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
apz.ficl01.ApproveCommitment.workflowMicroServiceCB = function(pNextStageObj) {
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
            apz.ficl01.ApproveCommitment.executeServiceTask(pNextStageObj);
        }
    }
};
apz.ficl01.ApproveCommitment.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lReqJson = {};
    lReqJson.addCommitmentDetails = apz.data.scrdata.ficl01__ApproveCommitment_Req.tbDbmiCorpCommitment;
    lReqJson.addCommitmentLoans = apz.data.scrdata.ficl01__ApproveCommitment_Req.tbDbmiCorpCommitmentLoan;
    lReqJson.action = "Query";
    lReqJson.table = "tb_dbmi_corp_commitment";
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "FetchCommitment",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "false",
        "callBack": apz.ficl01.ApproveCommitment.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    lServerParams.req = lReqJson;
    apz.server.callServer(lServerParams);
};
apz.ficl01.ApproveCommitment.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__ApproveCommitment__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.ficl01.ApproveCommitment.sTaskObj.currentTask,
                "currentWfDetails": apz.ficl01.ApproveCommitment.sTaskObj.currentWfDetails,
                "callBack": apz.ficl01.ApproveCommitment.submitCB
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
apz.ficl01.ApproveCommitment.submitCB = function(pRespObj) {
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
apz.ficl01.ApproveCommitment.Reject = function() {
    if (!apz.mockServer) {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "ficl01__ApproveCommitment__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.ficl01.ApproveCommitment.sTaskObj.currentTask,
            "currentWfDetails": apz.ficl01.ApproveCommitment.sTaskObj.currentWfDetails,
            "callBack": apz.ficl01.ApproveCommitment.rejectCB
        }
    };
    apz.launchApp(lParams);
    }
    else{
    
    var lObj = {};
        lObj.referenceId = "COMM000FTAC4321";
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
apz.ficl01.ApproveCommitment.rejectCB = function(pRespObj) {
    debugger;
    apz.currAppId = "ficl01";
    var msg = {
        "code": 'APZ-FT-REJCT'
    };
    apz.dispMsg(msg);
};