apz.card01.approveRequest = {};
apz.card01.approveRequest.sAction = "";
apz.app.onLoad_ApproveRequest = function(userObj) {
    debugger;
    apz.card01.approveRequest.sCurrentTask = userObj.currentTask;
    apz.card01.approveRequest.sCurrentWfDetails = userObj.currentWfDetails;
    apz.card01.approveRequest.sMasterAccountNo = userObj.data.masterAccount;
    apz.card01.approveRequest.sMasterAccountName = userObj.data.accountName;
    apz.card01.approveRequest.sCategory = userObj.data.category;
    apz.card01.approveRequest.sScrData = userObj.scrData.card01__NewCardRequest_Req;
    var params = {
        "action": "Launch"
    };
    apz.card01.approveRequest.fnRender(params);
};
apz.app.onShown_ApproveRequest = function(userObj) {
    debugger;
    apz.card01.cards.fnAdjustHeight();
};
apz.card01.approveRequest.fnRender = function(params) {
    apz.card01.approveRequest.fnRenderData(params);
    apz.card01.approveRequest.fnRenderActionButtons(params);
};
apz.card01.approveRequest.fnRenderActionButtons = function(params) {
    if (params.action == "Launch") {
        if (apz.card01.approveRequest.sCategory == "Virtual Cards") {
            $("#card01__NewCardRequest__i__cardDetails__cashLimit_ctrl_grp_div").addClass("sno");
        } else if (apz.card01.approveRequest.sCategory == "Travel Cards") {
            $("#card01__NewCardRequest__i__cardDetails__userType_ctrl_grp_div").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__emailId_ctrl_grp_div").addClass("sno");
        } else {
            $("#card01__NewCardRequest__i__cardDetails__validity_ctrl_grp_div").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__userType_ctrl_grp_div").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__emailId_ctrl_grp_div").addClass("sno");
        }
    }
};
apz.card01.approveRequest.fnRenderData = function(params) {
    if (params.action == "Launch") {
        apz.data.scrdata.card01__NewCardRequest_Req = {};
        apz.data.scrdata.card01__NewCardRequest_Req = apz.card01.approveRequest.sScrData;
        
        var strlen = apz.data.scrdata.card01__NewCardRequest_Req.cardDetails.masterAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.card01__NewCardRequest_Req.cardDetails.masterAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.card01__NewCardRequest_Req.cardDetails.maskAccNo = result;
        
        apz.data.loadData("NewCardRequest", "card01");
    }
};
apz.card01.approveRequest.fnRejectRequest = function() {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "card01__ApproveRequest__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.card01.approveRequest.sCurrentTask,
            "currentWfDetails": apz.card01.approveRequest.sCurrentWfDetails,
            "callBack": apz.card01.approveRequest.fnRejectRequestCB,
            "taskVariables": [{
                "name": "status",
                "value": "reject"
            }]
        }
    };
    apz.launchApp(lParams);
};
apz.card01.approveRequest.fnRejectRequestCB = function(pRespObj) {
    debugger;
    apz.currAppId = "card01";
    /*
    var lMsg = {};
    lMsg.message = "New Card Request Rejected";
    lMsg.code = "E";
    apz.dispMsg(lMsg);
	*/
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
                    "div": "card01__Cards__CardLauncher",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "card01__Cards__CardLauncher",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {}
    } else {}
};
apz.card01.approveRequest.fnApproveRequest = function() {
    var lUserObj = {};
    lUserObj.currentTask = apz.card01.approveRequest.sCurrentTask;
    lUserObj.currentWfDetails = apz.card01.approveRequest.sCurrentWfDetails;
    lUserObj.callBack = apz.card01.approveRequest.fnApproveRequestCB;
    lUserObj.operation = "NEXTTASK";
    lUserObj.taskVariables = [{
        "name": "status",
        "value": "approve",
        "type": "String"
    }]
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "card01__ApproveRequest__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.card01.approveRequest.fnApproveRequestCB = function(pResp) {
    debugger;
    if (pResp.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
        apz.card01.approveRequest.sAction = "Approve";
        var req = {};
        req.cardDetails = apz.data.scrdata.card01__NewCardRequest_Req.cardDetails;
        req.action = "New";
        req.table = "tb_dbmi_card_request";
        var lParams = {
            "ifaceName": "NewCardRequest",
            "paintResp": "N",
            "appId": "card01",
            "buildReq": "N",
            "lReq": req
        };
        apz.card01.approveRequest.fnBeforCallServer(lParams);
    }
};
apz.card01.approveRequest.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.card01.approveRequest.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.card01.approveRequest.callServerCB = function(params) {
    debugger;
    if (apz.card01.approveRequest.sAction == "Approve") {
        apz.card01.approveRequest.fnCardApproveRequestCB(params);
    }
};
apz.card01.approveRequest.fnCardApproveRequestCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "card01__ApproveRequest__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.card01.approveRequest.sCurrentTask,
                "currentWfDetails": apz.card01.approveRequest.sCurrentWfDetails,
                "callBack": apz.card01.approveRequest.fnTaskCompletedCB
            }
        };
        apz.launchApp(lParams);
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
apz.card01.approveRequest.fnTaskCompletedCB = function(pRespObj) {
    var lParams = {
        "appId": "tscm01",
        "scr": "TaskCompleted",
        "div": "card01__Cards__CardLauncher",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
        }
    };
    apz.launchApp(lParams);
};
