apz.card01.verifyCardRequest = {};
apz.card01.verifyCardRequest.sAction = "";
apz.app.onLoad_VerifyCardRequest = function(userObj) {
    debugger;
    apz.card01.verifyCardRequest.sCurrentTask = userObj.currentTask;
    apz.card01.verifyCardRequest.sCurrentWfDetails = userObj.currentWfDetails;
    apz.card01.verifyCardRequest.sMasterAccountNo = userObj.data.masterAccount;
    apz.card01.verifyCardRequest.sMasterAccountName = userObj.data.accountName;
    apz.card01.verifyCardRequest.sCategory = userObj.data.category;
    apz.card01.verifyCardRequest.sScrData = userObj.scrData.card01__NewCardRequest_Req;
    var params = {
        "action": "Launch"
    };
    apz.card01.verifyCardRequest.fnRender(params);
};
apz.app.onShown_VerifyCardRequest = function(userObj) {
    debugger;
    apz.card01.cards.fnAdjustHeight();
};
apz.card01.verifyCardRequest.fnRender = function(params) {
    apz.card01.verifyCardRequest.fnRenderData(params);
    apz.card01.verifyCardRequest.fnRenderActionButtons(params);
};
apz.card01.verifyCardRequest.fnRenderActionButtons = function(params) {
    if (params.action == "Launch") {
       
        if (apz.card01.verifyCardRequest.sCategory == "Virtual Cards") {
            $("#card01__NewCardRequest__i__cardDetails__cashLimit_ctrl_grp_div").addClass("sno");
        } else if (apz.card01.verifyCardRequest.sCategory == "Travel Cards") {
            $("#card01__NewCardRequest__i__cardDetails__userType_ctrl_grp_div").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__emailId_ctrl_grp_div").addClass("sno");
        } else {
            $("#card01__NewCardRequest__i__cardDetails__validity_ctrl_grp_div").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__userType_ctrl_grp_div").addClass("sno");
            $("#card01__NewCardRequest__i__cardDetails__emailId_ctrl_grp_div").addClass("sno");
        }
    }
};
apz.card01.verifyCardRequest.fnRenderData = function(params) {
    if (params.action == "Launch") {
        apz.data.scrdata.card01__NewCardRequest_Req = {};
        apz.data.scrdata.card01__NewCardRequest_Req = apz.card01.verifyCardRequest.sScrData;
        
        var strlen = apz.data.scrdata.card01__NewCardRequest_Req.cardDetails.masterAccount;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = apz.data.scrdata.card01__NewCardRequest_Req.cardDetails.masterAccount;
        var result = apz.getMaskedValue(strlen, laccNo);
        apz.data.scrdata.card01__NewCardRequest_Req.cardDetails.maskAccNo = result;
        
        apz.data.loadData("NewCardRequest", "card01");
    }
};
apz.card01.verifyCardRequest.fnVerifyRequest = function() {
    debugger;
    var lUserObj = {};
    lUserObj.currentTask = apz.card01.verifyCardRequest.sCurrentTask;
    lUserObj.currentWfDetails = apz.card01.verifyCardRequest.sCurrentWfDetails;
    lUserObj.callBack = apz.card01.verifyCardRequest.fnVerifyRequestCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "card01__VerifyCardRequest__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.card01.verifyCardRequest.fnVerifyRequestCB = function(pRespObj) {
    debugger;
    apz.currAppId = "card01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.data = {};
                lObj.data.masterAccount = apz.card01.verifyCardRequest.sMasterAccountNo;
                lObj.data.accountName = apz.card01.verifyCardRequest.sMasterAccountName;
                lObj.data.category = apz.card01.verifyCardRequest.sCategory;
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
        }
    }
};
