apz.acpr01.ModifyContact = {};
apz.acpr01.ModifyContact.sDiv = "";
apz.app.onLoad_ModifyContact = function(params) {
    apz.acpr01.ModifyContact.sUserId = apz.Login.sUserId;
    apz.acpr01.ModifyContact.sDiv = params.div;
    apz.acpr01.sContactsData = [];
    var lContactArr = [];
    var lContactArrLength = [];
    var lRecordNo = "";
    if (params.currentTask) {
        apz.acpr01.ModifyContact.sCurrentTask = params.currentTask;
        apz.acpr01.ModifyContact.sCurrentWfDetails = params.currentWfDetails;
        apz.acpr01.ModifyContact.sDiv = params.div;
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).acpr01__CorporateContactModify_Req;
        lContactArr = lScreenData.tbDbmiCorporateContact;
        lContactArrLength = lContactArr.length;
        lRecordNo = lContactArrLength - 1;
        apz.data.scrdata.acpr01__CorporateContactModify_Req = {};
        apz.data.scrdata.acpr01__CorporateContactModify_Req.tbDbmiCorporateMaster = lScreenData.tbDbmiCorporateMaster;
        apz.data.scrdata.acpr01__CorporateContactModify_Req.tbDbmiCorporateContact = lContactArr[lRecordNo];
        apz.data.loadData("CorporateContactModify", "acpr01");
    } else {
        lRecordNo = params.recordNo;
        apz.data.scrdata.acpr01__CorporateContactModify_Req = {};
        apz.data.scrdata.acpr01__CorporateContactModify_Req.tbDbmiCorporateMaster = params.CorpMasterData;
        apz.data.scrdata.acpr01__CorporateContactModify_Req.tbDbmiCorporateContact = params.CorpContactData[params.recordNo];
        apz.data.loadData("CorporateContactModify");
        lContactArr = params.CorpContactData;
        lContactArrLength = lContactArr.length;
    }
    // var lContactsLength = params.CorpContactData.length;
    for (var i = 0; i < lContactArrLength; i++) {
        if (i != lRecordNo) {
            apz.acpr01.sContactsData.push(lContactArr[i]);
        }
    }
};
apz.acpr01.ModifyContact.saveContact = function() {
    debugger;
    if (apz.val.validateContainer('acpr01__ModifyContact__ModifyContactForm') == false) {
        var msg = {
            "code": 'CONT_MIS'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("CorporateContactModify", "acpr01");
        apz.acpr01.sContactsData.push(lscreenData.acpr01__CorporateContactModify_Req.tbDbmiCorporateContact);
        lscreenData.acpr01__CorporateContactModify_Req.tbDbmiCorporateContact = apz.acpr01.sContactsData;
        if (apz.acpr01.ModifyContact.sCurrentTask) {
            var lUserObj = {};
            lUserObj.currentTask = apz.acpr01.ModifyContact.sCurrentTask;
            lUserObj.currentWfDetails = apz.acpr01.ModifyContact.sCurrentWfDetails;
            lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lUserObj.callBack = apz.acpr01.ModifyContact.workflowMicroServiceCB;
            lUserObj.operation = "NEXTTASK";
        } else {
            var taskObj = {};
            taskObj.workflowId = "CPMC";
            taskObj.status = "U";
            taskObj.taskType = "MODIFY_COMPANY_CONTACT";
            taskObj.versionNo = "1";
            taskObj.screenData = JSON.stringify(lscreenData);
            taskObj.action = "";
            taskObj.referenceId = lscreenData.acpr01__CorporateContactModify_Req.tbDbmiCorporateMaster.corporateId;
            taskObj.taskDesc = taskObj.referenceId + "'s contacts has been modified";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acpr01.ModifyContact.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
        }
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acpr01__ModifyContact__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    }
};
apz.acpr01.ModifyContact.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acpr01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acpr01.ModifyContact.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acpr01.ModifyContact.sDiv,
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
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {}
    }
};
apz.acpr01.ModifyContact.Confirmation = function() {
    debugger;
    $("#acpr01__CorporateInfo__ProfileMain").removeClass("sno");
    $("#acpr01__CorporateInfo__ModifyScreen").addClass("sno");
};
apz.acpr01.ModifyContact.cancel = function() {
    debugger;
    $("#acpr01__CorporateInfo__ProfileMain").removeClass("sno");
    $("#acpr01__CorporateInfo__ModifyScreen").addClass("sno");
    $("#acpr01__CorporateInfo__Corporate_Main_Header").removeClass("sno");
    $("#acpr01__CorporateInfo__Corporate_Sub_Header").removeClass("sno");
    $("#acpr01__CorporateInfo__RegistrationDetails").removeClass("sno");
};
apz.app.postCreateRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acpr01__ModifyContact__ModifyContactForm") {
        var lRecordNo = $("#acpr01__ModifyContact__ModifyContactForm_cr").val();
        if (lRecordNo) {
            apz.data.scrdata.acpr01__CorporateContactModify_Req.tbDbmiCorporateContact[lRecordNo - 1].corporateId = apz.acpr01.CorporateInfo.sCorporateId;
        }
    }
};
apz.app.preChangeRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acpr01__ModifyContact__ModifyContactForm") {
        if (!apz.val.validateContainer('acpr01__ModifyContact__ModifyContactForm')) {
            var msg = {
                "code": 'CONT_MIS'
            };
            apz.dispMsg(msg);
            return false;
        }
    }
};