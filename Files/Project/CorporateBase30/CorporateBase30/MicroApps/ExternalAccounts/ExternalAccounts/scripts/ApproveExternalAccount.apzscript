apz.extacc.ApproveExternalAccount = {};
apz.app.onLoad_ApproveExternalAccount = function(params) {
    debugger;
    apz.extacc.ApproveExternalAccount.sCorporateId = apz.Login.sCorporateId;
    apz.extacc.ApproveExternalAccount.sUserID = apz.Login.sUserId;
    apz.extacc.ApproveExternalAccount.sTaskObj = params;
    apz.data.scrdata.extacc__ExternalAccounts_Req = JSON.parse(params.currentWfDetails.screenData).extacc__ExternalAccounts_Req;
    apz.data.loadData("ExternalAccounts", "extacc");
};
apz.extacc.ApproveExternalAccount.fnApprove = function() {
    debugger;
    var lscreenData = apz.data.buildData("ExternalAccounts", "extacc");
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.extacc.ApproveExternalAccount.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.extacc.ApproveExternalAccount.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.extacc.ApproveExternalAccount.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "extacc__ApproveExternalAccount__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lObj = {};
        lObj.referenceId = "EXAC000FTAC4321";
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
apz.extacc.ApproveExternalAccount.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "extacc";
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
                // apz.lecr01.AddLCApprove.executeServiceTask();
            }
        } else if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            apz.extacc.ApproveExternalAccount.executeServiceTask(pNextStageObj);
        }
    }
};
apz.extacc.ApproveExternalAccount.executeServiceTask = function(pNextStageObj) {
    debugger;
    var lTransferDetails = JSON.parse(pNextStageObj.tbDbmiWorkflowDetail.screenData).extacc__ExternalAccounts_Req.tbDbmiCorpExternalAccounts;
    for (var i = 0; i < lTransferDetails.length; i++) {
        lTransferDetails[i].corporateId = apz.extacc.ApproveExternalAccount.sCorporateId
        lTransferDetails[i].userId = apz.extacc.ApproveExternalAccount.sUserID
    }
    var lReqObj = {};
    lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
    lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
    var lServerParams = {
        "ifaceName": "ExternalAccounts_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.extacc.ApproveExternalAccount.executeServiceTaskCB,
        "callBackObj": {
            "userObj": lReqObj
        }
    };
    var req = {};
    req.tbDbmiCorpExternalAccounts = lTransferDetails;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.extacc.ApproveExternalAccount.executeServiceTaskCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "extacc__ApproveExternalAccount__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.extacc.ApproveExternalAccount.sTaskObj.currentTask,
                "currentWfDetails": apz.extacc.ApproveExternalAccount.sTaskObj.currentWfDetails,
                "callBack": apz.extacc.ApproveExternalAccount.submitCB
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
apz.extacc.ApproveExternalAccount.submitCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
            //if (pRespObj.stageAccess) {
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
            //}
        }
    }
};


apz.extacc.ApproveExternalAccount.fnViewAttachment = function(){
    debugger;
    
    var myBase64string = apz.extacc.AddExternalAccount.ldoc;
    var objbuilder = '';
    objbuilder += ('<object width="100%" height="100%" data="data:'+apz.extacc.AddExternalAccount.ldocType+';base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="'+apz.extacc.AddExternalAccount.ldocType+'" class="internal">');
    objbuilder += ('<embed src="data:'+apz.extacc.AddExternalAccount.ldocType+';base64,');
    objbuilder += (myBase64string);
    objbuilder += ('" type="'+apz.extacc.AddExternalAccount.ldocType+'"  />');
    objbuilder += ('</object>');
    var win = window.open("#", "_blank");
    var title = "Document";
    win.document.write('<html><title>' + title + '</title><body style="margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bottom: 0px;">');
    win.document.write(objbuilder);
    win.document.write('</body></html>');
    var layer = jQuery(win.document);
}