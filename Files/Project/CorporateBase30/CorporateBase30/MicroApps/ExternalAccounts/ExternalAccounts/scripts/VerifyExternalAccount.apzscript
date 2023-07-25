apz.extacc.VerifyExternalAccount = {};
apz.app.onLoad_VerifyExternalAccount = function(params) {
    debugger;
    apz.extacc.VerifyExternalAccount.sTaskObj = params;
    apz.data.scrdata.extacc__ExternalAccounts_Req = JSON.parse(params.currentWfDetails.screenData).extacc__ExternalAccounts_Req;
    apz.data.loadData("ExternalAccounts", "extacc");
};
apz.extacc.VerifyExternalAccount.fnConfirm = function() {
    debugger;
    var lscreenData = apz.data.buildData("ExternalAccounts", "extacc");
    var lUserObj = {};
    if (!apz.mockServer) {
        lUserObj.currentTask = apz.extacc.VerifyExternalAccount.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.extacc.VerifyExternalAccount.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        lUserObj.callBack = apz.extacc.VerifyExternalAccount.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "extacc__VerifyExternalAccount__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        //lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        //lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        // lReqObj.div = apz.acft01.ownAccountVerify.sDiv;
        var lParams = {
            "appId": "extacc",
            "scr": "ApproveExternalAccount",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.extacc.VerifyExternalAccount.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "extacc";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
               // lReqObj.div = apz.acft01.ownAccountVerify.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div":"ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        }
    }
    
};

apz.extacc.VerifyExternalAccount.fnViewAttachment = function(){
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