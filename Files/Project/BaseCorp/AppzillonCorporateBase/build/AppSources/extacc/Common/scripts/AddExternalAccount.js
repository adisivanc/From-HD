apz.extacc.AddExternalAccount = {};
apz.app.onLoad_AddExternalAccount = function(params) {
    debugger;
    apz.extacc.AddExternalAccount.sCorporateId = apz.Login.sCorporateId;
    apz.extacc.AddExternalAccount.sRoleId = apz.Login.sRoleId;
    apz.extacc.AddExternalAccount.sUserID = apz.Login.sUserId;
};
apz.extacc.AddExternalAccount.fnAdd = function() {
    debugger;
    if(apz.getElmValue("extacc__AddExternalAccount__el_cbx_1") == "y"){
        
    
    
    apz.data.scrdata.extacc__ExternalAccounts_Req = {};
    var lscreenData = apz.data.buildData("ExternalAccounts", "extacc");
    lscreenData.extacc__ExternalAccounts_Req.tbDbmiCorpExternalAccounts[0].document = apz.extacc.AddExternalAccount.ldoc;
    lscreenData.extacc__ExternalAccounts_Req.tbDbmiCorpExternalAccounts[0].documentName = apz.extacc.AddExternalAccount.ldocName;
    lscreenData.extacc__ExternalAccounts_Req.tbDbmiCorpExternalAccounts[0].documentType = apz.extacc.AddExternalAccount.ldocType;
    var lUserObj = {};
    if (!apz.mockServer) {
        var taskObj = {};
        taskObj.workflowId = "EXAC";
        taskObj.status = "U";
        taskObj.taskType = "Add_External_Account";
        taskObj.versionNo = "1";
        taskObj.screenData = JSON.stringify(lscreenData);
        taskObj.action = "";
        taskObj.referenceId = apz.extacc.AddExternalAccount.sCorporateId + "__" + taskObj.workflowId;
        taskObj.taskDesc = taskObj.referenceId + "'s External account details have been submitted";
        lUserObj.taskDetails = taskObj;
        lUserObj.callBack = apz.extacc.AddExternalAccount.workflowMicroServiceCB;
        lUserObj.operation = "NEWWORKFLOW";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "extacc__AddExternalAccount__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
        var lParams = {
            "appId": "extacc",
            "scr": "VerifyExternalAccount",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
    }
    
    else{
        apz.dispMsg({"message":"Please agree to the terms and conditions"})
    }
}
apz.extacc.AddExternalAccount.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "extacc";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                // lReqObj.div = apz.acft01.otherBankDOM.sDiv;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pNextStageObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};
apz.extacc.AddExternalAccount.fnbrowse = function() {
    $("#extacc__AddExternalAccount__filebrowse").trigger("click");
}
apz.extacc.AddExternalAccount.fnBrowseFile = function(pthis) {
    debugger;
    let fileObj = pthis.files[0];
    apz.extacc.AddExternalAccount.ldocName = fileObj.name;
    apz.extacc.AddExternalAccount.ldocType = fileObj.type;
    apz.setElmValue("extacc__AddExternalAccount__documentname", apz.extacc.AddExternalAccount.ldocName);
    $("#extacc__AddExternalAccount__attachtext").addClass("sno");
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        var encodedImage = binaryStr.split(",").pop();
        apz.extacc.AddExternalAccount.ldoc = encodedImage;
        // apz.acft01.otherBankDOM.fnGetBase64({
        //     encodedImage
        // })
        $("#" + pthis.id).val("");
    }
    apzFileReader.readAsDataURL(fileObj);
}

apz.extacc.AddExternalAccount.fnViewAttachment = function(){
    debugger;
    
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

apz.extacc.AddExternalAccount.fnCancel = function(){
    debugger;
    apz.show("extacc__ExternalAccountList__ExtAcctHeader");
    apz.show("extacc__ExternalAccountList__MobExtAcctHeader");
    apz.show("extacc__ExternalAccountList__AccListRow");
    apz.hide("extacc__ExternalAccountList__subScreenLauncher");
}